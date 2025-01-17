<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\authentications\Main as AuthMain;
use App\Http\Controllers\campaigns\Main as CampaignMain;
use App\Http\Controllers\report\Main as ReportMain;
use App\Http\Controllers\payment\Main as PaymentMain;
use App\Http\Controllers\profile\Main as ProfileMain;
use App\Http\Controllers\guides\Main as GuideMain;
use App\Http\Controllers\links\Main as LinkMain;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// Main Page Route

Route::get('/login', [AuthMain::class, 'login'])->name('login');
Route::post('/authenticate', [AuthMain::class, 'authenticate'])->name('authenticate');
Route::get('/register', [AuthMain::class, 'register'])->name('register');
Route::post('/store-user', [AuthMain::class, 'storeUser'])->name('store-user');
Route::post('/logout', [AuthMain::class, 'logout'])->name('logout');
Route::get('/forgot-password', [AuthMain::class, 'forgotPassword'])->name('forgot-password');

Route::get('/email/verify', function () {
  return view('content.authentications.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
  $request->fulfill();

  return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
  $request->user()->sendEmailVerificationNotification();

  return view('content.authentications.re-verify-email');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth', 'verified'])->group(function () {
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
    Route::put('/update-personal-info', [ProfileMain::class, 'updatePersonalInfo'])->name('profile-update-personal-info');
    Route::put('/update-payment-info', [ProfileMain::class, 'updatePaymentInfo'])->name('profile-update-payment-info');
    Route::put('/update-avatar', [ProfileMain::class, 'updateAvatar'])->name('profile-update-avatar');
    Route::get('/change-password', [ProfileMain::class, 'changePass'])->name('change-password');
  });

  Route::get('/terms-of-service', [GuideMain::class, 'termsOfService'])->name('terms-of-service');
  Route::get('/privacy-policy', [GuideMain::class, 'privacyPolicy'])->name('privacy-policy');

  Route::prefix('/links')->group(function () {
    Route::post('/store-history', [LinkMain::class, 'storeHistory'])->name('links-store-history');
  });
});
