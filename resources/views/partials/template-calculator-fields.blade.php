@php
    $isBusiness = $calculatorId === 'vehicle-loan';
    $minimumMonths = $isSaving ? 1 : 12;
    $maximumMonths = $isSaving ? 120 : 36;
    $monthOptions = $isSaving ? [3, 6, 12, 18, 24, 36, 48, 60, 120] : [12, 18, 24, 36];
@endphp
<div class="range-box">
    <div class="form-group mb-4">
        <label class="form-label fw-bold text-dark" for="{{ $calculatorId }}-amount">{{ $isSaving ? 'Setoran per bulan (Rp)' : 'Jumlah pinjaman (Rp)' }}</label>
        @if($isSaving)
            <input class="form-control form-control-lg" id="{{ $calculatorId }}-amount" type="number" inputmode="numeric" min="100000" max="5000000" step="1" value="100000" data-calculator-amount required aria-describedby="{{ $calculatorId }}-amount-hint {{ $calculatorId }}-amount-error">
        @else
            <input class="form-control form-control-lg" id="{{ $calculatorId }}-amount" type="text" inputmode="numeric" pattern="[0-9.]+" data-min-amount="{{ $isBusiness ? '20000000' : '1000000' }}" data-max-amount="{{ $isBusiness ? '200000000' : '9007199254740991' }}" value="{{ $isBusiness ? '20.000.000' : '10.000.000' }}" data-calculator-amount required aria-describedby="{{ $calculatorId }}-amount-hint {{ $calculatorId }}-amount-error">
        @endif
        <div class="form-text text-dark" id="{{ $calculatorId }}-amount-hint" data-amount-hint></div>
        <div class="invalid-feedback text-dark" id="{{ $calculatorId }}-amount-error">{{ $isSaving ? 'Masukkan setoran Simpanan Siaga antara Rp100.000 dan Rp5.000.000 per bulan.' : ($isBusiness ? 'Masukkan pinjaman UMKM Rp20–50 juta, Rp51–100 juta, atau Rp101–200 juta.' : 'Masukkan jumlah pinjaman minimal Rp 1.000.000.') }}</div>
    </div>
    <div class="form-group mb-4">
        <label class="form-label fw-bold text-dark" for="{{ $calculatorId }}-months">{{ $isSaving ? 'Durasi (bulan)' : 'Tenor (bulan)' }}</label>
        <select class="form-select form-select-lg ignore" id="{{ $calculatorId }}-months" data-calculator-months>
            @foreach($monthOptions as $months)
                <option value="{{ $months }}" @selected($months === 12)>{{ $months }} bulan</option>
            @endforeach
            <option value="custom">Lainnya — isi jumlah bulan</option>
        </select>
    </div>
    <div class="form-group mb-4" data-custom-months-field hidden>
        <label class="form-label fw-bold text-dark" for="{{ $calculatorId }}-custom-months">Jumlah bulan</label>
        <input class="form-control form-control-lg" id="{{ $calculatorId }}-custom-months" type="number" inputmode="numeric" min="{{ $minimumMonths }}" max="{{ $maximumMonths }}" step="1" value="12" data-calculator-custom-months required disabled aria-describedby="{{ $calculatorId }}-months-error">
        <div class="invalid-feedback text-dark" id="{{ $calculatorId }}-months-error" data-months-error>Masukkan durasi antara {{ $minimumMonths }} dan {{ $maximumMonths }} bulan.</div>
    </div>
    <div class="form-group mb-4">
        <label class="form-label fw-bold text-dark" for="{{ $calculatorId }}-rate">{{ $isSaving ? 'Bunga berbunga per tahun (%)' : 'Suku bunga anuitas per bulan (%)' }}</label>
        @if($isSaving)
            <input class="form-control form-control-lg" id="{{ $calculatorId }}-rate" type="number" value="6" data-calculator-rate readonly aria-describedby="{{ $calculatorId }}-rate-hint">
            <div class="form-text text-dark" id="{{ $calculatorId }}-rate-hint">Bunga 6% per tahun (0,5% per bulan) dari saldo sebelumnya, dibulatkan ke bawah ke rupiah penuh sebelum setoran berikutnya ditambahkan. Setoran bulan pertama belum mendapat bunga.</div>
        @else
            <input class="form-control form-control-lg" id="{{ $calculatorId }}-rate" type="text" value="{{ $isBusiness ? '1,6' : '2' }}" data-calculator-rate readonly aria-describedby="{{ $calculatorId }}-rate-hint">
            <div class="form-text text-dark" id="{{ $calculatorId }}-rate-hint">{{ $isBusiness ? 'UMKM: Rp20–50 juta = 1,6%; Rp51–100 juta = 1,5%; Rp101–200 juta = 1,4% per bulan.' : 'Otomatis mengikuti jumlah pinjaman.' }}</div>
        @endif
    </div>
</div>
