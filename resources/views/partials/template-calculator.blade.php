<section id="simulator" class="emi-calculator-area">
            <div class="container">
                <div class="sec-title text-center">
                    <h2>Rencanakan keuangan Anda</h2>
                    <div class="sub-title">
                        <p>Simulasi pinjaman anuitas dan Simpanan Siaga, bukan penawaran resmi.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="emi-calculator-tab">

                            <div class="emi-calculator-tab__button">
                                <div class="emi-calculator-tab__button--bg"
                                    style="background-image: url({{ asset('assets/images/resources/dharma-about.png') }});"></div>
                                <ul class="tabs-button-box">
                                    <li data-tab="#home-loan" class="tab-btn-item active-btn-item">
                                        <div class="icon-box">
                                            <span class="icon-loan-1"></span>
                                            <div class="overlay-text">
                                                <p>Pinjaman</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li data-tab="#personal-loan" class="tab-btn-item">
                                        <div class="icon-box">
                                            <span class="icon-loan-2"></span>
                                            <div class="overlay-text">
                                                <p>Simpanan Siaga</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li data-tab="#vehicle-loan" class="tab-btn-item">
                                        <div class="icon-box">
                                            <span class="icon-car-loan"></span>
                                            <div class="overlay-text">
                                                <p>Pinjaman usaha</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="emi-calculator-tab-content-box-outer">
                                <!--Start Tabs Content Box-->
                                <div class="tabs-content-box">
                                    <!--Tab-->
                                    <div class="tab-content-box-item tab-content-box-item-active" id="home-loan" data-calculator="loan">
                                        <div class="emi-calculator-tab-content-box-item">

                                            @include('partials.template-calculator-fields', ['calculatorId' => 'home-loan', 'isSaving' => false])

                                            <div class="emi-calculator-output-box clearfix">
                                                <div class="left-box">
                                                    <div class="top">
                                                        <div class="icon">
                                                            <span class="icon-loan-3"></span>
                                                        </div>
                                                        <div class="inner-title">
                                                            <h3>Angsuran per bulan</h3>
                                                            <h2 class="fs-4 text-break">Rp 1.845.041</h2>
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
                                                                    <p>Rp 2.140.494</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="inner">
                                                                <div class="icon">
                                                                    <span class="icon-right-arrow"></span>
                                                                </div>
                                                                <div class="text">
                                                                    <a href="{{ route('home') }}#contact">Total pembayaran</a>
                                                                    <p>Rp 22.140.494</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!--Tab-->
                                    <div class="tab-content-box-item" id="personal-loan" data-calculator="saving">
                                        <div class="emi-calculator-tab-content-box-item">

                                            @include('partials.template-calculator-fields', ['calculatorId' => 'personal-loan', 'isSaving' => true])

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

                                        </div>
                                    </div>

                                    <!--Tab-->
                                    <div class="tab-content-box-item" id="vehicle-loan" data-calculator="loan" data-loan-type="business">
                                        <div class="emi-calculator-tab-content-box-item">

                                            @include('partials.template-calculator-fields', ['calculatorId' => 'vehicle-loan', 'isSaving' => false])

                                            <div class="emi-calculator-output-box clearfix">
                                                <div class="left-box">
                                                    <div class="top">
                                                        <div class="icon">
                                                            <span class="icon-loan-3"></span>
                                                        </div>
                                                        <div class="inner-title">
                                                            <h3>Angsuran per bulan</h3>
                                                            <h2 class="fs-4 text-break">Rp 1.845.041</h2>
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
                                                                    <p>Rp 2.140.494</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="inner">
                                                                <div class="icon">
                                                                    <span class="icon-right-arrow"></span>
                                                                </div>
                                                                <div class="text">
                                                                    <a href="{{ route('home') }}#contact">Total pembayaran</a>
                                                                    <p>Rp 22.140.494</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                                <!--End Tabs Content Box-->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
