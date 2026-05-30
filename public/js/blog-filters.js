$(function () {
    const $browser = $('#blog-browser');

    if (!$browser.length) {
        return;
    }

    const urls = {
        search: $browser.data('search-url'),
        category: $browser.data('category-url'),
        date: $browser.data('date-url'),
    };

    let debounceTimer = null;
    let lastEndpoint = urls.search;

    function currentFilters(extra = {}) {
        return {
            search: $('#blog-search').val(),
            category: $('#category-filter').val(),
            date: $('#date-filter').val(),
            ...extra,
        };
    }

    function loadBlogs(endpoint, extra = {}) {
        lastEndpoint = endpoint;
        $('#blog-loader').removeClass('d-none');

        $.ajax({
            url: endpoint,
            method: 'GET',
            data: currentFilters(extra),
            success: function (response) {
                $('#blog-results').html(response.html);
                $('#results-summary').text(response.summary);
                window.lucide?.createIcons();
            },
            error: function () {
                $('#blog-results').html('<div class="alert alert-danger">Something went wrong while loading blogs. Please try again.</div>');
            },
            complete: function () {
                $('#blog-loader').addClass('d-none');
            },
        });
    }

    $('#blog-search').on('input', function () {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function () {
            loadBlogs(urls.search);
        }, 350);
    });

    $('#category-filter').on('change', function () {
        loadBlogs(urls.category);
    });

    $('#date-filter').on('change', function () {
        loadBlogs(urls.date);
    });

    $('#clear-filters').on('click', function () {
        $('#blog-search').val('');
        $('#category-filter').val('');
        $('#date-filter').val('');
        loadBlogs(urls.search);
    });

    $(document).on('click', '#blog-results .pagination a', function (event) {
        event.preventDefault();

        const page = new URL($(this).attr('href'), window.location.origin).searchParams.get('page') || 1;
        loadBlogs(lastEndpoint, { page });
    });
});
