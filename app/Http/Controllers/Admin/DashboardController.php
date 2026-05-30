<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'totalBlogs' => Blog::count(),
            'publishedBlogs' => Blog::where('status', 'published')->count(),
            'draftBlogs' => Blog::where('status', 'draft')->count(),
            'totalCategories' => Category::count(),
            'recentBlogs' => Blog::with('category')->latest()->take(5)->get(),
        ]);
    }
}
