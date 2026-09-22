<?php

use App\Http\Controllers\CmsController;
use Illuminate\Support\Facades\Route;
use App\Models\SiteContent;

Route::get('/', function () {
    $content = SiteContent::pluck('value', 'key')->all();
    return view('home', compact('content'));
})->name('home');
Route::get('/blog', fn () => view('blog.index', ['posts' => [
    ['title' => 'Membaca laporan tahunan koperasi', 'excerpt' => 'Panduan singkat memahami laporan yang dibagikan kepada anggota.', 'date' => '18 Sep 2026'],
    ['title' => 'Mengapa simpanan anggota penting?', 'excerpt' => 'Cara simpanan membangun daya tawar dan layanan bersama.', 'date' => '04 Sep 2026'],
    ['title' => 'Catatan dari cabang kami', 'excerpt' => 'Cerita lapangan dari tim yang mendampingi anggota.', 'date' => '21 Agu 2026'],
]]))->name('blog.index');
Route::get('/admin', [CmsController::class, 'edit'])->name('admin.edit');
Route::post('/admin', [CmsController::class, 'update'])->name('admin.update');
