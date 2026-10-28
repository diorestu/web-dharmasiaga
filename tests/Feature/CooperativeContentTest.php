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
        $this->get('/sejarah-kami')->assertSee('18 Oktober 2003');
        $this->get('/simpanan')->assertSee('Simpanan Duka Anggota (SIDUTA)');
        $this->get('/')->assertSee(route('pages.history'), false)->assertSee(route('pages.savings'), false);
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
        $response->assertSeeText('Pinjaman: Rp20–<50 juta = 1,6% (maks. 3 th); Rp50–<100 juta = 1,5% (maks. 5 th); Rp100–200 juta = 1,4% (maks. 5 th) per bulan.');
        $response->assertSeeText('Masukkan pinjaman antara Rp20.000.000 dan Rp200.000.000.');
    }
}
