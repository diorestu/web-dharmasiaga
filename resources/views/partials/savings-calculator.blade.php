@include('partials.template-calculator-fields', ['calculatorId' => $calculatorId, 'isSaving' => true])

<div class="emi-calculator-output-box clearfix">
    <div class="left-box">
        <div class="top">
            <div class="icon">
                <span class="icon-loan-3"></span>
            </div>
            <div class="inner-title">
                <h3>Estimasi saldo akhir</h3>
                <h2 class="fs-4 text-break">Rp 0</h2>
            </div>
        </div>
        <div class="btns-box">
            <a class="btn-one" href="{{ route('home') }}#contact">
                <span class="txt">Konsultasi</span>
            </a>
        </div>
    </div>
    <div class="right-box">
        <ul>
            <li>
                <div class="inner">
                    <div class="icon">
                        <span class="icon-right-arrow"></span>
                    </div>
                    <div class="text">
                        <a href="{{ route('home') }}#contact">Total bunga</a>
                        <p>Rp 0</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="inner">
                    <div class="icon">
                        <span class="icon-right-arrow"></span>
                    </div>
                    <div class="text">
                        <a href="{{ route('home') }}#contact">Total setoran</a>
                        <p>Rp 0</p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
