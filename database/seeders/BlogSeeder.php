<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            ['category' => 'Hiring Trends', 'title' => 'How AI Is Changing Early Career Hiring', 'short_description' => 'A practical look at how automated screening, portfolio signals, and human review now work together.', 'accent' => '#2563eb', 'date' => now()->subDays(1)],
            ['category' => 'Interview Prep', 'title' => 'A Calm Framework for Your First Technical Interview', 'short_description' => 'Break technical interviews into repeatable phases so you can show your thinking with confidence.', 'accent' => '#16a34a', 'date' => now()->subDays(3)],
            ['category' => 'Career Growth', 'title' => 'Building a Portfolio That Recruiters Can Scan Fast', 'short_description' => 'Simple portfolio improvements that make projects easier to evaluate in under two minutes.', 'accent' => '#d97706', 'date' => now()->subDays(6)],
            ['category' => 'Remote Work', 'title' => 'Remote Internship Habits That Build Trust', 'short_description' => 'Small communication routines that make distributed teams feel aligned and reliable.', 'accent' => '#0891b2', 'date' => now()->subDays(9)],
            ['category' => 'Productivity', 'title' => 'Planning Your Week Around Deep Work Blocks', 'short_description' => 'A startup-friendly routine for balancing learning, delivery, and feedback cycles.', 'accent' => '#7c3aed', 'date' => now()->subDays(12)],
            ['category' => 'Hiring Trends', 'title' => 'Why Skill Signals Matter More Than Long Resumes', 'short_description' => 'What junior developers can do to make ability visible without years of experience.', 'accent' => '#db2777', 'date' => now()->subDays(15)],
            ['category' => 'Interview Prep', 'title' => 'How to Explain a Laravel Project in an Interview', 'short_description' => 'Turn routes, models, migrations, and tradeoffs into a crisp project walkthrough.', 'accent' => '#ea580c', 'date' => now()->subDays(18)],
            ['category' => 'Career Growth', 'title' => 'The Feedback Loop Every Intern Should Ask For', 'short_description' => 'A simple cadence for learning quickly while keeping mentors in the loop.', 'accent' => '#0f766e', 'date' => now()->subDays(21)],
            ['category' => 'Remote Work', 'title' => 'Async Updates That Save Meetings', 'short_description' => 'Use short, structured updates to reduce confusion and keep work moving.', 'accent' => '#4f46e5', 'date' => now()->subDays(24)],
            ['category' => 'Productivity', 'title' => 'Reducing Context Switching During Job Search', 'short_description' => 'Batch applications, coding practice, and project polish without burning out.', 'accent' => '#65a30d', 'date' => now()->subDays(27)],
            ['category' => 'Hiring Trends', 'title' => 'What Startup Teams Look For in Junior Developers', 'short_description' => 'Reliability, curiosity, and shipping habits often weigh as much as framework trivia.', 'accent' => '#0284c7', 'date' => now()->subDays(30)],
            ['category' => 'Interview Prep', 'title' => 'Debugging Questions Without Freezing', 'short_description' => 'A step-by-step approach to turn uncertainty into a visible problem-solving process.', 'accent' => '#be123c', 'date' => now()->subDays(33)],
        ];

        foreach ($posts as $index => $post) {
            $category = Category::where('name', $post['category'])->firstOrFail();
            $slug = Str::slug($post['title']);
            $imagePath = "blogs/seeded/{$slug}.svg";

            Storage::disk('public')->put($imagePath, $this->svgFor($post['title'], $post['accent'], $index + 1));

            Blog::updateOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $category->id,
                    'title' => $post['title'],
                    'short_description' => $post['short_description'],
                    'content' => $this->contentFor($post['title'], $post['category']),
                    'image' => $imagePath,
                    'published_at' => Carbon::parse($post['date']),
                    'status' => 'published',
                ]
            );
        }
    }

    private function svgFor(string $title, string $accent, int $number): string
    {
        $safeTitle = e($title);
        $number = str_pad((string) $number, 2, '0', STR_PAD_LEFT);

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="720" viewBox="0 0 1200 720" role="img" aria-label="{$safeTitle}">
  <rect width="1200" height="720" fill="#f8fafc"/>
  <path d="M0 510 C230 430 360 640 610 540 C820 455 930 250 1200 315 L1200 720 L0 720 Z" fill="{$accent}" opacity=".16"/>
  <circle cx="1010" cy="150" r="118" fill="{$accent}" opacity=".18"/>
  <circle cx="150" cy="590" r="92" fill="#111827" opacity=".08"/>
  <rect x="86" y="82" width="1028" height="556" rx="36" fill="#ffffff" stroke="#e5e7eb" stroke-width="2"/>
  <text x="126" y="178" fill="{$accent}" font-family="Arial, Helvetica, sans-serif" font-size="42" font-weight="700">JobYaari Insight {$number}</text>
  <foreignObject x="126" y="230" width="860" height="260">
    <div xmlns="http://www.w3.org/1999/xhtml" style="font-family: Arial, Helvetica, sans-serif; color:#111827; font-size:64px; font-weight:800; line-height:1.08;">{$safeTitle}</div>
  </foreignObject>
  <rect x="126" y="540" width="220" height="14" rx="7" fill="{$accent}"/>
  <rect x="370" y="540" width="160" height="14" rx="7" fill="#cbd5e1"/>
</svg>
SVG;
    }

    private function contentFor(string $title, string $category): string
    {
        return <<<TEXT
{$title} is a topic every early-career developer can use as a practical advantage. The best candidates do not rely on buzzwords alone; they show clear thinking, steady execution, and a willingness to improve from feedback.

In the {$category} space, small details compound quickly. A focused project description, a readable commit history, and examples that explain tradeoffs can help reviewers understand how you approach real work. This is especially useful when you are applying for internships and need to stand out without years of experience.

Start by identifying the outcome you want to communicate. If the project solves a business problem, explain the users and the workflow. If the project demonstrates a technical skill, show the specific decisions you made and why they mattered. Screenshots, seed data, validation, and deployment notes all make the work easier to trust.

The strongest signal is consistency. Keep your application materials current, practice explaining your decisions out loud, and improve one part of the system after each review. Over time, this turns a simple project into a persuasive story about how you learn and build.
TEXT;
    }
}
