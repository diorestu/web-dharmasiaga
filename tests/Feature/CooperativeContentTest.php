<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CooperativeContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_overview_shows_members_and_assets_from_the_supplied_data(): void
    {
        $response = $this->get('/');

        $response->assertSee('id="assets"', false)->assertSeeText('Gambaran koperasi')
            ->assertSeeText('Jumlah anggota')->assertSeeText('Aset koperasi')
            ->assertSee('<canvas data-overview-chart="members"', false)
            ->assertSee('<canvas data-overview-chart="assets"', false)
            ->assertSee('id="cooperative-overview-data"', false);
        foreach (['2.902', '3.573', '4.105', '4.356', '84.653.416.322', '99.709.162.452', '111.681.495.129', '116.685.986.612'] as $value) {
            $response->assertSeeText($value);
        }
        $response->assertDontSeeText('Data indikatif')->assertDontSeeText('Rp 18,4 M');
    }

    public function test_history_and_savings_pages_are_accessible_from_navigation(): void
    {
        $this->get('/sejarah-kami')->assertSee('18 Oktober 2003')->assertSeeText('Berawal dari Kebersamaan, Bertumbuh dalam Kepercayaan');
        $this->get('/simpanan')->assertSee('Simpanan Duka Anggota (SIDUTA)');
        $this->get('/')->assertSee(route('pages.history'), false)->assertSee(route('pages.savings'), false)->assertSee(route('pages.loans'), false)->assertSee(route('pages.membership'), false);
    }

    public function test_about_page_shows_leadership_vision_mission_and_legalities(): void
    {
        $response = $this->get('/tentang-kami')->assertOk();

        $response->assertSeeText('Drs. I Gede Suriadnyana, S.E., MM')
            ->assertSeeText('Ni Nyoman Juniari')
            ->assertSeeText('Ni Putu Yuli Astiti')
            ->assertSeeText('Ni Luh Adi Cahyani')
            ->assertSeeText('I Nyoman Suweda')
            ->assertSeeText('I Made Purwa Budaya')
            ->assertSeeText('56/505/DISKOP.PKM')
            ->assertSeeText('AHU-0002758.AH.01.28.TAHUN 2021')
            ->assertSeeText('5171030060093')
            ->assertSeeText('1218000700951')
            ->assertSeeText('02.251.954.0-901.000');
    }

    public function test_loans_page_renders_consumer_and_umkm_loans(): void
    {
        $response = $this->get('/pinjaman')->assertOk();

        $response->assertSeeText('Pinjaman Konsumtif')
            ->assertSeeText('Jaminan BPKB / SHM')
            ->assertSeeText('Slip Gaji untuk Karyawan')
            ->assertSeeText('DS-PINJAMAN-KONSUMTIF')
            ->assertSeeText('Pinjaman UMKM')
            ->assertSeeText('1,4%')
            ->assertSeeText('DS-PINJAMAN-UMKM')
            ->assertSeeText('Tabel Angsuran Pinjaman UMKM')
            ->assertSeeText('JUMLAH ANGSURAN')
            ->assertSeeText('20,000,000')
            ->assertSeeText('1,845,041')
            ->assertSeeText('100,000,000')
            ->assertSeeText('9,110,987');
    }

    public function test_membership_page_renders_plus_silver_and_gold_programs(): void
    {
        $response = $this->get('/membership')->assertOk();

        $response->assertSeeText('Membership Plus')
            ->assertSeeText('BPJS Ketenagakerjaan')
            ->assertSeeText('Rp 42.000.000,-')
            ->assertSeeText('Rp 48.000.000,-')
            ->assertSeeText('Rp 76.000.000,-')
            ->assertSeeText('Rp 174.000.000,-')
            ->assertSeeText('TABEL PINJAMAN MEMBERSHIP PLUS')
            ->assertSeeText('1.000.000 - 25.000.000')
            ->assertSeeText('1,5% - 2%')
            ->assertSeeText('12 - 36 BULAN')
            ->assertSeeText('>100.000.000')
            ->assertSeeText('1,1% - 1,7%')
            ->assertSeeText('Membership Silver')
            ->assertSeeText('1% (menurun)')
            ->assertSeeText('TABEL ANGSURAN PINJAMAN MEMBERSHIP SILVER')
            ->assertSeeText('PLAPON')
            ->assertSeeText('1 Tahun')
            ->assertSeeText('2 Tahun')
            ->assertSeeText('5,000,000')
            ->assertSeeText('474,500')
            ->assertSeeText('265,500')
            ->assertSeeText('15,000,000')
            ->assertSeeText('1,363,000')
            ->assertSeeText('736,500')
            ->assertSeeText('Membership Gold')
            ->assertSeeText('1% (Tetap)');
    }

    public function test_social_media_and_office_contacts_in_footer(): void
    {
        $response = $this->get('/')->assertOk();

        $response->assertSee('https://www.facebook.com/kspdharmasiaga', false)
            ->assertSee('https://www.instagram.com/kspdharmasiaga', false)
            ->assertSee('https://www.tiktok.com/@kspdharmasiaga', false)
            ->assertSee('0361 8466651 – 52');
    }

    public function test_public_contact_links_use_the_official_office_details(): void
    {
        $this->get('/kantor-cabang')
            ->assertSee('Jalan Pura Demak Gang I No. 9')
            ->assertSee('tel:03618466651', false)
            ->assertSee('https://wa.me/6281338728258', false);
    }

    public function test_landing_page_links_to_the_company_profile_video(): void
    {
        $this->get('/')
            ->assertSee('https://www.youtube.com/watch?v=S7J8ypC3x78', false)
            ->assertSee('Putar video company profile KSP Dharma Siaga')
            ->assertSeeText('Video Company Profile')
            ->assertDontSee('ScMzIvxBSi4');
    }

    public function test_simpanan_siaga_simulation_options_start_at_12_months_and_exclude_shorter_periods(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('id="personal-loan"', false);
        $response->assertSee('<option value="12" selected>12 bulan</option>', false);
        $response->assertDontSee('<option value="3">3 bulan</option>', false);
        $response->assertDontSee('<option value="6">6 bulan</option>', false);
        $response->assertDontSee('<option value="9">9 bulan</option>', false);
        $response->assertSee('id="personal-loan-custom-months" type="number" inputmode="numeric" min="12" max="120"', false);
        $response->assertSeeText('Masukkan durasi antara 12 dan 120 bulan.');
    }

    public function test_loan_simulation_fields_and_hints_render_expected_tiers(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('id="home-loan"', false);
        $response->assertSee('id="vehicle-loan"', false);

        // Standard loan uses original rules
        $response->assertSee('data-min-amount="1000000"', false);
        $response->assertSee('value="10.000.000"', false);
        $response->assertSee('value="2"', false);
        $response->assertSee('Rp 945.596', false);
        $response->assertSeeText('Masukkan jumlah pinjaman minimal Rp 1.000.000.');

        // Business loan uses promotional / low interest brochure rules
        $response->assertSee('data-min-amount="20000000"', false);
        $response->assertSee('value="20.000.000"', false);
        $response->assertSee('value="1,6"', false);
        $response->assertSee('Rp 1.845.041', false);
        $response->assertSeeText('Pinjaman bunga rendah: Rp20–50 juta = 1,6% (maks. 3 th); Rp50–100 juta = 1,5% (maks. 5 th); Rp100–200 juta = 1,4% (maks. 5 th) per bulan.');
        $response->assertSeeText('Masukkan pinjaman usaha antara Rp20.000.000 dan Rp200.000.000.');
    }

    public function test_all_pages_render_floating_whatsapp_button_without_wrapper(): void
    {
        $urls = [
            '/',
            '/sejarah-kami',
            '/tentang-kami',
            '/simpanan',
            '/simpanan/simpanan-berjangka',
            '/pinjaman',
            '/membership',
        ];

        foreach ($urls as $url) {
            $response = $this->get($url);
            $response->assertOk();
            $response->assertSee('class="whatsapp-floating-btn"', false);
            $response->assertSee('icons/whatsapp.webp', false);
            $response->assertSee('wa.me/'.config('cooperative.office.whatsapp_number'), false);
        }
    }
}
