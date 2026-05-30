<?php

namespace App\Services;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Builder;

class BlogFilterService
{
    /**
     * @param  array{search?: string|null, category?: string|null, date?: string|null}  $filters
     */
    public function publishedQuery(array $filters = []): Builder
    {
        return Blog::query()
            ->with('category')
            ->published()
            ->when($filters['search'] ?? null, function (Builder $query, string $search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query
                        ->where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->when($filters['category'] ?? null, function (Builder $query, string $category): void {
                $query->whereHas('category', function (Builder $query) use ($category): void {
                    $query->where('slug', $category);
                });
            })
            ->when($filters['date'] ?? null, function (Builder $query, string $date): void {
                $query->whereDate('published_at', $date);
            })
            ->latest('published_at');
    }
}
