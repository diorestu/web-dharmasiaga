@php
    $history = config('cooperative.overview');
    $charts = [
        ['key' => 'members', 'title' => 'Jumlah anggota', 'unit' => 'Orang'],
        ['key' => 'assets', 'title' => 'Aset koperasi', 'unit' => 'Rp miliar'],
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
                    <div class="overview-chart">
                        <canvas data-overview-chart="{{ $chart['key'] }}" role="img" aria-labelledby="overview-{{ $chart['key'] }}-title overview-{{ $chart['key'] }}-description">Data {{ strtolower($chart['title']) }} tersedia pada tabel lengkap di bawah grafik.</canvas>
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
<script type="application/json" id="cooperative-overview-data">{!! json_encode($history, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_THROW_ON_ERROR) !!}</script>
@vite('resources/js/cooperative-overview.js')
