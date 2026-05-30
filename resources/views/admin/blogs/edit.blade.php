@extends('layouts.admin')

@section('title', 'Edit Blog')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <span class="eyebrow">Content</span>
            <h1 class="h3 fw-bold mb-0">Edit Blog</h1>
        </div>
        <a href="{{ route('admin.blogs.show', $blog) }}" class="btn btn-outline-dark d-inline-flex align-items-center gap-2">
            <i data-lucide="eye" class="icon"></i>
            View
        </a>
    </div>

    @include('admin.blogs.form', [
        'action' => route('admin.blogs.update', $blog),
        'method' => 'PUT',
        'buttonText' => 'Update Blog',
    ])
@endsection
