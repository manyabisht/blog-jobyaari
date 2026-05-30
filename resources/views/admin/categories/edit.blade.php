@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <span class="eyebrow">Taxonomy</span>
            <h1 class="h3 fw-bold mb-0">Edit Category</h1>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-dark d-inline-flex align-items-center gap-2">
            <i data-lucide="arrow-left" class="icon"></i>
            Back
        </a>
    </div>

    @include('admin.categories.form', [
        'action' => route('admin.categories.update', $category),
        'method' => 'PUT',
        'buttonText' => 'Update Category',
    ])
@endsection
