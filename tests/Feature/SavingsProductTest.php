<?php

namespace Tests\Feature;

use Tests\TestCase;

class SavingsProductTest extends TestCase
{
    public function test_each_savings_product_has_its_own_details_and_whatsapp_referral(): void
    {
        $codes = [
            'simpanan-anggota' => 'DS-SIMPANAN-ANGGOTA',
            'siduta' => 'DS-SIDUTA',
            'simpanan-sukarela' => 'DS-SIMPANAN-SUKARELA',
            'simpanan-siaga' => 'DS-SIMPANAN-SIAGA',
            'simpanan-berjangka' => 'DS-SIMPANAN-BERJANGKA',
            'saham' => 'DS-SAHAM',
        ];

        foreach (config('cooperative.savings') as $product) {
            $response = $this->get('/simpanan/'.$product['id']);

            $response->assertOk()->assertSeeText($product['title'])
                ->assertSeeText($product['description'])->assertSeeText($codes[$product['id']]);

            foreach ($product['sections'] as $section) {
                $response->assertSeeText($section['title']);
                foreach ($section['items'] as $item) {
                    $response->assertSeeText($item['title']);
                    if ($item['text'] !== '') {
                        $response->assertSeeText($item['text']);
                    }
                }
            }

            if (isset($product['note'])) {
                $response->assertSeeText($product['note']);
            }

            $document = new \DOMDocument;
            @$document->loadHTML($response->getContent());
            $cta = $document->getElementById('savings-whatsapp');
            $this->assertNotNull($cta);
            $url = $cta->getAttribute('href');
            $this->assertStringStartsWith('https://wa.me/6281338728258?', $url);
            parse_str(parse_url($url, PHP_URL_QUERY), $query);
            $this->assertStringContainsString($product['title'], $query['text']);
            $this->assertStringContainsString('Kode referal layanan: '.$codes[$product['id']], $query['text']);
        }
    }

    public function test_unknown_savings_product_returns_not_found(): void
    {
        $this->get('/simpanan/produk-tidak-ada')->assertNotFound();
    }

    public function test_product_menu_and_listing_link_to_individual_pages(): void
    {
        $response = $this->get('/simpanan');

        foreach (config('cooperative.savings') as $product) {
            $response->assertSee('/simpanan/'.$product['id'], false);
        }
    }

    public function test_whatsapp_uses_the_configured_office_number(): void
    {
        config(['cooperative.office.whatsapp_number' => '6281234567890']);

        $this->get('/simpanan/siduta')->assertSee('https://wa.me/6281234567890?', false);
    }

    public function test_simpanan_berjangka_renders_interest_rate_table(): void
    {
        $response = $this->get('/simpanan/simpanan-berjangka')->assertOk();

        $response->assertSeeText('Nominal')
            ->assertSeeText('12 Bulan')
            ->assertSeeText('6 Bulan')
            ->assertSeeText('3 Bulan')
            ->assertSeeText('Rp 1jt - 50jt')
            ->assertSeeText('Rp 50jt - 100jt')
            ->assertSeeText('> Rp 100jt')
            ->assertSeeText('7%')
            ->assertSeeText('6%')
            ->assertSeeText('4%')
            ->assertSeeText('8%');

        $listResponse = $this->get('/simpanan')->assertOk();
        $listResponse->assertSeeText('Rp 1jt - 50jt')
            ->assertSeeText('Rp 50jt - 100jt')
            ->assertSeeText('> Rp 100jt');
    }

    public function test_saham_renders_placement_and_return_table(): void
    {
        $response = $this->get('/simpanan/saham')->assertOk();

        $response->assertSeeText('MINIMAL PENEMPATAN')
            ->assertSeeText('TENOR')
            ->assertSeeText('JASA MODAL')
            ->assertSeeText('RP. 1.000.000,-')
            ->assertSeeText('2 - 4 TAHUN')
            ->assertSeeText('8 %')
            ->assertSeeText('5 TAHUN')
            ->assertSeeText('8,5 %');

        $listResponse = $this->get('/simpanan')->assertOk();
        $listResponse->assertSeeText('MINIMAL PENEMPATAN')
            ->assertSeeText('RP. 1.000.000,-')
            ->assertSeeText('8,5 %');
    }

    public function test_savings_page_cta_has_whatsapp_icon_and_referral(): void
    {
        $response = $this->get('/simpanan')->assertOk();

        $response->assertSee('fa-whatsapp', false)
            ->assertSeeText('Konsultasi WhatsApp')
            ->assertSee('https://wa.me/6281338728258', false);

        $showResponse = $this->get('/simpanan/siduta')->assertOk();
        $showResponse->assertSee('fa-whatsapp', false);
    }
}
