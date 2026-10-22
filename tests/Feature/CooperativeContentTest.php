<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CooperativeContentTest extends TestCase
{
    use RefreshDatabase;

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
}
