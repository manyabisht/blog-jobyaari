@extends('layouts.admin')

@section('title', $blog->title)

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <span class="eyebrow">Blog Preview</span>
            <h1 class="h3 fw-bold mb-0">{{ $blog->title }}</h1>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('blogs.show', $blog) }}" target="_blank" class="btn btn-outline-dark d-inline-flex align-items-center gap-2">
                <i data-lucide="external-link" class="icon"></i>
                Public View
            </a>
            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-dark d-inline-flex align-items-center gap-2">
                <i data-lucide="pencil" class="icon"></i>
                Edit
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="form-surface">
                <img src="{{ $blog->imageUrl() }}" class="detail-image mb-4" alt="{{ $blog->title }}">
                <p class="lead text-muted">{{ $blog->short_description }}</p>
                <div class="article-content">
                    {!! nl2br(e($blog->content)) !!}
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="table-surface">
                <h2 class="h5 mb-3">Metadata</h2>
                <dl class="row mb-0">
                    <dt class="col-5">Category</dt>
                    <dd class="col-7">{{ $blog->category?->name }}</dd>
                    <dt class="col-5">Status</dt>
                    <dd class="col-7"><span class="badge {{ $blog->status === 'published' ? 'text-bg-success' : 'text-bg-secondary' }}">{{ ucfirst($blog->status) }}</span></dd>
                    <dt class="col-5">Slug</dt>
                    <dd class="col-7 text-break">{{ $blog->slug }}</dd>
                    <dt class="col-5">Published</dt>
                    <dd class="col-7">{{ $blog->published_at?->format('M d, Y h:i A') }}</dd>
                </dl>
            </div>
        </div>
    </div>
@endsection
