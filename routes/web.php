<?php

use App\Http\Controllers\InquiryController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'landing')->name('home');
Route::view('/try-a-free-class', 'free-class')->name('free-class');
Route::view('/privacy', 'privacy')->name('privacy');
Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');
