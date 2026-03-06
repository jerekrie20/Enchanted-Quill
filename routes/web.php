<?php

use App\Http\Controllers\EditorUploadController;
use App\Livewire\Admin\Books;
use App\Livewire\Admin\Categories;
use App\Livewire\Admin\Comments;
use App\Livewire\Admin\ContactMessages;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Reviews;
use App\Livewire\Admin\Users;
use App\Livewire\General\Pages\BookManager;
use App\Livewire\General\Pages\ChapterManager;
use App\Livewire\General\Pages\ChaptersList;
use App\Livewire\General\Pages\ChronicleList;
use App\Livewire\General\Pages\ChronicleManager;
use Illuminate\Support\Facades\Route;

// Public Frontend Routes (no authentication required)
Route::get('/', \App\Livewire\Public\Home::class)->name('home');
Route::get('/books', \App\Livewire\Public\Books::class)->name('books');
Route::get('/book/{id}', \App\Livewire\Public\BookDetail::class)->name('public.book.show');
Route::get('/blog', \App\Livewire\Public\Blog::class)->name('blog');
Route::get('/blog/{id}', \App\Livewire\Public\BlogDetail::class)->name('public.blog.show');
Route::get('/about', \App\Livewire\Public\About::class)->name('public.about');
Route::get('/contact', \App\Livewire\Public\Contact::class)->name('public.contact');
Route::get('/faq', \App\Livewire\Public\Faq::class)->name('public.faq');
Route::get('/policies', \App\Livewire\Public\Policies::class)->name('public.policies');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Portal Routes (Public & Authenticated)
Route::get('/portal', \App\Livewire\Portal\Dashboard::class)->name('portal');

// Portal Routes (Authenticated Users)
Route::middleware('auth')->group(function () {
    Route::post('/upload', [EditorUploadController::class, 'upload'])->name('ckeditor.upload');
    Route::post('/delete-image', [EditorUploadController::class, 'deleteImage'])->name('ckeditor.delete');

    // Blog management for authors (existing routes - will update layout later)
    Route::get('/blogs', ChronicleList::class)->name('blogs');
    Route::get('/blog/{id}/edit', ChronicleManager::class)->name('blog.manage');

    // Portal user routes
    Route::get('/portal/library', \App\Livewire\Portal\Library::class)->name('portal.library');
    Route::get('/portal/book/{id}', \App\Livewire\Portal\BookDetail::class)->name('portal.book.show');
    Route::get('/portal/book/{bookId}/chapter/{chapterNumber}', \App\Livewire\Portal\ChapterReader::class)->name('portal.chapter.read');
    Route::get('/portal/chronicles', \App\Livewire\Portal\Chronicles::class)->name('portal.chronicles');
    Route::get('/portal/chronicle/{id}', \App\Livewire\Portal\ChronicleDetail::class)->name('portal.chronicle.show');
    Route::get('/portal/profile/{id}', \App\Livewire\Portal\UserProfile::class)->name('portal.profile');
    Route::get('/portal/settings', \App\Livewire\Portal\Settings::class)->name('portal.settings');
    Route::get('/portal/author/dashboard', \App\Livewire\Portal\AuthorDashboard::class)->name('portal.author.dashboard')->can('admin-or-author-access');
});

// Authors and admins routes
Route::middleware(['auth', 'can:admin-or-author-access'])->group(function () {
    Route::get('/admin/books', Books::class)->name('admin.books');
    Route::get('/manage/book/{id?}', BookManager::class)->name('book.manage');
    Route::get('/chapters/{id}', ChaptersList::class)->name('chapters.list');
    Route::get('/chapter/{id}/{chapterNumber?}', ChapterManager::class)->name('chapter.manage');
});

// Just Admin routes
Route::middleware(['auth', 'can:admin-access'])->group(function () {
    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/admin/users', Users::class)->name('admin.users');
    Route::get('/admin/comments', Comments::class)->name('admin.comments');
    Route::get('/admin/reviews', Reviews::class)->name('admin.reviews');
    Route::get('/admin/categories', Categories::class)->name('admin.categories');
    Route::get('/admin/contact-messages', ContactMessages::class)->name('admin.contact-messages');
    Route::get('/admin/settings', function () {
        return view('livewire.admin.settings');
    })->name('admin.settings');
});
