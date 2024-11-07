<?php

use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\reedemController;
use App\Http\Controllers\user\userController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PointController;



Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->usertype = 'admin') {
            return redirect()->route('admin.admin-dashboard');
        } else {
            return redirect()->route('dashboard');
        }
    }
    // Jika belum login, arahkan ke halaman login
    return redirect()->route('login');
});



// Route::get('/', function () {
//     if (auth()->check()) {
//         if (auth()->user()->hasRole('admin')) { // Sesuaikan peran jika ada
//             return redirect()->route('admin.admin-dashboard');
//         } else {
//             return redirect()->route('dashboard');
//         }
//     }
//     return redirect()->route('login'); // Arahkan ke halaman login
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth','userMiddleware'])->group(function(){

    Route::get('dashboard',[userController::class,'index'])->name('dashboard');
    Route::get('reedem',[reedemController::class,'index'])->name('reedem');
    Route::post('/points', [PointController::class, 'store'])->name('points.store');
    Route::post('/reedem-point', [PointController::class, 'reedemPoint'])->name('reedem.point');



});

Route::middleware(['auth','adminMiddleware'])->group(function(){

    Route::get('/admin/dashboard',[adminController::class,'index'])->name('admin.admin-dashboard');
    Route::resource('admin', adminController::class);

});





