<section id="simulator" class="emi-calculator-area">
            <div class="container">
                <div class="sec-title text-center">
                    <h2>Rencanakan keuangan Anda</h2>
                    <div class="sub-title">
                        <p>Estimasi flat sederhana untuk perencanaan, bukan penawaran resmi.</p>
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
                                                <p>Simpanan</p>
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

                                            <div class="range-box">
                                                <div class="row">
                                                    <div class="col-lg-12 column">
                                                        <div class="price-range-box">
                                                            <div class="inner">
                                                                <h4>Jumlah pinjaman</h4>
                                                                <div class="price-range-slider"></div>
                                                                <div class="range-input">
                                                                    <div class="input">
                                                                        <input type="text" class="property-amount"
                                                                            name="field-name" readonly="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="right-box">
                                                                <h5>Rp 100 juta</h5>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12 column">
                                                        <div class="loan-term-range-box">
                                                            <div class="inner">
                                                                <h4>Tenor <span>(bulan)</span></h4>
                                                                <div class="loan-term-range-slider"></div>
                                                                <div class="range-input">
                                                                    <div class="input">
                                                                        <input type="text" class="loan-term-range"
                                                                            name="field-name" readonly="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="right-box">
                                                                <h5>60 bulan</h5>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12 column">
                                                        <div class="interest-rate-range-box">
                                                            <div class="inner">
                                                                <h4>Estimasi jasa per tahun (%)</h4>
                                                                <div class="interest-rate-range-slider"></div>
                                                                <div class="range-input">
                                                                    <div class="input">
                                                                        <input type="text" class="interest-rate-range"
                                                                            name="field-name" readonly="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="right-box">
                                                                <h5>30%</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="emi-calculator-output-box clearfix">
                                                <div class="left-box">
                                                    <div class="top">
                                                        <div class="icon">
                                                            <span class="icon-loan-3"></span>
                                                        </div>
                                                        <div class="inner-title">
                                                            <h3>Angsuran per bulan</h3>
                                                            <h2>Rp 0</h2>
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
                                                                    <a href="{{ route('home') }}#contact">Estimasi jasa</a>
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
                                                                    <a href="{{ route('home') }}#contact">Total pembayaran</a>
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
                                    <div class="tab-content-box-item" id="personal-loan" data-calculator="saving">
                                        <div class="emi-calculator-tab-content-box-item">

                                            <div class="range-box">
                                                <div class="row">
                                                    <div class="col-lg-12 column">
                                                        <div class="price-range-box">
                                                            <div class="inner">
                                                                <h4>Setoran per bulan</h4>
                                                                <div class="price-range-slider"></div>
                                                                <div class="range-input">
                                                                    <div class="input">
                                                                        <input type="text" class="property-amount"
                                                                            name="field-name" readonly="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="right-box">
                                                                <h5>Rp 5 juta</h5>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12 column">
                                                        <div class="loan-term-range-box">
                                                            <div class="inner">
                                                                <h4>Durasi <span>(bulan)</span></h4>
                                                                <div class="loan-term-range-slider"></div>
                                                                <div class="range-input">
                                                                    <div class="input">
                                                                        <input type="text" class="loan-term-range"
                                                                            name="field-name" readonly="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="right-box">
                                                                <h5>120 bulan</h5>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12 column">
                                                        <div class="interest-rate-range-box">
                                                            <div class="inner">
                                                                <h4>Estimasi hasil per tahun (%)</h4>
                                                                <div class="interest-rate-range-slider"></div>
                                                                <div class="range-input">
                                                                    <div class="input">
                                                                        <input type="text" class="interest-rate-range"
                                                                            name="field-name" readonly="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="right-box">
                                                                <h5>20%</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="emi-calculator-output-box clearfix">
                                                <div class="left-box">
                                                    <div class="top">
                                                        <div class="icon">
                                                            <span class="icon-loan-3"></span>
                                                        </div>
                                                        <div class="inner-title">
                                                            <h3>Estimasi saldo akhir</h3>
                                                            <h2>Rp 0</h2>
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
                                                                    <a href="{{ route('home') }}#contact">Estimasi hasil</a>
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
                                    <div class="tab-content-box-item" id="vehicle-loan" data-calculator="loan">
                                        <div class="emi-calculator-tab-content-box-item">

                                            <div class="range-box">
                                                <div class="row">
                                                    <div class="col-lg-12 column">
                                                        <div class="price-range-box">
                                                            <div class="inner">
                                                                <h4>Jumlah pinjaman</h4>
                                                                <div class="price-range-slider"></div>
                                                                <div class="range-input">
                                                                    <div class="input">
                                                                        <input type="text" class="property-amount"
                                                                            name="field-name" readonly="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="right-box">
                                                                <h5>Rp 100 juta</h5>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12 column">
                                                        <div class="loan-term-range-box">
                                                            <div class="inner">
                                                                <h4>Tenor <span>(bulan)</span></h4>
                                                                <div class="loan-term-range-slider"></div>
                                                                <div class="range-input">
                                                                    <div class="input">
                                                                        <input type="text" class="loan-term-range"
                                                                            name="field-name" readonly="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="right-box">
                                                                <h5>60 bulan</h5>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12 column">
                                                        <div class="interest-rate-range-box">
                                                            <div class="inner">
                                                                <h4>Estimasi jasa per tahun (%)</h4>
                                                                <div class="interest-rate-range-slider"></div>
                                                                <div class="range-input">
                                                                    <div class="input">
                                                                        <input type="text" class="interest-rate-range"
                                                                            name="field-name" readonly="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="right-box">
                                                                <h5>30%</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="emi-calculator-output-box clearfix">
                                                <div class="left-box">
                                                    <div class="top">
                                                        <div class="icon">
                                                            <span class="icon-loan-3"></span>
                                                        </div>
                                                        <div class="inner-title">
                                                            <h3>Angsuran per bulan</h3>
                                                            <h2>Rp 0</h2>
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
                                                                    <a href="{{ route('home') }}#contact">Estimasi jasa</a>
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
                                                                    <a href="{{ route('home') }}#contact">Total pembayaran</a>
                                                                    <p>Rp 0</p>
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
