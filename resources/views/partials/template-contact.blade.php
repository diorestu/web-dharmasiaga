<section id="contact" class="main-contact-form-area"><div class="container"><div class="row"><div class="col-xl-6">
@include('partials.template-office-details')
</div><div class="col-xl-6">
<div class="contact-form">
                            <form id="member-contact-form" name="contact_form" class="default-form2"
                                action="{{ route('contact.submit') }}" method="post">
@csrf
@if(session("contact_status"))<div class="alert alert-success" role="status">{{ session("contact_status") }}</div>@endif
@if($errors->any())<div class="alert alert-danger" role="alert">@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif

                                <div class="form-group">
                                    <label for="formName">Nama lengkap</label>
                                    <div class="input-box">
                                        <input type="text" name="name" maxlength="100" autocomplete="name" id="formName" placeholder="Nama Anda"
                                            required="" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="formEmail">Email (opsional)</label>
                                    <div class="input-box">
                                        <input type="email" name="email" maxlength="120" autocomplete="email" id="formEmail" placeholder="nama@email.com" value="{{ old('email') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="formPhone">Nomor telepon / WhatsApp</label>
                                    <div class="input-box">
                                        <input type="text" name="phone" maxlength="30" autocomplete="tel" id="formPhone" placeholder="08xxxxxxxxxx" required="" value="{{ old('phone') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="formSubject">Layanan yang dibutuhkan</label>
                                    <div class="input-box">
                                        <input type="text" name="service" maxlength="60" required="" id="formSubject"
                                            placeholder="Simpanan, pinjaman, atau keanggotaan" value="{{ old('service') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="formMessage">Pesan</label>
                                    <div class="input-box">
                                        <textarea name="message" id="formMessage" placeholder=""
                                            required="">{{ old('message') }}</textarea>
                                    </div>
                                </div>

                                <div class="button-box">
                                    <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden"
                                        value="">
                                    <button class="btn-one" type="submit" data-loading-text="Mengirim...">
                                        <span class="txt">
                                            Kirim permintaan
                                        </span>
                                    </button>
                                </div>

                            </form>
</div>
</div></div></div></section>
