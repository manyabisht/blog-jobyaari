<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        collect([
            'Career Growth',
            'Hiring Trends',
            'Remote Work',
            'Interview Prep',
            'Productivity',
        ])->each(function (string $name): void {
            Category::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
        });
    }
}
