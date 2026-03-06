<?php

namespace App\Livewire\Admin;

use App\Models\Blog;
use App\Models\Book;
use App\Models\Comment;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('components.Layouts.admin')]
    #[Title('Dashboard')]

    // All-time totals
    public $totalUsers;

    public $totalBooks;

    public $totalBlogs;

    public $totalComments;

    // Weekly stats
    public $weeklyUsers;

    public $weeklyBooks;

    public $weeklyBlogs;

    public $weeklyComments;

    // Monthly stats
    public $monthlyUsers;

    public $monthlyBooks;

    public $monthlyBlogs;

    public $monthlyComments;

    // Trends
    public $userTrend;

    public $bookTrend;

    public $blogTrend;

    public function mount()
    {
        // All-time totals (cached for 15 minutes)
        $this->totalUsers = cache()->remember('stats.total_users', 900, fn () => User::count());
        $this->totalBooks = cache()->remember('stats.total_books', 900, fn () => Book::count());
        $this->totalBlogs = cache()->remember('stats.total_blogs', 900, fn () => Blog::count());
        $this->totalComments = cache()->remember('stats.total_comments', 900, fn () => Comment::count());

        // Weekly stats (last 7 days)
        $weekStart = now()->subDays(7);
        $this->weeklyUsers = User::where('created_at', '>=', $weekStart)->count();
        $this->weeklyBooks = Book::where('created_at', '>=', $weekStart)->count();
        $this->weeklyBlogs = Blog::where('created_at', '>=', $weekStart)->count();
        $this->weeklyComments = Comment::where('created_at', '>=', $weekStart)->count();

        // Monthly stats (last 30 days)
        $monthStart = now()->subDays(30);
        $this->monthlyUsers = User::where('created_at', '>=', $monthStart)->count();
        $this->monthlyBooks = Book::where('created_at', '>=', $monthStart)->count();
        $this->monthlyBlogs = Blog::where('created_at', '>=', $monthStart)->count();
        $this->monthlyComments = Comment::where('created_at', '>=', $monthStart)->count();

        // Calculate trends (compare current week vs previous week)
        $previousWeekStart = now()->subDays(14);
        $previousWeekEnd = now()->subDays(7);

        $previousWeekUsers = User::whereBetween('created_at', [$previousWeekStart, $previousWeekEnd])->count();
        $previousWeekBooks = Book::whereBetween('created_at', [$previousWeekStart, $previousWeekEnd])->count();
        $previousWeekBlogs = Blog::whereBetween('created_at', [$previousWeekStart, $previousWeekEnd])->count();

        $this->userTrend = $this->calculateTrend($this->weeklyUsers, $previousWeekUsers);
        $this->bookTrend = $this->calculateTrend($this->weeklyBooks, $previousWeekBooks);
        $this->blogTrend = $this->calculateTrend($this->weeklyBlogs, $previousWeekBlogs);
    }

    /**
     * Calculate percentage trend between current and previous period
     */
    private function calculateTrend($current, $previous): array
    {
        if ($previous == 0) {
            return ['percentage' => $current > 0 ? 100 : 0, 'direction' => $current > 0 ? 'up' : 'neutral'];
        }

        $change = (($current - $previous) / $previous) * 100;

        return [
            'percentage' => round(abs($change), 1),
            'direction' => $change > 0 ? 'up' : ($change < 0 ? 'down' : 'neutral'),
        ];
    }

    public function render()
    {
        // Recent Activity (last 10 items across all types)
        $recentUsers = User::latest()->take(5)->get()->map(fn ($user) => [
            'type' => 'user',
            'title' => $user->name.' joined',
            'subtitle' => $user->role,
            'time' => $user->created_at,
            'url' => route('admin.users'),
        ]);

        $recentBooks = Book::with('author')->latest()->take(5)->get()->map(fn ($book) => [
            'type' => 'book',
            'title' => $book->title.' published',
            'subtitle' => 'by '.$book->author->name,
            'time' => $book->created_at,
            'url' => route('book.manage', $book->id),
        ]);

        $recentBlogs = Blog::with('user')->latest()->take(5)->get()->map(fn ($blog) => [
            'type' => 'blog',
            'title' => $blog->title.' posted',
            'subtitle' => 'by '.$blog->user->name,
            'time' => $blog->created_at,
            'url' => route('blog.manage', $blog->id),
        ]);

        $recentActivity = $recentUsers
            ->merge($recentBooks)
            ->merge($recentBlogs)
            ->sortByDesc('time')
            ->take(10);

        // Top Performers
        $topAuthors = User::withCount(['books', 'blogs'])
            ->where('role', 'author')
            ->orderByDesc('books_count')
            ->take(5)
            ->get();

        $topBooks = Book::withCount('reviews')
            ->with('author')
            ->orderByDesc('reviews_count')
            ->take(5)
            ->get();

        return view('livewire.admin.dashboard', [
            'recentActivity' => $recentActivity,
            'topAuthors' => $topAuthors,
            'topBooks' => $topBooks,
        ]);
    }
}
