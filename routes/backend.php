<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\PegawaiController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\CriteriaController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\MenuBuilderController;
use App\Http\Controllers\Backend\SubCriteriaController;
use App\Http\Controllers\Backend\GapScoreController;
use App\Http\Controllers\Backend\RatingController;

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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Roles and Users
Route::resource('roles', RoleController::class)->except(['show']);
Route::resource('users', UserController::class);

// Backups
Route::resource('backups', BackupController::class)->only(['index', 'store', 'destroy']);
Route::delete('backups', [BackupController::class, 'clean'])->name('backups.clean');
Route::get('backups/{file_name}', [BackupController::class, 'download'])->name('backups.download');

// Profile
Route::get('profile/', [ProfileController::class, 'index'])->name('profile.index');
Route::post('profile/', [ProfileController::class, 'update'])->name('profile.update');

// Criteria
Route::resource('criteria', CriteriaController::class);

// Sub Criterial
Route::group(['as' => 'sub-criteria.', 'prefix' => 'sub-criteria'], function() {
    Route::get('/', [SubCriteriaController::class, 'index'])->name('index');
    Route::get('create', [SubCriteriaController::class, 'create'])->name('create');
    Route::get('{id}/edit', [SubCriteriaController::class, 'edit'])->name('edit');
    Route::post('store', [SubCriteriaController::class, 'store'])->name('store');
    Route::put('{id}/update', [SubCriteriaController::class, 'update'])->name('update');
    Route::delete('{id}/destroy', [SubCriteriaController::class, 'destroy'])->name('destroy');
});

// Gap Score
Route::group(['as' => 'gap-score.', 'prefix' => 'gap-score'], function() {
    Route::get('/', [GapScoreController::class, 'index'])->name('index');
});

// Penilaian
Route::group(['as' => 'rating.', 'prefix' => 'rating'], function() {
    Route::get('/', [RatingController::class, 'index'])->name('index');
});

// Security
Route::get('profile/security', [ProfileController::class, 'changePassword'])->name('profile.password.change');
Route::post('profile/security', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

// Pages
Route::resource('pages', PageController::class)->except(['show']);

// Menu Builder
Route::resource('menus', MenuController::class)->except(['show']);
Route::post('menus/{menu}/order', [MenuController::class, 'orderItem'])->name('menus.order');
Route::group(['as' => 'menus.', 'prefix' => 'menus/{id}/'], function () {
    Route::get('builder', [MenuBuilderController::class, 'index'])->name('builder');
    // Menu Item
    Route::group(['as' => 'item.', 'prefix' => 'item'], function () {
        Route::get('/create', [MenuBuilderController::class, 'itemCreate'])->name('create');
        Route::post('/store', [MenuBuilderController::class, 'itemStore'])->name('store');
        Route::get('/{itemId}/edit', [MenuBuilderController::class, 'itemEdit'])->name('edit');
        Route::put('/{itemId}/update', [MenuBuilderController::class, 'itemUpdate'])->name('update');
        Route::delete('/{itemId}/destroy', [MenuBuilderController::class, 'itemDestroy'])->name('destroy');
    });
});

// Settings
Route::group(['as' => 'settings.', 'prefix' => 'settings'], function () {
    Route::get('general', [SettingController::class, 'index'])->name('index');
    Route::patch('general', [SettingController::class, 'update'])->name('update');

    Route::get('appearance', [SettingController::class, 'appearance'])->name('appearance.index');
    Route::patch('appearance', [SettingController::class, 'updateAppearance'])->name('appearance.update');

    Route::get('mail', [SettingController::class, 'mail'])->name('mail.index');
    Route::patch('mail', [SettingController::class, 'updateMailSettings'])->name('mail.update');

    Route::get('socialite', [SettingController::class, 'socialite'])->name('socialite.index');
    Route::patch('socialite', [SettingController::class, 'updateSocialiteSettings'])->name('socialite.update');
});
