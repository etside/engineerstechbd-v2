<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PublicController;
use App\Http\Controllers\Api\AdminApiController;

// Public endpoints
Route::get('/services',     [PublicController::class, 'services']);
Route::get('/products',     [PublicController::class, 'products']);
Route::get('/blog',         [PublicController::class, 'blog']);
Route::get('/blog/{slug}',  [PublicController::class, 'blogPost']);
Route::get('/team',         [PublicController::class, 'team']);
Route::get('/testimonials', [PublicController::class, 'testimonials']);
Route::get('/logos',        [PublicController::class, 'logos']);
Route::post('/contact',     [PublicController::class, 'contact']);

// Auth
Route::post('/auth/login',  [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/auth/user',    [AuthController::class, 'user'])->middleware('auth:sanctum');

// Admin (protected)
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/stats', [AdminApiController::class, 'stats']);

    // Services
    Route::get('/services',           [AdminApiController::class, 'servicesIndex']);
    Route::post('/services',          [AdminApiController::class, 'servicesStore']);
    Route::put('/services/{id}',      [AdminApiController::class, 'servicesUpdate']);
    Route::delete('/services/{id}',   [AdminApiController::class, 'servicesDestroy']);

    // Products
    Route::get('/products',           [AdminApiController::class, 'productsIndex']);
    Route::post('/products',          [AdminApiController::class, 'productsStore']);
    Route::put('/products/{id}',      [AdminApiController::class, 'productsUpdate']);
    Route::delete('/products/{id}',   [AdminApiController::class, 'productsDestroy']);

    // Blog
    Route::get('/blog',               [AdminApiController::class, 'blogIndex']);
    Route::post('/blog',              [AdminApiController::class, 'blogStore']);
    Route::put('/blog/{id}',          [AdminApiController::class, 'blogUpdate']);
    Route::delete('/blog/{id}',       [AdminApiController::class, 'blogDestroy']);

    // Team
    Route::get('/team',               [AdminApiController::class, 'teamIndex']);
    Route::post('/team',              [AdminApiController::class, 'teamStore']);
    Route::put('/team/{id}',          [AdminApiController::class, 'teamUpdate']);
    Route::delete('/team/{id}',       [AdminApiController::class, 'teamDestroy']);

    // Testimonials
    Route::get('/testimonials',       [AdminApiController::class, 'testimonialsIndex']);
    Route::post('/testimonials',      [AdminApiController::class, 'testimonialsStore']);
    Route::put('/testimonials/{id}',  [AdminApiController::class, 'testimonialsUpdate']);
    Route::delete('/testimonials/{id}',[AdminApiController::class, 'testimonialsDestroy']);

    // Logos
    Route::get('/logos',              [AdminApiController::class, 'logosIndex']);
    Route::post('/logos',             [AdminApiController::class, 'logosStore']);
    Route::put('/logos/{id}',         [AdminApiController::class, 'logosUpdate']);
    Route::delete('/logos/{id}',      [AdminApiController::class, 'logosDestroy']);

    // Submissions
    Route::get('/submissions',        [AdminApiController::class, 'submissions']);
    Route::patch('/submissions/{id}', [AdminApiController::class, 'submissionMarkRead']);

    // Settings
    Route::get('/settings',           [AdminApiController::class, 'settingsIndex']);
    Route::post('/settings',          [AdminApiController::class, 'settingsUpdate']);

    // Image upload
    Route::post('/upload',            [AdminApiController::class, 'upload']);

    // Projects
    Route::get('/projects',           [AdminApiController::class, 'projectsIndex']);
    Route::post('/projects',          [AdminApiController::class, 'projectsStore']);
    Route::put('/projects/{id}',      [AdminApiController::class, 'projectsUpdate']);
    Route::delete('/projects/{id}',   [AdminApiController::class, 'projectsDestroy']);
});

// ─── MCP / AI v1 Routes ───────────────────────────────────────────────────────
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\RecommendationController;

Route::prefix('v1')->middleware('throttle:60,1')->group(function () {
    // Public data (same data, versioned)
    Route::get('/services',         [PublicController::class, 'services']);
    Route::get('/services/{id}',    [PublicController::class, 'serviceDetail']);
    Route::get('/products',         [PublicController::class, 'products']);
    Route::get('/products/{id}',    [PublicController::class, 'productDetail']);
    Route::get('/projects',         [PublicController::class, 'projects']);
    Route::get('/projects/{id}',    [PublicController::class, 'projectDetail']);

    // Lead capture
    Route::post('/leads',           [LeadController::class, 'store']);
    Route::get('/leads/{id}',       [LeadController::class, 'show']);

    // AI recommendations
    Route::post('/recommendations/services', [RecommendationController::class, 'services']);
    Route::post('/recommendations/products', [RecommendationController::class, 'products']);
});
