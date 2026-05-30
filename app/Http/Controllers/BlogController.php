<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Services\BlogFilterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function __construct(private readonly BlogFilterService $blogFilterService) {}

    public function index(Request $request): View
    {
        $filters = $this->filtersFrom($request);

        $blogs = $this->blogFilterService
            ->publishedQuery($filters)
            ->paginate(6)
            ->withQueryString();

        return view('blogs.index', [
            'blogs' => $blogs,
            'categories' => Category::query()->orderBy('name')->get(),
            'filters' => $filters,
        ]);
    }

    public function show(Blog $blog): View
    {
        abort_unless($blog->status === 'published' && $blog->published_at?->lte(now()), 404);

        $relatedPosts = Blog::query()
            ->with('category')
            ->published()
            ->where('id', '!=', $blog->id)
            ->where('category_id', $blog->category_id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blogs.show', compact('blog', 'relatedPosts'));
    }

    public function ajaxSearch(Request $request): JsonResponse
    {
        return $this->ajaxResponse($request);
    }

    public function ajaxCategory(Request $request): JsonResponse
    {
        return $this->ajaxResponse($request);
    }

    public function ajaxDate(Request $request): JsonResponse
    {
        return $this->ajaxResponse($request);
    }

    private function ajaxResponse(Request $request): JsonResponse
    {
        $filters = $this->filtersFrom($request);

        $blogs = $this->blogFilterService
            ->publishedQuery($filters)
            ->paginate(6)
            ->withQueryString();

        return response()->json([
            'html' => view('blogs.partials.results', compact('blogs'))->render(),
            'count' => $blogs->total(),
            'summary' => $this->summary($filters, $blogs->total()),
        ]);
    }

    /**
     * @return array{search: string|null, category: string|null, date: string|null}
     */
    private function filtersFrom(Request $request): array
    {
        return [
            'search' => filled($request->query('search')) ? trim((string) $request->query('search')) : null,
            'category' => filled($request->query('category')) ? (string) $request->query('category') : null,
            'date' => filled($request->query('date')) ? (string) $request->query('date') : null,
        ];
    }

    /**
     * @param  array{search: string|null, category: string|null, date: string|null}  $filters
     */
    private function summary(array $filters, int $total): string
    {
        $activeFilters = collect($filters)->filter()->count();

        if ($activeFilters === 0) {
            return "{$total} published ".str('post')->plural($total);
        }

        return "{$total} ".str('result')->plural($total).' for your filters';
    }
}
