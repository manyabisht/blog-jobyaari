@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <span class="eyebrow">Overview</span>
            <h1 class="h3 fw-bold mb-0">Dashboard</h1>
        </div>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-dark d-inline-flex align-items-center gap-2">
            <i data-lucide="plus" class="icon"></i>
            New Blog
        </a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="metric-card">
                <span>Total Blogs</span>
                <strong>{{ $totalBlogs }}</strong>
                <i data-lucide="newspaper" class="metric-icon"></i>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="metric-card">
                <span>Published</span>
                <strong>{{ $publishedBlogs }}</strong>
                <i data-lucide="circle-check" class="metric-icon"></i>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="metric-card">
                <span>Drafts</span>
                <strong>{{ $draftBlogs }}</strong>
                <i data-lucide="file-pen-line" class="metric-icon"></i>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="metric-card">
                <span>Categories</span>
                <strong>{{ $totalCategories }}</strong>
                <i data-lucide="tags" class="metric-icon"></i>
            </div>
        </div>
    </div>

    <div class="table-surface">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h5 mb-0">Recent Blogs</h2>
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-sm btn-outline-dark">View All</a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Published</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentBlogs as $blog)
                        <tr>
                            <td><a href="{{ route('admin.blogs.show', $blog) }}" class="fw-semibold text-decoration-none text-dark">{{ $blog->title }}</a></td>
                            <td>{{ $blog->category?->name }}</td>
                            <td><span class="badge {{ $blog->status === 'published' ? 'text-bg-success' : 'text-bg-secondary' }}">{{ ucfirst($blog->status) }}</span></td>
                            <td>{{ $blog->published_at?->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No blogs created yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
