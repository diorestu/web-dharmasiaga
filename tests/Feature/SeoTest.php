<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_have_unique_metadata_and_canonical_urls(): void
    {
        config(['seo.indexable' => true]);
        $titles = [];
        $descriptions = [];
        $paths = ['/', '/tentang-kami', '/sejarah-kami', '/simpanan', '/pinjaman', '/membership', '/kantor-cabang', '/blog'];
        foreach (config('cooperative.savings') as $product) {
            $paths[] = '/simpanan/'.$product['id'];
        }

        foreach ($paths as $path) {
            $response = $this->get($path.'?utm_source=test')->assertOk();
            $document = new \DOMDocument;
            @$document->loadHTML($response->getContent());
            $xpath = new \DOMXPath($document);
            $canonical = $xpath->query('//link[@rel="canonical"]')->item(0);
            $this->assertNotNull($canonical);
            $this->assertSame('https://kspdharmasiaga.com'.($path === '/' ? '' : $path), $canonical->getAttribute('href'));
            $titles[] = $xpath->query('//title')->item(0)->textContent;
            $descriptions[] = $xpath->query('//meta[@name="description"]')->item(0)->getAttribute('content');
            $this->assertSame(1, $xpath->query('//h1')->length);
            $this->assertSame('summary_large_image', $xpath->query('//meta[@name="twitter:card"]')->item(0)->getAttribute('content'));
            $response->assertSee('https://kspdharmasiaga.com/images/og-dharma-siaga.jpg', false);
            $this->assertSame(1, $xpath->query('//script[@type="application/ld+json"]')->length);
            foreach ($xpath->query('//script[@type="application/ld+json"]') as $script) {
                $data = json_decode($script->textContent, true, flags: JSON_THROW_ON_ERROR);
                $this->assertSame('https://schema.org', $data['@context']);
            }
        }

        $this->assertCount(count($paths), array_unique($titles));
        $this->assertCount(count($paths), array_unique($descriptions));
    }

    public function test_sitemap_lists_only_canonical_public_urls(): void
    {
        $response = $this->get('/sitemap.xml')->assertOk()->assertHeader('Content-Type', 'application/xml; charset=UTF-8');
        $xml = simplexml_load_string($response->getContent());
        $this->assertNotFalse($xml);
        $urls = array_map(fn ($url) => (string) $url->loc, iterator_to_array($xml->url, false));
        $this->assertCount(14, $urls);
        $this->assertContains('https://kspdharmasiaga.com/pinjaman', $urls);
        $this->assertContains('https://kspdharmasiaga.com/membership', $urls);
        $this->assertContains('https://kspdharmasiaga.com/simpanan/siduta', $urls);
        $this->assertNotContains('https://kspdharmasiaga.com/admin', $urls);
        foreach ($urls as $url) {
            $this->assertStringStartsWith('https://kspdharmasiaga.com', $url);
            $this->get(parse_url($url, PHP_URL_PATH) ?: '/')->assertOk();
        }
    }

    public function test_robots_advertises_sitemap_and_blocks_admin(): void
    {
        config(['seo.indexable' => true]);

        $this->get('/robots.txt')->assertOk()
            ->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
            ->assertSee('Sitemap: https://kspdharmasiaga.com/sitemap.xml', false)
            ->assertSee('Disallow: /admin', false);
    }

    public function test_non_indexable_environments_and_admin_send_noindex(): void
    {
        config(['seo.indexable' => false]);
        $this->get('/')->assertHeader('X-Robots-Tag', 'noindex, nofollow');
        $this->get('/robots.txt')->assertSee("Disallow: /\n", false);

        config(['seo.indexable' => true]);
        $this->get('/admin')->assertHeader('X-Robots-Tag', 'noindex, nofollow');
        $this->get('/missing-page')->assertHeader('X-Robots-Tag', 'noindex, nofollow');
    }

    public function test_verification_tokens_are_optional_and_escaped(): void
    {
        config(['seo.google_verification' => 'google-test', 'seo.bing_verification' => 'bing-test']);

        $this->get('/')->assertSee('<meta name="google-site-verification" content="google-test">', false)
            ->assertSee('<meta name="msvalidate.01" content="bing-test">', false);
    }

    public function test_social_and_icon_assets_exist_with_expected_dimensions(): void
    {
        $this->assertSame([1200, 630], array_slice(getimagesize(public_path('images/og-dharma-siaga.jpg')), 0, 2));
        $this->assertSame([512, 512], array_slice(getimagesize(public_path('icon-512.png')), 0, 2));
        $this->assertFileExists(public_path('favicon.ico'));
        $manifest = json_decode(file_get_contents(public_path('site.webmanifest')), true, flags: JSON_THROW_ON_ERROR);
        $this->assertSame('KSP Dharma Siaga', $manifest['name']);
        foreach ($manifest['icons'] as $icon) {
            $this->assertFileExists(public_path(ltrim($icon['src'], '/')));
        }
    }

    public function test_llms_directory_links_to_public_services(): void
    {
        $this->get('/llms.txt')->assertOk()->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
            ->assertSee('https://kspdharmasiaga.com/simpanan/siduta', false)
            ->assertDontSee('https://kspdharmasiaga.com/admin', false);
    }

    public function test_structured_data_escapes_html_from_metadata(): void
    {
        config(['seo.pages.home.description' => '</script><script>alert("test")</script>']);

        $response = $this->get('/');

        $response->assertDontSee('</script><script>alert(', false)
            ->assertSee('\\u003C/script\\u003E', false);
    }
}
