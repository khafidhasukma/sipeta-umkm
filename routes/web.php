<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UmkmController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VerificationController;
use App\Http\Controllers\Umkm\DashboardController as UmkmDashboard;
use App\Http\Controllers\MapController;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/map', [MapController::class, 'index'])->name('map.index');
Route::get('/map/data', [MapController::class, 'getData'])->name('map.data');

// Guest routes (only for unauthenticated users)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [AuthController::class, 'updatePassword'])->name('profile.password');
    
    // Admin routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
        
        // UMKM Management
        Route::resource('umkm', UmkmController::class);
        
        // User Management
        Route::resource('users', UserController::class)->except(['create', 'store']);
        
        // Verification
        Route::get('/verification', [VerificationController::class, 'index'])->name('verification');
        Route::post('/verification/{umkm}/verify', [VerificationController::class, 'verify'])->name('verification.verify');
        Route::post('/verification/{umkm}/reject', [VerificationController::class, 'reject'])->name('verification.reject');
        
        // Decision Support
        Route::get('/analisis-sentra', [AdminDashboard::class, 'analisisSentra'])->name('analisis.sentra');
        Route::get('/monitoring-alat', [AdminDashboard::class, 'monitoringAlat'])->name('monitoring.alat');
    });
    
    // UMKM routes
    Route::middleware('role:umkm')->prefix('umkm')->name('umkm.')->group(function () {
        Route::get('/dashboard', [UmkmDashboard::class, 'index'])->name('dashboard');
        
        // Profile Management
        Route::get('/profile', [UmkmDashboard::class, 'profile'])->name('profile');
        Route::put('/profile', [UmkmDashboard::class, 'updateProfile'])->name('profile.update');
        
        // Production Tools
        Route::get('/production-tools', [UmkmDashboard::class, 'productionTools'])->name('production-tools.index');
        Route::post('/production-tools', [\App\Http\Controllers\Umkm\ProductionToolController::class, 'store'])->name('production-tools.store');
        Route::put('/production-tools/{productionTool}', [\App\Http\Controllers\Umkm\ProductionToolController::class, 'update'])->name('production-tools.update');
        Route::delete('/production-tools/{productionTool}', [\App\Http\Controllers\Umkm\ProductionToolController::class, 'destroy'])->name('production-tools.destroy');
        
        // Raw Materials
        Route::get('/raw-materials', [UmkmDashboard::class, 'rawMaterials'])->name('raw-materials.index');
        Route::post('/raw-materials', [\App\Http\Controllers\Umkm\RawMaterialController::class, 'store'])->name('raw-materials.store');
        Route::put('/raw-materials/{rawMaterial}', [\App\Http\Controllers\Umkm\RawMaterialController::class, 'update'])->name('raw-materials.update');
        Route::delete('/raw-materials/{rawMaterial}', [\App\Http\Controllers\Umkm\RawMaterialController::class, 'destroy'])->name('raw-materials.destroy');
        
        // Collaboration
        Route::get('/collaboration', [UmkmDashboard::class, 'collaboration'])->name('collaboration');
    });
});
