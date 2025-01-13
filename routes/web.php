<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\authentications\Main as AuthMain;
use App\Http\Controllers\campaigns\Main as CampaignMain;
use App\Http\Controllers\report\Main as ReportMain;
use App\Http\Controllers\payment\Main as PaymentMain;
use App\Http\Controllers\profile\Main as ProfileMain;
use App\Http\Controllers\guides\Main as GuideMain;

// Main Page Route
Route::get('/', [Analytics::class, 'index'])->name('dashboard');
Route::prefix('/campaigns')->group(function () {
  Route::get('/', [CampaignMain::class, 'index'])->name('campaigns');
  Route::get('/list', [CampaignMain::class, 'getCampaigns'])->name('campaigns-list');
  Route::get('/{id}', [CampaignMain::class, 'detail'])->name('campaigns-detail');
});

Route::prefix('/report')->group(function () {
  Route::get('/performance', [ReportMain::class, 'performance'])->name('report-performance');
  Route::get('/order', [ReportMain::class, 'order'])->name('report-order');
});

Route::prefix('/payment')->group(function () {
  Route::get('/', [PaymentMain::class, 'index'])->name('payment');
});

Route::prefix('/profile')->group(function () {
  Route::get('/', [ProfileMain::class, 'index'])->name('profile');
  Route::get('/change-password', [ProfileMain::class, 'changePass'])->name('change-password');
});

Route::get('/login', [AuthMain::class, 'login'])->name('login');
Route::get('/register', [AuthMain::class, 'register'])->name('register');
Route::get('/forgot-password', [AuthMain::class, 'forgotPassword'])->name('forgot-password');

Route::get('/terms-of-service', [GuideMain::class, 'termsOfService'])->name('terms-of-service');
Route::get('/privacy-policy', [GuideMain::class, 'privacyPolicy'])->name('privacy-policy');
