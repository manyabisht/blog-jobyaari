@extends('layouts.admin')

@section('title', 'Blogs')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <span class="eyebrow">Content</span>
            <h1 class="h3 fw-bold mb-0">Blogs</h1>
        </div>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-dark d-inline-flex align-items-center gap-2">
            <i data-lucide="plus" class="icon"></i>
            Create Blog
        </a>
    </div>

    <div class="table-surface">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Blog</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Published</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($blogs as $blog)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $blog->imageUrl() }}" class="admin-thumb" alt="{{ $blog->title }}">
                                    <div>
                                        <a href="{{ route('admin.blogs.show', $blog) }}" class="fw-semibold text-decoration-none text-dark">{{ $blog->title }}</a>
                                        <div class="small text-muted">{{ $blog->slug }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $blog->category?->name }}</td>
                            <td><span class="badge {{ $blog->status === 'published' ? 'text-bg-success' : 'text-bg-secondary' }}">{{ ucfirst($blog->status) }}</span></td>
                            <td>{{ $blog->published_at?->format('M d, Y') }}</td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <a href="{{ route('admin.blogs.show', $blog) }}" class="btn btn-sm btn-outline-dark" title="View"><i data-lucide="eye" class="icon"></i></a>
                                    <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-sm btn-outline-dark" title="Edit"><i data-lucide="pencil" class="icon"></i></a>
                                    <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" onsubmit="return confirm('Delete this blog?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i data-lucide="trash-2" class="icon"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">No blogs yet. Create your first post to get started.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $blogs->links('blogs.partials.pagination') }}
    </div>
@endsection
