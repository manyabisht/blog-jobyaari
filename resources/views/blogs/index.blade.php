@extends('layouts.public')

@section('title', 'JobYaari Blog')

@section('content')
    <section class="blog-hero py-5">
        <div class="container">
            <div class="row align-items-end g-4">
                <div class="col-lg-7">
                    <span class="eyebrow">Blog Management System</span>
                    <h1 class="display-5 fw-bold mt-2 mb-3">Insights for hiring, internships, and career momentum.</h1>
                    <p class="lead text-muted mb-0">Browse practical articles with live search, category filters, date filters, pagination, and no page reloads.</p>
                </div>
                <div class="col-lg-5">
                    <div class="stats-strip">
                        <div>
                            <strong>{{ $blogs->total() }}</strong>
                            <span>Published Posts</span>
                        </div>
                        <div>
                            <strong>{{ $categories->count() }}</strong>
                            <span>Categories</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-4">
        <div class="container">
            <div
                id="blog-browser"
                data-search-url="{{ route('blogs.ajax.search') }}"
                data-category-url="{{ route('blogs.ajax.category') }}"
                data-date-url="{{ route('blogs.ajax.date') }}"
            >
                <div class="filter-panel mb-4">
                    <div class="row g-3 align-items-end">
                        <div class="col-lg-5">
                            <label for="blog-search" class="form-label">Search</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i data-lucide="search" class="icon"></i></span>
                                <input type="search" id="blog-search" class="form-control" placeholder="Search title or content" value="{{ $filters['search'] }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label for="category-filter" class="form-label">Category</label>
                            <select id="category-filter" class="form-select">
                                <option value="">All categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->slug }}" @selected($filters['category'] === $category->slug)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label for="date-filter" class="form-label">Publish Date</label>
                            <input type="date" id="date-filter" class="form-control" value="{{ $filters['date'] }}">
                        </div>
                        <div class="col-lg-1 d-grid">
                            <button type="button" id="clear-filters" class="btn btn-outline-dark" title="Clear filters">
                                <i data-lucide="rotate-ccw" class="icon"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="mb-0 text-muted" id="results-summary">{{ $blogs->total() }} published {{ str('post')->plural($blogs->total()) }}</p>
                    <div id="blog-loader" class="spinner-border spinner-border-sm text-success d-none" role="status">
                        <span class="visually-hidden">Loading</span>
                    </div>
                </div>

                <div id="blog-results">
                    @include('blogs.partials.results', ['blogs' => $blogs])
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/blog-filters.js') }}"></script>
@endpush
