<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\AcademicController as AdminAcademicController;
use App\Http\Controllers\View\AcademicController as ViewAcademicController;
use App\Http\Controllers\Admin\CareerController as AdminCareerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// administrator
Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // gallery
    Route::resource('gallery', AdminGalleryController::class);
    Route::post('gallery-image/{gallery}', [AdminGalleryController::class, 'imageStore'])->name('gallery.image.store');
    Route::delete('gallery-image/{gallery}', [AdminGalleryController::class, 'imageDestroy'])->name('gallery.image.destroy');

    // event
    Route::resource('event', AdminEventController::class);
    Route::post('event-image/{event}', [AdminEventController::class, 'imageStore'])->name('event.image.store');
    Route::delete('event-image/{event}', [AdminEventController::class, 'imageDestroy'])->name('event.image.destroy');

    // academic
    Route::resource('academic', AdminAcademicController::class);
    Route::post('academic-image/{academic}', [AdminAcademicController::class, 'imageStore'])->name('academic.image.store');
    Route::delete('academic-image/{academic}', [AdminAcademicController::class, 'imageDestroy'])->name('academic.image.destroy');        
    Route::get('academics', [AdminAcademicController::class, 'index2'])->name('academic.index2'); 
    
    // career
    Route::resource('career', AdminCareerController::class);
    Route::post('career-image/{career}', [AdminCareerController::class, 'imageStore'])->name('career.image.store');
    Route::delete('career-image/{career}', [AdminCareerController::class, 'imageDestroy'])->name('career.image.destroy');

});

// view
Route::name('view.')->group(function() {
    Route::get('academics', [ViewAcademicController::class, 'index'])->name('academic.index');
});

require __DIR__.'/auth.php';
