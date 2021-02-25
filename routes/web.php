<?php

use Illuminate\Support\Facades\Route;

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


use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesPermissionsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TasksController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => 'auth'], function () {  // START: Auth Middleware
	Route::group(['prefix'=>'roles'], function () {
		Route::get('/', [RolesController::class, 'index'])->name('roles');

		Route::get('/create', [RolesController::class, 'create'])->name('role.create');
		Route::post('/store', [RolesController::class, 'store'])->name('role.store');

		Route::get('/edit/{role}', [RolesController::class, 'edit'])->name('role.edit');
		Route::post('/update/{role}', [RolesController::class, 'update'])->name('role.update');

		Route::get('/destroy/{role}', [RolesController::class, 'destroy'])->name('role.destroy');

		Route::group(['prefix'=>'permissions'], function () {
			Route::get('/{role}', [RolesPermissionsController::class, 'index'])->name('roles.permissions');
			Route::post('/update/{role}', [RolesPermissionsController::class, 'update'])->name('role.permission.update');
		});

	});

	Route::group(['prefix'=>'permissions'], function () {
		Route::get('/', [PermissionsController::class, 'index'])->name('permissions');

		Route::get('/create', [PermissionsController::class, 'create'])->name('permission.create');
		Route::post('/store', [PermissionsController::class, 'store'])->name('permission.store');

		Route::get('/edit/{permission}', [PermissionsController::class, 'edit'])->name('permission.edit');
		Route::post('/update/{permission}', [PermissionsController::class, 'update'])->name('permission.update');

		Route::get('/destroy/{permission}', [PermissionsController::class, 'destroy'])->name('permission.destroy');
	});

	Route::group(['prefix'=>'users'], function () {
		Route::get('/', [UsersController::class, 'index'])->name('users');

		Route::get('/create', [UsersController::class, 'create'])->name('user.create');
		Route::post('/store', [UsersController::class, 'store'])->name('user.store');

		Route::get('/edit/{user}', [UsersController::class, 'edit'])->name('user.edit');
		Route::patch('/update/{user}', [UsersController::class, 'update'])->name('user.update');

		Route::get('/destroy/{user}', [UsersController::class, 'destroy'])->name('user.destroy');
	});

	Route::group(['prefix'=>'tasks'], function () {
		Route::get('/', [TasksController::class, 'index'])->name('tasks');

		Route::get('/create', [TasksController::class, 'create'])->name('task.create');
		Route::post('/store', [TasksController::class, 'store'])->name('task.store');

		Route::get('/edit/{task}', [TasksController::class, 'edit'])->name('task.edit');
		Route::patch('/update/{task}', [TasksController::class, 'update'])->name('task.update');

		Route::get('/destroy/{task}', [TasksController::class, 'destroy'])->name('task.destroy');

		Route::get('/assign/{task}', [TasksController::class, 'assign'])->name('task.assign.to.user');
		Route::post('/assigning/{task}', [TasksController::class, 'assigning'])->name('task.assigning.to.user');
	});

}); // END: Auth Middleware



