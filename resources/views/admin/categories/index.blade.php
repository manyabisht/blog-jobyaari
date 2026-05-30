@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <span class="eyebrow">Taxonomy</span>
            <h1 class="h3 fw-bold mb-0">Categories</h1>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-dark d-inline-flex align-items-center gap-2">
            <i data-lucide="plus" class="icon"></i>
            Create Category
        </a>
    </div>

    <div class="table-surface">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Blogs</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td class="fw-semibold">{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->blogs_count }}</td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-dark" title="Edit"><i data-lucide="pencil" class="icon"></i></a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i data-lucide="trash-2" class="icon"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">No categories yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $categories->links('blogs.partials.pagination') }}
    </div>
@endsection
