@php
    $history = config('cooperative.overview');
    $charts = [
        ['key' => 'members', 'title' => 'Jumlah anggota', 'unit' => 'Orang', 'maximum' => 5000, 'ticks' => [0, 1000, 2000, 3000, 4000, 5000], 'divisor' => 1],
        ['key' => 'assets', 'title' => 'Aset koperasi', 'unit' => 'Miliar rupiah', 'maximum' => 120000000000, 'ticks' => [0, 40000000000, 80000000000, 120000000000], 'divisor' => 1000000000],
    ];
@endphp
<section id="assets" class="cooperative-overview" aria-labelledby="asset-overview-title">
    <div class="container">
        <div id="asset-overview" class="sec-title text-center">
            <h2 id="asset-overview-title">Gambaran koperasi</h2>
            <div class="sub-title"><p>Perkembangan jumlah anggota dan aset KSP Dharma Siaga tahun 2022–2025.</p></div>
        </div>
        <div class="cooperative-overview-grid">
            @foreach($charts as $chart)
                <figure class="overview-figure overview-figure--{{ $chart['key'] }}">
                    <figcaption>
                        <h3 id="overview-{{ $chart['key'] }}-title">{{ $chart['title'] }}</h3>
                        <p>{{ $chart['unit'] }} · 2022–2025</p>
                    </figcaption>
                    <svg class="overview-chart" viewBox="0 0 520 260" role="img" aria-labelledby="overview-{{ $chart['key'] }}-title overview-{{ $chart['key'] }}-description">
                        <desc id="overview-{{ $chart['key'] }}-description">Grafik batang {{ strtolower($chart['title']) }} tahun 2022–2025. Nilai lengkap tersedia pada tabel setelah grafik.</desc>
                        @foreach($chart['ticks'] as $tick)
                            @php
                                $y = 210 - ($tick / $chart['maximum']) * 180;
                            @endphp
                            <line class="overview-chart-gridline" x1="56" x2="510" y1="{{ $y }}" y2="{{ $y }}" />
                            <text class="overview-chart-axis" x="46" y="{{ $y + 4 }}" text-anchor="end">{{ number_format($tick / $chart['divisor'], 0, ',', '.') }}</text>
                        @endforeach
                        @foreach($history as $row)
                            @php
                                $height = ($row[$chart['key']] / $chart['maximum']) * 180;
                                $x = 80 + $loop->index * 112;
                                $value = number_format($row[$chart['key']] / $chart['divisor'], $chart['key'] === 'assets' ? 2 : 0, ',', '.');
                            @endphp
                            <rect class="overview-chart-bar" x="{{ $x }}" y="{{ 210 - $height }}" width="68" height="{{ $height }}">
                                <title>{{ $row['year'] }}: {{ $chart['key'] === 'assets' ? 'Rp' : '' }}{{ number_format($row[$chart['key']], 0, ',', '.') }}{{ $chart['key'] === 'members' ? ' anggota' : '' }}</title>
                            </rect>
                            <text class="overview-chart-value" x="{{ $x + 34 }}" y="{{ 200 - $height }}" text-anchor="middle">{{ $value }}</text>
                            <text class="overview-chart-year" x="{{ $x + 34 }}" y="238" text-anchor="middle">{{ $row['year'] }}</text>
                        @endforeach
                    </svg>
                    <table class="overview-data-table">
                        <caption class="sr-only">Data {{ strtolower($chart['title']) }} per tahun</caption>
                        <thead><tr><th scope="col">Tahun</th><th scope="col">{{ $chart['key'] === 'assets' ? 'Aset (Rp)' : 'Jumlah anggota' }}</th></tr></thead>
                        <tbody>
                            @foreach($history as $row)
                                <tr><th scope="row">{{ $row['year'] }}</th><td>{{ number_format($row[$chart['key']], 0, ',', '.') }}</td></tr>
                            @endforeach
                        </tbody>
                    </table>
                </figure>
            @endforeach
        </div>
    </div>
</section>
