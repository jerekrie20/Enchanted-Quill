<?php

use App\Livewire\Admin\Books;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Users;
use App\Livewire\General\BlogEditor;
use App\Livewire\General\BlogList;
use App\Livewire\General\BookEditor;
use App\Livewire\General\Chapters;
use App\Livewire\General\CKEditor;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Regular User Routes
Route::middleware('auth')->group(function () {
    Route::post('/upload', [CKEditor::class, 'store'])->name('ckeditor.upload'); // image upload for the Ckeditor
    Route::post('/delete-image', [CKEditor::class, 'deleteImages'])->name('ckeditor.delete'); // Delete image for the Ckeditor
    Route::get('/blogs', BlogList::class)->name('blogs');
    Route::get('/blog/{id?}', BlogEditor::class)->name('blog.manage');
});

// Authors and admins routes
Route::middleware(['auth', 'can:admin-or-author-access'])->group(function () {
    Route::get('/admin/books', Books::class)->name('admin.books');
    Route::get('/book/{id?}', BookEditor::class)->name('book.manage');
    Route::get('/chapter/{id}/{slug?}', Chapters::class)->name('chapter.manage');
});

// Just Admin routes
Route::middleware(['auth', 'can:admin-access'])->group(function () {
    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/admin/users', Users::class)->name('admin.users');
    Route::get('/admin/settings', function () {
        return view('livewire.admin.settings');
    })->name('admin.settings');

});
