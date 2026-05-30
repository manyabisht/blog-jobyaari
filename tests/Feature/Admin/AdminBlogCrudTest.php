<?php

namespace Tests\Feature\Admin;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminBlogCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_blog_with_uploaded_image(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $category = Category::create([
            'name' => 'Engineering',
            'slug' => 'engineering',
        ]);

        $this->actingAs($user)
            ->post(route('admin.blogs.store'), [
                'title' => 'Shipping a Complete Laravel Assessment',
                'slug' => 'shipping-a-complete-laravel-assessment',
                'category_id' => $category->id,
                'short_description' => 'A focused walkthrough of creating a polished Laravel internship assessment.',
                'content' => str_repeat('This paragraph explains the implementation approach and validation details. ', 4),
                'image' => UploadedFile::fake()->image('featured.jpg', 1200, 720),
                'published_at' => now()->format('Y-m-d H:i:s'),
                'status' => 'published',
            ])
            ->assertRedirect();

        $blog = Blog::firstOrFail();

        $this->assertSame('Shipping a Complete Laravel Assessment', $blog->title);
        $this->assertSame('published', $blog->status);
        Storage::disk('public')->assertExists($blog->image);
    }

    public function test_admin_can_create_category(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('admin.categories.store'), [
                'name' => 'Startup Lessons',
                'slug' => 'startup-lessons',
            ])
            ->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseHas('categories', [
            'slug' => 'startup-lessons',
        ]);
    }
}
