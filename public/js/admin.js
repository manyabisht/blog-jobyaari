document.addEventListener('DOMContentLoaded', () => {
    window.lucide?.createIcons();

    const title = document.querySelector('#title, #name');
    const slug = document.querySelector('#slug');
    let slugTouched = Boolean(slug?.value);

    function slugify(value) {
        return value
            .toString()
            .trim()
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }

    if (slug) {
        slug.addEventListener('input', () => {
            slugTouched = true;
            slug.value = slugify(slug.value);
        });
    }

    if (title && slug) {
        title.addEventListener('input', () => {
            if (!slugTouched) {
                slug.value = slugify(title.value);
            }
        });
    }

    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');

    if (imageInput && imagePreview) {
        imageInput.addEventListener('change', () => {
            const [file] = imageInput.files;

            if (!file) {
                return;
            }

            imagePreview.src = URL.createObjectURL(file);
            imagePreview.classList.remove('d-none');
        });
    }
});
