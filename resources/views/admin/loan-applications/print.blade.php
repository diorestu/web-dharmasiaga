<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Pinjaman #{{ $application->reference_number }} — KSP Dharma Siaga</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 10mm 12mm;
        }
        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
            color: #111;
        }
        body {
            margin: 0;
            padding: 0;
            font-size: 11px;
            line-height: 1.35;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #0d7a46;
            padding-bottom: 8px;
            margin-bottom: 8px;
        }
        .header-brand h1 {
            margin: 0;
            font-size: 20px;
            color: #0b2d4d;
            font-weight: 900;
            letter-spacing: -0.5px;
        }
        .header-brand p {
            margin: 2px 0 0;
            font-size: 12px;
            font-weight: bold;
            color: #0d7a46;
            letter-spacing: 1px;
        }
        .header-meta {
            text-align: right;
            font-size: 9.5px;
            color: #444;
            line-height: 1.3;
        }
        .form-title-bar {
            background-color: #0d7a46;
            color: #fff;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            letter-spacing: 1.5px;
            padding: 6px;
            border-radius: 20px;
            margin: 8px 0 10px;
        }
        .intro-text {
            font-size: 11px;
            margin-bottom: 6px;
        }
        .section-header {
            background-color: #0d7a46;
            color: #fff;
            font-weight: bold;
            font-size: 11px;
            padding: 3px 8px;
            border-radius: 4px;
            margin: 6px 0 4px;
            display: inline-block;
        }
        table.form-grid {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }
        table.form-grid td {
            padding: 2px 4px;
            vertical-align: top;
            font-size: 10.5px;
        }
        td.label {
            width: 170px;
            color: #222;
        }
        td.colon {
            width: 12px;
            text-align: center;
        }
        td.value {
            border-bottom: 1px dotted #888;
            font-weight: bold;
            color: #000;
        }
        .declaration {
            font-size: 9.5px;
            text-align: justify;
            margin: 8px 0 12px;
            line-height: 1.35;
        }
        .signature-grid {
            width: 100%;
            display: flex;
            justify-content: space-between;
            text-align: center;
            margin-bottom: 15px;
        }
        .signature-box {
            width: 30%;
        }
        .signature-line {
            margin-top: 45px;
            border-bottom: 1px solid #333;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
        .requirements-box {
            border: 1px solid #0d7a46;
            border-radius: 6px;
            padding: 6px 8px;
            display: flex;
            justify-content: space-between;
            font-size: 9px;
            background-color: #f6fbf7;
        }
        .req-list {
            width: 58%;
        }
        .notes-list {
            width: 38%;
            border-left: 1px dashed #0d7a46;
            padding-left: 8px;
        }
        .footer-info {
            display: flex;
            justify-content: space-between;
            font-size: 8.5px;
            color: #555;
            margin-top: 8px;
            padding-top: 4px;
            border-top: 1px solid #ccc;
        }
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <div class="no-print" style="padding: 10px; background: #e0f2fe; text-align: center; margin-bottom: 10px;">
        <button onclick="window.print()" style="padding: 8px 16px; background: #0d7a46; color: #fff; border: 0; border-radius: 4px; font-weight: bold; cursor: pointer;">
            🖨️ Cetak Formulir (Print)
        </button>
        <button onclick="window.close()" style="padding: 8px 16px; background: #64748b; color: #fff; border: 0; border-radius: 4px; cursor: pointer; margin-left: 8px;">
            Tutup
        </button>
    </div>

    <div class="header">
        <div class="header-brand">
            <h1>KSP DHARMA SIAGA</h1>
            <p>KOPERASI SIMPAN PINJAM</p>
            <div style="font-size: 9.5px; color: #333; margin-top: 2px;">Close Coop Coop</div>
        </div>
        <div class="header-meta">
            <div>Telp: {{ config('cooperative.office.telephone_display') }}</div>
            <div>WA: {{ config('cooperative.office.whatsapp_display') }}</div>
            <div>AHU-0002758.AH.01.28.TAHUN 2021</div>
            <div>BH. No.56/505/DISKOP.PKM, 19 Januari 2004</div>
            <div style="margin-top: 3px; font-weight: bold; color: #0d7a46;">REF: {{ $application->reference_number }}</div>
        </div>
    </div>

    <div class="form-title-bar">
        FORMULIR PERMOHONAN PINJAMAN
    </div>

    <div class="intro-text">Yang bertanda tangan dibawah ini :</div>

    <!-- A. DATA PEMINJAM -->
    <div class="section-header">A. DATA PEMINJAM</div>
    <table class="form-grid">
        <tr>
            <td class="label">1. Nama</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->name }}</td>
        </tr>
        <tr>
            <td class="label">2. Pekerjaan/Usaha</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->occupation === 'dll' ? $application->occupation_other : $application->occupation }}</td>
        </tr>
        <tr>
            <td class="label">3. Alamat Sekarang</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->current_address }}</td>
        </tr>
        <tr>
            <td class="label">4. Alamat Asal</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->origin_address }}</td>
        </tr>
        <tr>
            <td class="label">5. Alamat Korespondensi</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->correspondence_address ?: 'Sama dengan alamat sekarang' }}</td>
        </tr>
        <tr>
            <td class="label">6. No. Telp</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->phone }}</td>
        </tr>
        <tr>
            <td class="label">7. Jumlah Pinjaman</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->formatted_loan_amount }}</td>
        </tr>
        <tr>
            <td class="label">8. Tujuan Pinjaman</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->loan_purpose }}</td>
        </tr>
        <tr>
            <td class="label">9. Jangka Waktu</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->loan_term_months }} Bulan</td>
        </tr>
        <tr>
            <td class="label">10. Agunan Pinjaman</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->collateral_type }} {{ $application->collateral_description ? "({$application->collateral_description})" : '' }}</td>
        </tr>
        <tr>
            <td class="label">11. Skema Pembayaran</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->payment_scheme }}</td>
        </tr>
        <tr>
            <td class="label">12. Nama Ibu Kandung</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->mother_maiden_name }}</td>
        </tr>
        <tr>
            <td class="label">13. Tanggal Pengajuan</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->application_date ? $application->application_date->translatedFormat('d F Y') : date('d F Y') }}</td>
        </tr>
    </table>

    <!-- B. PENANGGUNG JAWAB -->
    <div class="section-header">B. PENANGGUNG JAWAB</div>
    <table class="form-grid">
        <tr>
            <td class="label">14. Nama Penanggung Jawab</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->guarantor_name }}</td>
        </tr>
        <tr>
            <td class="label">15. Pekerjaan</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->guarantor_occupation ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">16. Alamat Sekarang</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->guarantor_current_address ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">17. Alamat Asal</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->guarantor_origin_address ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">18. No. Telp.</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->guarantor_phone ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">19. Hubungan Dengan Peminjam</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->guarantor_relationship ?: '-' }}</td>
        </tr>
    </table>

    <!-- C. AHLI WARIS -->
    <div class="section-header">C. AHLI WARIS</div>
    <table class="form-grid">
        <tr>
            <td class="label">20. Nama Ahli Waris</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->heir_name }}</td>
        </tr>
        <tr>
            <td class="label">21. Pekerjaan</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->heir_occupation ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">22. Alamat Sekarang</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->heir_current_address ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">23. Alamat Asal</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->heir_origin_address ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">24. No. Telp.</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->heir_phone ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">25. Hubungan Dengan Peminjam</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->heir_relationship ?: '-' }}</td>
        </tr>
    </table>

    <!-- D. DATA KELUARGA LAIN YANG BISA DIHUBUNGI -->
    <div class="section-header">D. DATA KELUARGA LAIN YANG BISA DIHUBUNGI</div>
    <table class="form-grid">
        <tr>
            <td class="label">26. Nama Saudara Kandung</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->emergency_sibling_name ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">27. Alamat</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->emergency_sibling_address ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">28. No Telp.</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->emergency_sibling_phone ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">29. Nama Saudara Lain</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->emergency_other_name ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">30. Alamat</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->emergency_other_address ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">31. No Telp.</td>
            <td class="colon">:</td>
            <td class="value">{{ $application->emergency_other_phone ?: '-' }}</td>
        </tr>
    </table>

    <div class="declaration">
        Dengan ini saya menyatakan bahwa informasi ini adalah benar dan saya memberi persetujuan/kuasa kepada koperasi untuk menghubungi sumber manapun yang dianggap perlu untuk menegaskan kebenarannya.
        Demikian permohonan pinjaman ini saya ajukan dan apabila disetujui saya bersedia mentaati segala ketentuan yang berlaku.
    </div>

    <div class="signature-grid">
        <div class="signature-box">
            <div>Penanggung jawab,</div>
            <div class="signature-line"></div>
            <div style="margin-top: 4px;">({{ $application->guarantor_name }})</div>
        </div>
        <div class="signature-box">
            <div>Persetujuan,</div>
            <div class="signature-line"></div>
            <div style="margin-top: 4px;">(.......................................)</div>
        </div>
        <div class="signature-box">
            <div>Yang meminta pinjaman,</div>
            <div class="signature-line"></div>
            <div style="margin-top: 4px;">({{ $application->name }})</div>
        </div>
    </div>

    <div class="requirements-box">
        <div class="req-list">
            <strong>Persyaratan yang harus dilampirkan : 1 Lembar Foto Copy</strong>
            <ul style="margin: 2px 0 0; padding-left: 14px;">
                <li>KTP Peminjam (Suami Istri) dan Penanggung Jawab</li>
                <li>Kartu Keluarga atau Surat Nikah</li>
                <li>Jaminan (BPKB & STNK Sertifikat)</li>
                <li>Denah Lokasi</li>
                <li>Slip Gaji dan Bersedia di Survey</li>
            </ul>
        </div>
        <div class="notes-list">
            <strong>Note / Catatan :</strong>
            <div style="margin-top: 3px; font-style: italic;">
                {{ $application->notes ?: ($application->admin_notes ?: 'Formulir terdaftar secara online.') }}
            </div>
        </div>
    </div>

    <div class="footer-info">
        <span>Facebook: {{ config('cooperative.social_media.facebook.handle') }}</span>
        <span>Instagram: {{ config('cooperative.social_media.instagram.handle') }}</span>
        <span>Kantor: {{ config('cooperative.office.address') }}</span>
    </div>

</body>
</html>
