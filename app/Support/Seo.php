<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Seo
{
    public function url(string $path = ''): string
    {
        return rtrim(config('seo.url'), '/').($path === '/' || $path === '' ? '' : '/'.ltrim($path, '/'));
    }

    /** @return list<array{url: string, label: string}> */
    public function pages(): array
    {
        $pages = [];
        foreach (config('seo.pages') as $name => $page) {
            $pages[] = ['url' => $this->url(route($name, absolute: false)), 'label' => $page['label']];
        }
        foreach (config('cooperative.savings') as $product) {
            $pages[] = ['url' => $this->url(route('pages.savings.show', $product['id'], false)), 'label' => $product['title']];
        }

        return $pages;
    }

    public function isPublicPage(Request $request): bool
    {
        return array_key_exists($request->route()?->getName() ?? '', config('seo.pages')) || $request->routeIs('pages.savings.show');
    }

    /**
     * @param  array<string, string>  $content
     * @return array{title: string, description: string, canonical: string, image: string, robots: string, schema: array<string, mixed>}
     */
    public function metadata(Request $request, array $content = []): array
    {
        $routeName = $request->route()?->getName();
        $page = config('seo.pages')[$routeName] ?? config('seo.pages.home');
        $canonical = $this->url($request->getPathInfo());
        $product = null;
        if ($request->routeIs('pages.savings.show')) {
            $product = collect(config('cooperative.savings'))->firstWhere('id', $request->route('service'));
            if ($product !== null) {
                $page = [
                    'title' => ($product['menu_title'] ?? $product['title']).' — KSP Dharma Siaga',
                    'description' => Str::limit($product['description'], 160),
                    'label' => $product['title'],
                ];
            }
        }
        if ($request->routeIs('home') && ! empty($content['meta_description'])) {
            $page['description'] = $content['meta_description'];
        }

        $organizationId = $this->url().'#organization';
        $websiteId = $this->url().'#website';
        $graph = [
            [
                '@type' => 'Organization', '@id' => $organizationId,
                'name' => 'KSP Dharma Siaga', 'url' => $this->url(),
                'logo' => $this->url('/icon-512.png'),
                'image' => $this->url('/images/og-dharma-siaga.jpg'),
                'telephone' => '+62-361-8466651',
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => 'Jalan Pura Demak Gang I No. 9, Pemecutan Klod',
                    'addressLocality' => 'Denpasar', 'addressRegion' => 'Bali', 'addressCountry' => 'ID',
                ],
            ],
            ['@type' => 'WebSite', '@id' => $websiteId, 'name' => 'KSP Dharma Siaga', 'url' => $this->url(), 'inLanguage' => 'id-ID', 'publisher' => ['@id' => $organizationId]],
            [
                '@type' => 'WebPage', '@id' => $canonical.'#webpage', 'url' => $canonical,
                'name' => $page['title'], 'description' => $page['description'],
                'isPartOf' => ['@id' => $websiteId], 'inLanguage' => 'id-ID',
            ],
        ];
        if (! $request->routeIs('home') && $this->isPublicPage($request)) {
            $items = [['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => $this->url()]];
            if ($product !== null) {
                $items[] = ['@type' => 'ListItem', 'position' => 2, 'name' => 'Simpanan', 'item' => $this->url('/simpanan')];
            }
            $items[] = ['@type' => 'ListItem', 'position' => count($items) + 1, 'name' => $page['label'], 'item' => $canonical];
            $graph[] = ['@type' => 'BreadcrumbList', 'itemListElement' => $items];
        }
        if ($product !== null) {
            $graph[] = [
                '@type' => 'Service', 'name' => $product['title'], 'description' => $product['description'],
                'url' => $canonical, 'provider' => ['@id' => $organizationId], 'areaServed' => 'Denpasar, Bali',
            ];
        }

        return [
            'title' => $page['title'], 'description' => $page['description'],
            'canonical' => $canonical, 'image' => $this->url('/images/og-dharma-siaga.jpg'),
            'robots' => config('seo.indexable') && $this->isPublicPage($request) ? 'index, follow, max-image-preview:large' : 'noindex, nofollow',
            'schema' => ['@context' => 'https://schema.org', '@graph' => $graph],
        ];
    }
}
