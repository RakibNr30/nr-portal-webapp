<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Dashboard routes...
Route::resource('dashboard', 'DashboardController')->only(['index']);
// Slider routes...
Route::resource('slider', 'SliderController');
// Menu routes...
Route::resource('menu', 'MenuController');
// MenuLink routes...
Route::resource('menu-link', 'MenuLinkController');
// PageCategory routes...
Route::resource('page-category', 'PageCategoryController');
// Page routes...
Route::resource('page', 'PageController');
// ContentCategory routes...
Route::resource('content-category', 'ContentCategoryController');
// Content routes...
Route::resource('content', 'ContentController');
// Faq routes...
Route::resource('faq', 'FaqController');
// Testimonial routes...
Route::resource('testimonial', 'TestimonialController');

// Project routes
Route::prefix('project')->name('project-')->group(function () {
    // pending routes...
    Route::resource('pending', 'PendingProjectController')->except(['create', 'edit']);
    Route::put('pending/approve/{id}', 'PendingProjectController@approve')->name('pending.approve');
    // approved routes...
    Route::resource('approved', 'ApprovedProjectController')->except(['create', 'edit']);
    Route::put('approved/files-update/{id}', 'ApprovedProjectController@filesUpdate')->name('approved.filesUpdate');
    Route::put('approved/approve-by-client/{id}', 'ApprovedProjectController@approveByClient')->name('approved.approveByClient');
    // accepted routes...
    Route::resource('accepted', 'AcceptedProjectController')->except(['create', 'edit']);
});

// create project routes...
Route::resource('project', 'CreateProjectController')->only(['create', 'store']);
// create routes...
Route::resource('mail-template', 'MailContentController')->only(['index', 'update']);