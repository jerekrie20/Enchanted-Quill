<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Book;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate the sitemap XML.
     */
    public function index(): Response
    {
        $books = Book::published()->latest('updated_at')->get();
        $blogs = Blog::published()->latest('updated_at')->get();

        return response()->view('sitemap', [
            'books' => $books,
            'blogs' => $blogs,
        ])->header('Content-Type', 'text/xml');
    }
}
