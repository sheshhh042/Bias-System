<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\ResearchContoller;
use App\Http\Controllers\ResearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function(){
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::controller(OtpController::class)->group(function(){
    Route::get('otp', 'showOtpForm')->name('otp.verify');
    Route::post('otp', 'verifyOtp')->name('otp.verify');
});

Route::middleware('auth')->group(function(){
    Route::get('dashboard', [ResearchContoller::class, 'index'])->name('dashboard');

    Route::controller(ResearchContoller::class)->prefix('research')->group(function(){
        Route::get('', 'index')->name('research');
        Route::get('create', 'create')->name('research.create');
        Route::post('store', 'store')->name('research.store');
        Route::get('{research}/edit', 'edit')->name('research.edit');
        Route::put('{research}', 'update')->name('research.update');
        Route::delete('{research}', 'destroy')->name('research.destroy');
        Route::get('department/{department}', 'department')->name('research.department');
    });

    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
});

// Test email route
Route::get('/test-email', function () {
    Mail::raw('This is a test email', function ($message) {
        $message->to('your_gmail_username@gmail.com') // Replace with your email address
                ->subject('Test Email');
    });

    return 'Email sent';
});