<?php

namespace Tests\Feature;

use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicBlogTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_lists_seeded_blogs(): void
    {
        $this->seed();

        $this->get(route('blogs.index'))
            ->assertOk()
            ->assertSee('JobYaari Blog')
            ->assertSee('How AI Is Changing Early Career Hiring');
    }

    public function test_ajax_search_category_and_date_filters_work_together(): void
    {
        $this->seed();

        $blog = Blog::where('slug', 'how-to-explain-a-laravel-project-in-an-interview')->firstOrFail();

        $this->getJson(route('blogs.ajax.search', [
            'search' => 'Laravel',
            'category' => $blog->category->slug,
            'date' => $blog->published_at->toDateString(),
        ]))
            ->assertOk()
            ->assertJsonPath('count', 1)
            ->assertJsonFragment([
                'summary' => '1 result for your filters',
            ])
            ->assertSee($blog->title, false);
    }
}
