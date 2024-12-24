<?php

use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Users;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function (){
    return view('auth.login');
})->name('login');



Route::middleware(['auth', 'can:admin-access'])->group(function () {
    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/admin/users', Users::class)->name('admin.users');
    Route::get('/admin/users/{id}', Users::class)->name('admin.user');
});
