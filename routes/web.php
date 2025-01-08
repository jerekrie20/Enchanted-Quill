<?php

use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Users;
use App\Livewire\General\BlogEditor;
use App\Livewire\General\BlogList;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function (){
    return view('auth.login');
})->name('login');


Route::middleware('auth')->group(function (){

});


Route::middleware(['auth', 'can:admin-access'])->group(function () {
    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/admin/users', Users::class)->name('admin.users');
    Route::get('/admin/settings', function (){
        return view('livewire.admin.settings');
    })->name('admin.settings');

    Route::get('/admin/blogs', BlogList::class)->name('admin.blogs');
    Route::get('/admin/blog/{id}', BlogEditor::class)->name('admin.blog-id');
});
