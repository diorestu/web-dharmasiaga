@php
    $whatsappNumber = preg_replace('/\D/', '', $content['whatsapp'] ?? config('cooperative.office.whatsapp_number'));
    if (str_starts_with($whatsappNumber, '0')) {
        $whatsappNumber = '62'.substr($whatsappNumber, 1);
    }
    $whatsappUrl = 'https://wa.me/'.$whatsappNumber.'?text='.rawurlencode('Halo KSP Dharma Siaga, saya ingin informasi keanggotaan.');
@endphp
<div class="contact-info-box-style1">
    <div class="box1"></div>
    <div class="title"><h2>{{ $contactHeading ?? 'Mulai dari percakapan bersama.' }}</h2><p>Ceritakan kebutuhan Anda kepada tim KSP Dharma Siaga.</p></div>
    <ul class="contact-info-1">
        <li><div class="icon"><span class="icon-map"></span></div><div class="text"><p>Alamat kantor</p><h3 class="text-break">{{ config('cooperative.office.address') }}</h3></div></li>
        <li><div class="icon"><span class="icon-phone"></span></div><div class="text"><p>Telepon</p>@foreach(config('cooperative.office.telephones') as $number => $label)<h3><a href="tel:{{ $number }}">{{ $label }}</a></h3>@endforeach</div></li>
        <li><div class="icon"><span class="icon-chatting"></span></div><div class="text"><p>WhatsApp</p><h3><a href="{{ $whatsappUrl }}">{{ config('cooperative.office.whatsapp_display') }}</a></h3></div></li>
        <li><div class="icon"><span class="icon-clock"></span></div><div class="text"><p>Jam layanan</p><h3>Konfirmasikan kepada tim koperasi</h3><span>Sebelum mengunjungi kantor</span></div></li>
    </ul>
    <div class="bottom-box">
        <div class="btn-box">
            <a href="https://www.google.com/maps/search/?api=1&amp;query={{ rawurlencode(config('cooperative.office.address')) }}" target="_blank" rel="noopener noreferrer"><i class="fas fa-map-marker-alt"></i> Buka peta</a>
        </div>
        <div class="mt-3 pt-2">
            <p class="text-muted small mb-2">Sosial Media:</p>
            <div class="d-flex gap-3">
                <a href="{{ config('cooperative.social_media.facebook.url') }}" target="_blank" rel="noopener noreferrer" class="text-primary fs-5" title="Facebook: {{ config('cooperative.social_media.facebook.name') }}"><i class="fab fa-facebook-f"></i></a>
                <a href="{{ config('cooperative.social_media.instagram.url') }}" target="_blank" rel="noopener noreferrer" class="text-danger fs-5" title="Instagram: {{ config('cooperative.social_media.instagram.name') }}"><i class="fab fa-instagram"></i></a>
                <a href="{{ config('cooperative.social_media.tiktok.url') }}" target="_blank" rel="noopener noreferrer" class="text-dark fs-5" title="TikTok: {{ config('cooperative.social_media.tiktok.name') }}"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>
    </div>
</div>
