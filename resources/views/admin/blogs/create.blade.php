@extends('layouts.admin')

@section('title', 'Create Blog')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <span class="eyebrow">Content</span>
            <h1 class="h3 fw-bold mb-0">Create Blog</h1>
        </div>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-dark d-inline-flex align-items-center gap-2">
            <i data-lucide="arrow-left" class="icon"></i>
            Back
        </a>
    </div>

    @include('admin.blogs.form', [
        'action' => route('admin.blogs.store'),
        'method' => 'POST',
        'buttonText' => 'Create Blog',
    ])
@endsection
