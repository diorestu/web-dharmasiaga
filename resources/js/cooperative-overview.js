import { Chart, BarController, BarElement, CategoryScale, LinearScale, Tooltip } from 'chart.js';

Chart.register(BarController, BarElement, CategoryScale, LinearScale, Tooltip);

const source = document.getElementById('cooperative-overview-data');
const rows = source ? JSON.parse(source.textContent) : [];
const integer = new Intl.NumberFormat('id-ID');
const billions = new Intl.NumberFormat('id-ID', { maximumFractionDigits: 1 });
const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

const valueLabels = {
    id: 'overviewValueLabels',
    afterDatasetsDraw(chart) {
        const { ctx } = chart;
        const assets = chart.canvas.dataset.overviewChart === 'assets';
        ctx.save();
        ctx.fillStyle = '#1a1c23';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'bottom';
        ctx.font = `600 ${chart.width < 250 ? 10 : 13}px Manrope, sans-serif`;
        chart.getDatasetMeta(0).data.forEach((bar, index) => {
            const value = chart.data.datasets[0].data[index];
            ctx.fillText(assets ? billions.format(value / 1e9) : integer.format(value), bar.x, bar.y - 8);
        });
        ctx.restore();
    },
};

document.querySelectorAll('[data-overview-chart]').forEach(canvas => {
    const metric = canvas.dataset.overviewChart;
    const assets = metric === 'assets';
    new Chart(canvas, {
        type: 'bar',
        data: {
            labels: rows.map(row => String(row.year)),
            datasets: [{
                label: assets ? 'Aset koperasi' : 'Jumlah anggota',
                data: rows.map(row => row[metric]),
                backgroundColor: rows.map((row, index) => index === rows.length - 1 ? '#cf173c' : '#b57a90'),
                hoverBackgroundColor: '#8a0f3d',
                maxBarThickness: 48,
                barPercentage: 0.75,
                categoryPercentage: 0.75,
                borderRadius: 2,
            }],
        },
        plugins: [valueLabels],
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: { duration: reducedMotion ? 0 : 400 },
            layout: { padding: { top: 26, left: 8, right: 8 } },
            interaction: { mode: 'index', intersect: false },
            plugins: {
                tooltip: {
                    displayColors: false,
                    backgroundColor: '#1a1c23',
                    padding: 10,
                    callbacks: {
                        label: context => assets ? `Rp${integer.format(context.raw)}` : `${integer.format(context.raw)} anggota`,
                    },
                },
            },
            scales: {
                x: {
                    grid: { display: false },
                    border: { color: '#e6e2df' },
                    ticks: { autoSkip: false, maxRotation: 0, color: '#655e59', font: { size: 10, family: 'Manrope, sans-serif' } },
                },
                y: {
                    beginAtZero: true,
                    suggestedMax: assets ? 120e9 : 5000,
                    display: false,
                },
            },
        },
    });
});
