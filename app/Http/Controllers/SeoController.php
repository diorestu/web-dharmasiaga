<?php

namespace App\Http\Controllers;

use App\Support\Seo;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function sitemap(Seo $seo): Response
    {
        return response()->view('pages.sitemap', ['pages' => $seo->pages()])->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function robots(Seo $seo): Response
    {
        $rules = config('seo.indexable')
            ? "User-agent: *\nAllow: /\nDisallow: /admin\nDisallow: /up\nDisallow: /_debugbar\nDisallow: /telescope\n"
            : "User-agent: *\nDisallow: /\n";

        return response($rules."\nSitemap: ".$seo->url('/sitemap.xml')."\n")->header('Content-Type', 'text/plain; charset=UTF-8');
    }

    public function llms(Seo $seo): Response
    {
        $lines = ['# KSP Dharma Siaga', '', '> Koperasi simpan pinjam di Denpasar, Bali. Informasi resmi layanan dan keanggotaan.', '', '## Halaman publik'];
        foreach ($seo->pages() as $page) {
            $lines[] = '- ['.$page['label'].']('.$page['url'].')';
        }
        $lines[] = '';
        $lines[] = 'Persyaratan, manfaat, dan ketentuan layanan mengikuti informasi pada halaman produk. Panel admin bukan sumber informasi publik.';

        return response(implode("\n", $lines)."\n")->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
