<?php

return [
    'url' => env('SEO_URL', 'https://kspdharmasiaga.com'),
    'indexable' => env('SEO_INDEXABLE', env('APP_ENV', 'production') === 'production'),
    'google_verification' => env('GOOGLE_SITE_VERIFICATION'),
    'bing_verification' => env('BING_SITE_VERIFICATION'),
    'pages' => [
        'home' => [
            'title' => 'KSP Dharma Siaga — Koperasi Simpan Pinjam Denpasar, Bali',
            'description' => 'Kenali KSP Dharma Siaga di Denpasar, Bali. Temukan pilihan simpanan, layanan pinjaman anggota, persyaratan, dan lokasi kantor koperasi.',
            'label' => 'Beranda',
        ],
        'pages.about' => [
            'title' => 'Profil, Pengurus dan Pengawas — KSP Dharma Siaga',
            'description' => 'Kenali pengurus dan pengawas, visi, misi, serta legalitas KSP Dharma Siaga, koperasi simpan pinjam di Denpasar, Bali.',
            'label' => 'Profil Koperasi',
        ],
        'pages.history' => [
            'title' => 'Sejarah Koperasi sejak 2003 — KSP Dharma Siaga',
            'description' => 'Baca sejarah KSP Dharma Siaga sejak berdiri sebagai pra-koperasi pada 18 Oktober 2003 dan perkembangannya bersama anggota di Denpasar.',
            'label' => 'Sejarah Kami',
        ],
        'pages.savings' => [
            'title' => 'Pilihan Produk Simpanan Anggota — KSP Dharma Siaga',
            'description' => 'Bandingkan Simpanan Anggota, SIDUTA, Simpanan Sukarela, Simpanan Siaga, Simpanan Berjangka, dan SAHAM. Pelajari manfaat serta persyaratannya.',
            'label' => 'Simpanan',
        ],
        'pages.loans' => [
            'title' => 'Layanan Pinjaman Konsumtif dan Pinjaman UMKM — KSP Dharma Siaga',
            'description' => 'Pinjaman produktif & multiguna serta pinjaman UMKM dengan bunga ringan 1,4%, proses cepat, persyaratan mudah, dan tenor fleksibel hingga 5 tahun di Bali.',
            'label' => 'Pinjaman',
        ],
        'pages.membership' => [
            'title' => 'Membership Plus, Silver, dan Gold — KSP Dharma Siaga',
            'description' => 'Program Membership Plus kolaborasi BPJS Ketenagakerjaan dengan jaminan sosial menyeluruh, serta fasilitas Membership Silver dan Gold dengan bunga 1%.',
            'label' => 'Membership',
        ],
        'pages.branches' => [
            'title' => 'Alamat dan Kontak Kantor Denpasar — KSP Dharma Siaga',
            'description' => 'Temukan alamat kantor KSP Dharma Siaga di Jalan Pura Demak Gang I No. 9, Denpasar, Bali, beserta nomor telepon dan WhatsApp layanan anggota.',
            'label' => 'Lokasi Kantor',
        ],
        'blog.index' => [
            'title' => 'Berita dan Informasi Anggota — KSP Dharma Siaga',
            'description' => 'Baca informasi koperasi, panduan simpanan anggota, dan catatan layanan KSP Dharma Siaga untuk mengenal kegiatan serta layanan koperasi.',
            'label' => 'Berita Koperasi',
        ],
    ],
];
