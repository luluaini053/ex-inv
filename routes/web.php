<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\InvRentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InvReturnController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\InventoryLogController;

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

Route::get('/', [PublicController::class, 'index']);

Route::middleware('new')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticating']);
    Route::get('register', [AuthController::class, 'register']);
    Route::post('register', [AuthController::class, 'registerProcess']);

});

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('profile', [UserController::class, 'profile'])->middleware('client');

    Route::get('inv-rent', [InvRentController::class, 'index'])->middleware('client');
    Route::post('inv-rent', [InvRentController::class, 'store'])->middleware('client');

    Route::middleware('admin')->group(function (){
        Route::get('dashboard', [DashboardController::class, 'index']);

        Route::get('inventory', [InventoryController::class, 'inventory']);
        Route::get('inv-add', [InventoryController::class, 'add']);
        Route::post('inv-add', [InventoryController::class, 'store']);
        Route::get('inv-edit/{slug}', [InventoryController::class, 'edit']);
        Route::put('inv-edit/{slug}', [InventoryController::class, 'update']);
        Route::get('inv-delete/{slug}', [InventoryController::class, 'delete']);
        Route::get('inv-eliminate/{slug}', [InventoryController::class, 'eliminate']);
        Route::get('inv-deleted', [InventoryController::class, 'deletedInv']);
        Route::get('inv-restore/{slug}', [InventoryController::class, 'restore']);


        Route::get('categories', [CategoryController::class, 'cate']);
        Route::get('category-add', [CategoryController::class, 'add']);
        Route::post('category-add', [CategoryController::class, 'store']);
        Route::get('category-edit/{slug}', [CategoryController::class, 'edit']);
        Route::put('category-edit/{slug}', [CategoryController::class, 'update']);
        Route::get('category-delete/{slug}', [CategoryController::class, 'delete']);
        Route::get('category-eliminate/{slug}', [CategoryController::class, 'eliminate']);
        Route::get('category-deleted', [CategoryController::class, 'deleteCategory']);
        Route::get('category-restore/{slug}', [CategoryController::class, 'restore']);

        Route::get('departements', [DepartementController::class, 'depart']);
        Route::get('depart-add', [DepartementController::class, 'add']);
        Route::post('depart-add', [DepartementController::class, 'store']);
        Route::get('depart-edit/{slug}', [DepartementController::class, 'edit']);
        Route::put('depart-edit/{slug}', [DepartementController::class, 'update']);
        Route::get('depart-delete/{slug}', [DepartementController::class, 'delete']);
        Route::get('depart-eliminate/{slug}', [DepartementController::class, 'eliminate']);
        Route::get('depart-deleted', [DepartementController::class, 'deletedDepart']);
        Route::get('depart-restore/{slug}', [DepartementController::class, 'restore']);


        Route::get('users', [UserController::class, 'users']);
        Route::get('registered-users', [UserController::class, 'registeredUser']);
        Route::get('user-detail/{slug}', [UserController::class, 'show']);
        Route::get('user-approve/{slug}', [UserController::class, 'approve']);
        Route::get('user-banned/{slug}', [UserController::class, 'banned']);
        Route::get('user-eliminate/{slug}', [UserController::class, 'eliminate']);
        // Route::get('user-ban', [UserController::class, 'banUser']);
        Route::get('user-banned-list', [UserController::class, 'banUser']);
        Route::get('user-unbanned/{slug}', [UserController::class, 'unbanned']);

        Route::get('inventoryLog', [InventoryLogController::class, 'inventorylog']);

        Route::get('inv-return', [InvReturnController::class, 'return']);
        Route::post('inv-return', [InvReturnController::class, 'heal']);
    });



});

//nambah divisi sama kayak kategori
