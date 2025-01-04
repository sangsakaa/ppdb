<?php

use App\Models\PeriodePendidikan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\PeriodePendidikanController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormulirController;
use App\Http\Controllers\TemplateSuratController;
use App\Http\Livewire\LocationSelector;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard',[DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard-calon',[DashboardController::class, 'dasboardCalon'])->middleware(['auth', 'verified'])->name('dashboard-calon');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';

// USER MANAGEMENT
Route::get('user-management',[UserManagementController::class,'index'])->middleware(['auth', 'verified'])->name('user-management');
Route::put('/assign-role/{user}', [RoleController::class, 'assignRole'])->name('assign.role');
// Reset Password
Route::post('reset-password', [UserManagementController::class, 'resetPassword'])->name('reset-password');


// ROLE MANAGEMENT
Route::get('role-management',[RoleController::class,'index'])->middleware(['auth', 'verified'])->name('role-management');
Route::get('add-role-management',[RoleController::class,'create'])->middleware(['auth', 'verified'])->name('add-role-management');
Route::post('add-role-management',[RoleController::class,'store'])->middleware(['auth', 'verified'])->name('add-role-management');

// ROLE-PERMISSION
Route::get('permission-role/{role}', [RolePermissionController::class, 'index'])->middleware(['auth', 'verified'])->name('permission-role');
Route::put('/permission-role/{user}', [RolePermissionController::class, 'assignPermission'])->name('permission-role');
// PERMISSION MANAGEMENT
Route::get('permission-management', [PermissionController::class, 'index'])->middleware(['auth', 'verified'])->name('permission-management');
Route::get('add-permission-management', [PermissionController::class, 'create'])->middleware(['auth', 'verified'])->name('add-permission-management');
Route::post('add-permission-management', [PermissionController::class, 'store'])->middleware(['auth', 'verified'])->name('add-permission-management');


// MANAGEMENT PERIODE PENDIDIKAN

Route::get('management-periode-pendidikan',[PeriodePendidikanController::class,'index'])->middleware(['auth','verified'])->name('management-periode-pendidikan');
Route::get('add-periode-pendidikan',[PeriodePendidikanController::class,'create'])->middleware(['auth','verified'])->name('add-periode-pendidikan');
Route::post('add-periode-pendidikan',[PeriodePendidikanController::class,'store'])->middleware(['auth','verified']);
// Route::get('/pilih-periode/{periode}', [PeriodePendidikan::class, 'PilihPeriode'])->name('pilih.periode');
Route::delete('management-periode-pendidikan/{periodePendidikan}',[PeriodePendidikanController::class,'destroy']);




// SET PERIODE
Route::post('setperiode', [AuthenticatedSessionController::class, 'setPeriode'])->middleware(['auth'])->name('setperiode');
Route::post('periode', [AuthenticatedSessionController::class, 'setPeriode'])->middleware(['auth'])->name('periode');

Route::get('/navbar/periode', [PeriodePendidikanController::class, 'getPeriode']);




// MANAGEMENT PPDB
Route::get('daftar-calon-peserta',[FormulirController::class,'index'])->name('daftar-calon-peserta');
// form 1
Route::get('form-pendaftaran/{formulir_ppdb_1}',[FormulirController::class,'create'])->name('form-pendaftaran');
Route::post('form-pendaftaran/{user_id}',[FormulirController::class,'store'])->name('form-pendaftaran');

// form 2
Route::get('form-keterangan-tempat-tinggal/{formulir_ppdb_1}', [FormulirController::class, 'formulir_ppdb_2'])->name('form-keterangan-tempat-tinggal');
Route::post('form-keterangan-tempat-tinggal/{calon_peserta}', [FormulirController::class, 'storeformulir_ppdb_2']);

Route::post('update-registration-status',[FormulirController::class, 'updateStatus'])->name('update-registration-status');
Route::get('validasi-calon-peserta/{calon_peserta}',[FormulirController::class, 'ValidasCalonPeserta'])->name('validasi-calon-peserta');
Route::put('validasi-calon-peserta/{calon_peserta}',[FormulirController::class, 'UpdateValidasiCalonPeserta']);

Route::get('/get-regencies/{provinceId}', [FormulirController::class, 'getRegencies']);
Route::get('/get-districts/{regencyId}', [FormulirController::class, 'getDistricts']);
Route::get('/get-villages/{districtId}', [FormulirController::class, 'getVillages']);

Route::get('/generate-pdf/{calon_peserta}', [FormulirController::class, 'generatePdf']);



// TEMPLATE SURAT
Route::get('surat-pernyataan',[TemplateSuratController::class, 'SuratPernyataan']);






