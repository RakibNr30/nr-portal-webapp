<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Slider routes...
Route::apiResource('slider', 'Api\SliderController');
// Menu routes...
Route::apiResource('menu', 'Api\MenuController');
// MenuLink routes...
Route::apiResource('menu-link', 'Api\MenuLinkController');
// PageCategory routes...
Route::apiResource('page-category', 'Api\PageCategoryController');
// Page routes...
Route::apiResource('page', 'Api\PageController');
// ContentCategory routes...
Route::apiResource('content-category', 'Api\PublicationCategoryController');
// Content routes...
Route::apiResource('content', 'Api\PublicationController');
// ArticleCategory routes...
Route::apiResource('article-type', 'Api\ArticleTypeController');
// Article routes...
Route::apiResource('article', 'Api\ArticleController');
// ArticleView routes...
Route::apiResource('article-view', 'Api\ArticleViewController');
// Faq routes...
Route::apiResource('faq', 'Api\FaqController');
// Quote routes...
Route::apiResource('quote', 'Api\QuoteController');
// Testimonial routes...
Route::apiResource('testimonial', 'Api\TestimonialController');
// ImportantPerson routes...
Route::apiResource('important-person', 'Api\ImportantPersonController');
