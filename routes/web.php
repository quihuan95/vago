<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\TrainingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Trang chủ
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Giới thiệu
|--------------------------------------------------------------------------
*/
Route::prefix('gioi-thieu')->name('about.')->group(function () {
    Route::get('/gioi-thieu-chung', [AboutController::class, 'gioiThieuChung'])->name('gioi-thieu-chung');
    Route::get('/thu-chu-tich', [AboutController::class, 'thuChuTich'])->name('thu-chu-tich');
    Route::get('/ban-chap-hanh', [AboutController::class, 'banChapHanh'])->name('ban-chap-hanh');
});

/*
|--------------------------------------------------------------------------
| Đào tạo
|--------------------------------------------------------------------------
*/
Route::prefix('dao-tao')->name('training.')->group(function () {
    Route::get('/', [TrainingController::class, 'index'])->name('index');
    Route::get('/{slug}', [TrainingController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| Hội viên
|--------------------------------------------------------------------------
*/
Route::prefix('hoi-vien')->name('member.')->group(function () {
    Route::get('/the-le', [MemberController::class, 'theLe'])->name('the-le');
    Route::get('/dang-ky', [MemberController::class, 'registerForm'])->name('register');
    Route::post('/dang-ky', [MemberController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('store');
});

/*
|--------------------------------------------------------------------------
| Thư viện ảnh
|--------------------------------------------------------------------------
*/
Route::prefix('thu-vien')->name('gallery.')->group(function () {
    Route::get('/', [GalleryController::class, 'index'])->name('index');
    Route::get('/{slug}', [GalleryController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| Tin tức – Thông báo
|--------------------------------------------------------------------------
*/
Route::prefix('tin-tuc-thong-bao')->name('news.')->group(function () {
    Route::get('/thong-bao', [NewsController::class, 'thongBao'])->name('thong-bao');
    Route::get('/hoat-dong', [NewsController::class, 'hoatDong'])->name('hoat-dong');
    Route::get('/{slug}', [NewsController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| Liên hệ
|--------------------------------------------------------------------------
*/
Route::prefix('lien-he')->name('contact.')->group(function () {
    Route::get('/', [ContactController::class, 'show'])->name('show');
    Route::post('/', [ContactController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('store');
});

/*
|--------------------------------------------------------------------------
| Tìm kiếm
|--------------------------------------------------------------------------
*/
Route::get('/tim-kiem', [SearchController::class, 'index'])->name('search');

/*
|--------------------------------------------------------------------------
| Chuyển đổi ngôn ngữ
|--------------------------------------------------------------------------
*/
Route::match(['get', 'post'], '/locale/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');

/*
|--------------------------------------------------------------------------
| Chuyển hướng ra ngoài (microsite / tạp chí)
|--------------------------------------------------------------------------
*/
Route::get('/vago-2026', [RedirectController::class, 'vago2026'])->name('vago2026');
Route::get('/tap-chi-vago', [RedirectController::class, 'journal'])->name('journal');

/*
|--------------------------------------------------------------------------
| Sitemap & SEO
|--------------------------------------------------------------------------
*/
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

/*
|--------------------------------------------------------------------------
| Redirect 301 từ URL cũ sang cấu trúc mới
|--------------------------------------------------------------------------
*/
Route::redirect('/gioi-thieu', '/gioi-thieu/gioi-thieu-chung', 301);
Route::redirect('/lanh-dao-hoi', '/gioi-thieu/ban-chap-hanh', 301);
Route::redirect('/thu-cua-chu-tich-hoi', '/gioi-thieu/thu-chu-tich', 301);
Route::redirect('/tin-tuc', '/tin-tuc-thong-bao/thong-bao', 301);
Route::redirect('/thu-vien-anh', '/thu-vien', 301);
Route::get('/tap-chi-phu-san', [RedirectController::class, 'journal'])->name('legacy.tap-chi');
