<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="form-surface" novalidate>
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $blog->title) }}" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $blog->slug) }}" required>
                @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="short_description" class="form-label">Short Description</label>
                <textarea id="short_description" name="short_description" rows="3" class="form-control @error('short_description') is-invalid @enderror" required>{{ old('short_description', $blog->short_description) }}</textarea>
                @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Full Content</label>
                <textarea id="content" name="content" rows="12" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $blog->content) }}</textarea>
                @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                    <option value="">Choose category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected((string) old('category_id', $blog->category_id) === (string) $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="published_at" class="form-label">Publish Date</label>
                <input type="datetime-local" id="published_at" name="published_at" class="form-control @error('published_at') is-invalid @enderror" value="{{ old('published_at', optional($blog->published_at)->format('Y-m-d\TH:i')) }}" required>
                @error('published_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                    <option value="published" @selected(old('status', $blog->status) === 'published')>Published</option>
                    <option value="draft" @selected(old('status', $blog->status) === 'draft')>Draft</option>
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label for="image" class="form-label">Featured Image</label>
                <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" {{ ! $blog->exists ? 'required' : '' }}>
                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <img id="image-preview" class="image-preview mt-3 {{ $blog->image ? '' : 'd-none' }}" src="{{ $blog->image ? $blog->imageUrl() : '' }}" alt="Featured image preview">
            </div>

            <button type="submit" class="btn btn-dark w-100 d-inline-flex justify-content-center align-items-center gap-2">
                <i data-lucide="save" class="icon"></i>
                {{ $buttonText }}
            </button>
        </div>
    </div>
</form>
