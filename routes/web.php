<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Includes all Controller
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;

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

Route::get('/', [LoginController::class, 'index'])->name('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// admin
Route::middleware(['auth', 'role:admin'])->group(function () {  
    Route::get('/patient-registration', [AdminController::class, 'viewPatientRegistration'])->name('patient-registration');
    Route::post('/patients-store', [AdminController::class, 'patientstore']);
    Route::get('/patient-information', [AdminController::class, 'viewAdminDashboard'])->name('patient-information');
    Route::get('/patientsrecord', [AdminController::class, '__getAllPatient']);
    Route::get('/editpatient/{id}', [AdminController::class, '__getAndEditPatient']);
    Route::post('/patients/update', [AdminController::class, '__updatePatientInformation']);
    Route::get('/deleteshowpatient/{id}', [AdminController::class, '__getAndShowDeletePatient']);
    Route::post('/patients/delete', [AdminController::class, '__deletePatient']);
    Route::get('/view-patient-info/{id}', [AdminController::class, '__viewPatientInformation']);
    Route::get('/search', [AdminController::class, '__search']);
    Route::post('/searchAdvanced', [AdminController::class, '__advancedSearch']);
});
