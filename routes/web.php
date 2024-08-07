<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Guest\Pagecontroller;
use App\Http\Controllers\Guest\Projectcontroller as GuestProjectcontroller;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\TechnologyController;
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

Route::get('/', [Pagecontroller::class, 'index'])->name('welcome');
Route::resource('projects', GuestProjectcontroller::class)->only(['index', 'show'])->parameters([
    'projects' => 'project:slug'
]);

Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

        Route::resource('projects', ProjectController::class)->parameters(['projects' => 'project:slug']);

        Route::resource('types', TypeController::class)->only(['index', 'show', 'create', 'store', 'destroy'])->parameters(['types' => 'type:slug']);

        Route::resource('technologies', TechnologyController::class)->parameters(['technologies' => 'technology:slug']);
    });



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
