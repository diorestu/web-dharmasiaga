<?php

use App\Http\Controllers\CmsController;
use App\Http\Controllers\SavingsController;
use App\Http\Controllers\SeoController;
use App\Models\SiteContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('seo.sitemap');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('seo.robots');
Route::get('/llms.txt', [SeoController::class, 'llms'])->name('seo.llms');

Route::get('/', function () {
    $content = SiteContent::pluck('value', 'key')->all();

    return view('home', compact('content'));
})->name('home');
Route::get('/blog', fn () => view('blog.index', ['posts' => [
    ['title' => 'Membaca laporan tahunan koperasi', 'excerpt' => 'Panduan singkat memahami laporan yang dibagikan kepada anggota.', 'date' => '18 Sep 2026'],
    ['title' => 'Mengapa simpanan anggota penting?', 'excerpt' => 'Cara simpanan membangun daya tawar dan layanan bersama.', 'date' => '04 Sep 2026'],
    ['title' => 'Catatan dari cabang kami', 'excerpt' => 'Cerita lapangan dari tim yang mendampingi anggota.', 'date' => '21 Agu 2026'],
]]))->name('blog.index');
Route::view('/tentang-kami', 'pages.about')->name('pages.about');
Route::view('/sejarah-kami', 'pages.history')->name('pages.history');
Route::view('/simpanan', 'pages.savings')->name('pages.savings');
Route::get('/simpanan/{service}', [SavingsController::class, 'show'])->name('pages.savings.show');
Route::view('/kantor-cabang', 'pages.branches')->name('pages.branches');
Route::post('/hubungi-kami', function (Request $request) {
    $request->validate(['name' => ['required', 'string', 'max:100'], 'phone' => ['required', 'string', 'max:30'], 'email' => ['nullable', 'email', 'max:120'], 'service' => ['required', 'string', 'max:60']]);

    return back()->with('contact_status', 'Terima kasih. Tim KSP Dharma Siaga akan menindaklanjuti permintaan Anda.');
})->name('contact.submit');
Route::get('/admin', [CmsController::class, 'edit'])->name('admin.edit');
Route::post('/admin', [CmsController::class, 'update'])->name('admin.update');
