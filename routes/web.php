<?php

use App\Http\Controllers\EditorUploadController;
use App\Livewire\Admin\Books;
use App\Livewire\Admin\Comments;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Users;
use App\Livewire\General\Pages\BookManager;
use App\Livewire\General\Pages\ChapterManager;
use App\Livewire\General\Pages\ChaptersList;
use App\Livewire\General\Pages\ChronicleList;
use App\Livewire\General\Pages\ChronicleManager;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Regular User Routes
Route::middleware('auth')->group(function () {
    Route::post('/upload', [EditorUploadController::class, 'upload'])->name('ckeditor.upload');
    Route::post('/delete-image', [EditorUploadController::class, 'deleteImage'])->name('ckeditor.delete');
    Route::get('/blogs', ChronicleList::class)->name('blogs');
    Route::get('/blog/{id?}', ChronicleManager::class)->name('blog.manage');
});

// Authors and admins routes
Route::middleware(['auth', 'can:admin-or-author-access'])->group(function () {
    Route::get('/admin/books', Books::class)->name('admin.books');
    Route::get('/book/{id?}', BookManager::class)->name('book.manage');
    Route::get('/chapters/{id}', ChaptersList::class)->name('chapters.list');
    Route::get('/chapter/{id}/{chapterNumber?}', ChapterManager::class)->name('chapter.manage');
});

// Just Admin routes
Route::middleware(['auth', 'can:admin-access'])->group(function () {
    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/admin/users', Users::class)->name('admin.users');
    Route::get('/admin/comments', Comments::class)->name('admin.comments');
    Route::get('/admin/settings', function () {
        return view('livewire.admin.settings');
    })->name('admin.settings');

});
