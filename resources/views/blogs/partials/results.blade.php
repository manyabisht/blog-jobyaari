@forelse ($blogs as $blog)
    @if ($loop->first)
        <div class="row g-4">
    @endif
        <div class="col-md-6 col-xl-4">
            <article class="blog-card card h-100 border-0 shadow-sm">
                <img src="{{ $blog->imageUrl() }}" class="card-img-top" alt="{{ $blog->title }}">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
                        <span class="badge rounded-pill text-bg-success-subtle text-success-emphasis">{{ $blog->category->name }}</span>
                        <time class="small text-muted" datetime="{{ $blog->published_at?->toDateString() }}">{{ $blog->published_at?->format('M d, Y') }}</time>
                    </div>
                    <h2 class="h5 card-title">{{ $blog->title }}</h2>
                    <p class="card-text text-muted">{{ $blog->short_description }}</p>
                    <a href="{{ route('blogs.show', $blog) }}" class="btn btn-dark d-inline-flex align-items-center gap-2 mt-auto align-self-start">
                        Read More
                        <i data-lucide="arrow-right" class="icon"></i>
                    </a>
                </div>
            </article>
        </div>
    @if ($loop->last)
        </div>
    @endif
@empty
    <div class="empty-state text-center py-5">
        <div class="empty-state-icon mx-auto mb-3">
            <i data-lucide="search-x" class="icon-lg"></i>
        </div>
        <h2 class="h4">No blogs found</h2>
        <p class="text-muted mb-0">Try adjusting your search, category, or publish date.</p>
    </div>
@endforelse

@if ($blogs->hasPages())
    <div class="mt-4">
        {{ $blogs->links('blogs.partials.pagination') }}
    </div>
@endif
