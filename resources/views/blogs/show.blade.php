@extends('layouts.public')

@section('title', $blog->title)

@section('content')
    <article class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <a href="{{ route('blogs.index') }}" class="btn btn-sm btn-outline-dark d-inline-flex align-items-center gap-2 mb-4">
                        <i data-lucide="arrow-left" class="icon"></i>
                        Back to blogs
                    </a>

                    <div class="mb-4">
                        <span class="badge rounded-pill text-bg-success-subtle text-success-emphasis">{{ $blog->category->name }}</span>
                        <time class="text-muted small ms-2" datetime="{{ $blog->published_at?->toDateString() }}">{{ $blog->published_at?->format('M d, Y') }}</time>
                    </div>

                    <h1 class="display-5 fw-bold mb-4">{{ $blog->title }}</h1>
                    <p class="lead text-muted">{{ $blog->short_description }}</p>
                </div>
            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-lg-10">
                    <img src="{{ $blog->imageUrl() }}" class="detail-image mb-5" alt="{{ $blog->title }}">
                    <div class="article-content">
                        {!! nl2br(e($blog->content)) !!}
                    </div>
                </div>
            </div>
        </div>
    </article>

    <section class="py-5 bg-soft border-top">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">Related Posts</h2>
                <a href="{{ route('blogs.index', ['category' => $blog->category->slug]) }}" class="btn btn-sm btn-outline-dark d-inline-flex align-items-center gap-2">
                    <i data-lucide="tags" class="icon"></i>
                    More in {{ $blog->category->name }}
                </a>
            </div>

            @if ($relatedPosts->isNotEmpty())
                <div class="row g-4">
                    @foreach ($relatedPosts as $relatedPost)
                        <div class="col-md-4">
                            <article class="blog-card card border-0 shadow-sm h-100">
                                <img src="{{ $relatedPost->imageUrl() }}" class="card-img-top" alt="{{ $relatedPost->title }}">
                                <div class="card-body">
                                    <span class="badge rounded-pill text-bg-success-subtle text-success-emphasis mb-3">{{ $relatedPost->category->name }}</span>
                                    <h3 class="h5">{{ $relatedPost->title }}</h3>
                                    <p class="text-muted">{{ $relatedPost->short_description }}</p>
                                    <a href="{{ route('blogs.show', $relatedPost) }}" class="stretched-link">Read article</a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state text-center py-5">
                    <h3 class="h5">No related posts yet</h3>
                    <p class="text-muted mb-0">Fresh posts in this category will appear here.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
