<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\CriteriaController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SubCriteriaController;
use App\Http\Controllers\Backend\IntegrityController;
use App\Http\Controllers\Backend\EvaluationController;

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

// Sub Criteria
Route::resource('sub-criteria', SubCriteriaController::class);

// Pembobotan Nilai
Route::resource('integrity', IntegrityController::class);

// Penilaian
Route::group(['as' => 'evaluation.', 'prefix' => 'evaluation'], function () {
    Route::get('/', [EvaluationController::class, 'index']);
    Route::get('/evaluate/{id}', [EvaluationController::class, 'evaluate'])->name('evaluate');
    Route::post('/evaluate', [EvaluationController::class, 'storeEvaluate'])->name('store');
    Route::get('/detail/{id}', [EvaluationController::class, 'detailEvaluation']);
    Route::get('/detail/edit/{id}', [EvaluationController::class, 'Edit']);
    Route::post('/evaluate/update/{id}', [EvaluationController::class, 'updateEvaluate'])->name('evaluate.update');
});


// Security
Route::get('profile/security', [ProfileController::class, 'changePassword'])->name('profile.password.change');
Route::post('profile/security', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

// Settings
Route::group(['as' => 'settings.', 'prefix' => 'settings'], function () {
    Route::get('general', [SettingController::class, 'index'])->name('index');
    Route::patch('general', [SettingController::class, 'update'])->name('update');

    Route::get('appearance', [SettingController::class, 'appearance'])->name('appearance.index');
    Route::patch('appearance', [SettingController::class, 'updateAppearance'])->name('appearance.update');

    Route::get('mail', [SettingController::class, 'mail'])->name('mail.index');
    Route::patch('mail', [SettingController::class, 'updateMailSettings'])->name('mail.update');
});
