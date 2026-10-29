<?php

use App\Http\Controllers\Admin\LoanApplicationController as AdminLoanApplicationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\LoanApplicationController;
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
Route::view('/pinjaman', 'pages.loans')->name('pages.loans');
Route::view('/membership', 'pages.membership')->name('pages.membership');
Route::view('/kantor-cabang', 'pages.branches')->name('pages.branches');

// Formulir Pengajuan Pinjaman Kredit (Publik)
Route::get('/pengajuan-kredit', [LoanApplicationController::class, 'create'])->name('loan-applications.create');
Route::post('/pengajuan-kredit', [LoanApplicationController::class, 'store'])->name('loan-applications.store');
Route::get('/pengajuan-kredit/sukses/{reference}', [LoanApplicationController::class, 'success'])->name('loan-applications.success');

Route::post('/hubungi-kami', function (Request $request) {
    $request->validate(['name' => ['required', 'string', 'max:100'], 'phone' => ['required', 'string', 'max:30'], 'email' => ['nullable', 'email', 'max:120'], 'service' => ['required', 'string', 'max:60']]);

    return back()->with('contact_status', 'Terima kasih. Tim KSP Dharma Siaga akan menindaklanjuti permintaan Anda.');
})->name('contact.submit');

// Autentikasi Admin (Tanpa Register)
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [LoginController::class, 'login'])->middleware('throttle:6,1');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/login', fn () => redirect()->route('login'));

// Panel Admin (Wajib Login)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.loan-applications.index'))->name('dashboard');
    Route::get('/pengajuan-kredit', [AdminLoanApplicationController::class, 'index'])->name('loan-applications.index');
    Route::get('/pengajuan-kredit/{loanApplication}', [AdminLoanApplicationController::class, 'show'])->name('loan-applications.show');
    Route::get('/pengajuan-kredit/{loanApplication}/cetak', [AdminLoanApplicationController::class, 'print'])->name('loan-applications.print');
    Route::patch('/pengajuan-kredit/{loanApplication}/status', [AdminLoanApplicationController::class, 'updateStatus'])->name('loan-applications.status');

    Route::get('/cms', [CmsController::class, 'edit'])->name('edit');
    Route::post('/cms', [CmsController::class, 'update'])->name('update');
});
