@php
    $history = config('cooperative.overview');
    $charts = [
        ['key' => 'members', 'title' => 'Jumlah anggota', 'unit' => 'Orang', 'maximum' => 5000, 'divisor' => 1],
        ['key' => 'assets', 'title' => 'Aset koperasi', 'unit' => 'Rp miliar', 'maximum' => 120000000000, 'divisor' => 1000000000],
    ];
@endphp
<section id="assets" class="cooperative-overview" aria-labelledby="asset-overview-title">
    <div class="container">
        <div id="asset-overview" class="sec-title text-center">
            <h2 id="asset-overview-title">Gambaran koperasi</h2>
            <div class="sub-title"><p>Jumlah anggota dan aset, <span class="text-nowrap">2022–2025.</span></p></div>
        </div>
        <div class="cooperative-overview-grid">
            @foreach($charts as $chart)
                <figure class="overview-figure overview-figure--{{ $chart['key'] }}">
                    <figcaption>
                        <h3 id="overview-{{ $chart['key'] }}-title">{{ $chart['title'] }}</h3>
                        <p>{{ $chart['unit'] }}</p>
                    </figcaption>
                    <p class="sr-only" id="overview-{{ $chart['key'] }}-description">Grafik batang {{ strtolower($chart['title']) }} tahun 2022–2025. Nilai lengkap tersedia pada tabel di bawah kedua grafik.</p>
                    <div class="overview-chart" role="img" aria-labelledby="overview-{{ $chart['key'] }}-title overview-{{ $chart['key'] }}-description">
                        @foreach($history as $row)
                            @php
                                $height = ($row[$chart['key']] / $chart['maximum']) * 100;
                                $value = number_format($row[$chart['key']] / $chart['divisor'], $chart['key'] === 'assets' ? 1 : 0, ',', '.');
                            @endphp
                            <div class="overview-chart-column" aria-hidden="true" title="{{ $row['year'] }}: {{ $chart['key'] === 'assets' ? 'Rp' : '' }}{{ number_format($row[$chart['key']], 0, ',', '.') }}{{ $chart['key'] === 'members' ? ' anggota' : '' }}">
                                <div class="overview-chart-track">
                                    <div class="overview-chart-bar {{ $loop->last ? 'overview-chart-bar--latest' : '' }}" style="height: {{ $height }}%">
                                        <span class="overview-chart-value">{{ $value }}</span>
                                    </div>
                                </div>
                                <span class="overview-chart-year">{{ $row['year'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </figure>
            @endforeach
        </div>
        <details class="overview-details">
            <summary>Lihat data lengkap 2022–2025</summary>
            <div class="overview-data-scroll">
                <table class="overview-data-table">
                    <caption class="sr-only">Jumlah anggota dan aset koperasi per tahun</caption>
                    <thead><tr><th scope="col">Tahun</th><th scope="col">Anggota</th><th scope="col">Aset (Rp)</th></tr></thead>
                    <tbody>
                        @foreach($history as $row)
                            <tr><th scope="row">{{ $row['year'] }}</th><td>{{ number_format($row['members'], 0, ',', '.') }}</td><td>{{ number_format($row['assets'], 0, ',', '.') }}</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </details>
    </div>
</section>
