<?php
 
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;

 
Route::get('/', function () {
    return view('welcome');
});
 
Route::get('/dashboard', function () {
    return view('admin/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
 
Route::middleware(['auth', 'admin'])->group(function () {
 
    Route::get('admin/dashboard', [HomeController::class, 'index']);
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin/products');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin/products/create');
    Route::post('/admin/products/save', [ProductController::class, 'save'])->name('admin/products/save');
    Route::get('/admin/products/edit/{id}', [ProductController::class, 'edit'])->name('admin/products/edit');
    Route::put('/admin/products/edit/{id}', [ProductController::class, 'update'])->name('admin/products/update');
    Route::get('/admin/products/delete/{id}', [ProductController::class, 'delete'])->name('admin/products/delete');


    Route::get('/admin/employees', [EmployeeController::class, 'index'])->name('admin/employees');
    Route::get('/admin/employees/create', [EmployeeController::class, 'create'])->name('admin/employees/create');
    Route::post('/admin/employees/save', [EmployeeController::class, 'save'])->name('admin/employees/save');
    Route::get('/admin/employees/edit/{id}', [EmployeeController::class, 'edit'])->name('admin/employees/edit');
    Route::put('/admin/employees/edit/{id}', [EmployeeController::class, 'update'])->name('admin/employees/update');
    Route::get('/admin/employees/delete/{id}', [EmployeeController::class, 'delete'])->name('admin/employees/delete');
});
 
require __DIR__.'/auth.php';
