<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// TODO: Add privacy/terms as user configurable pages for custom deployments
Route::get('/privacy', function () {
    return view('policy');
})->name('privacy');
Route::get('/terms', function () {
    return view('terms');
})->name('terms');

// Redirect to discord.com at url /discord
Route::get('/discord', function () {
    return redirect('https://discord.gg/yJ4Ub64zrP');
});

Route::get('/github', function () {
    return redirect('https://github.com/mechawrench/wificom-lib');
});

// Docs
Route::get('/docs', function () {
    return view('docs.index');
});
Route::get('/docs.openapi', function () {
    $content = File::get('resources/views/docs/openapi.yaml');

    return response($content);
})->name('docs.openapi.json');
Route::get('/docs.postman', function () {
    $content = File::get('resources/views/docs/collection.json');

    return response($content);
})->name('docs.postman.json');
