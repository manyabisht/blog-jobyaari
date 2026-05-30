@extends('layouts.public')

@section('title', 'Page Not Found')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="empty-state text-center py-5">
                <div class="empty-state-icon mx-auto mb-3">
                    <i data-lucide="file-question" class="icon-lg"></i>
                </div>
                <h1 class="display-6 fw-bold">Page not found</h1>
                <p class="text-muted">The page you are looking for may have moved or is no longer available.</p>
                <a href="{{ route('blogs.index') }}" class="btn btn-dark d-inline-flex align-items-center gap-2">
                    <i data-lucide="arrow-left" class="icon"></i>
                    Back to blogs
                </a>
            </div>
        </div>
    </section>
@endsection
