<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Web Development',
                'description' => 'Learn modern web development technologies and frameworks',
                'slug' => 'web-development',
                'icon' => 'fas fa-code',
                'color' => '#667eea'
            ],
            [
                'name' => 'Mobile Development',
                'description' => 'Master mobile app development for iOS and Android',
                'slug' => 'mobile-development',
                'icon' => 'fas fa-mobile-alt',
                'color' => '#28a745'
            ],
            [
                'name' => 'Data Science',
                'description' => 'Explore data analysis, machine learning, and AI',
                'slug' => 'data-science',
                'icon' => 'fas fa-chart-bar',
                'color' => '#17a2b8'
            ],
            [
                'name' => 'Design',
                'description' => 'Learn UI/UX design, graphic design, and creative skills',
                'slug' => 'design',
                'icon' => 'fas fa-palette',
                'color' => '#ffc107'
            ],
            [
                'name' => 'Business',
                'description' => 'Develop business skills, marketing, and entrepreneurship',
                'slug' => 'business',
                'icon' => 'fas fa-briefcase',
                'color' => '#6f42c1'
            ],
            [
                'name' => 'Photography',
                'description' => 'Master photography techniques and digital editing',
                'slug' => 'photography',
                'icon' => 'fas fa-camera',
                'color' => '#e83e8c'
            ],
            [
                'name' => 'Music',
                'description' => 'Learn music theory, production, and performance',
                'slug' => 'music',
                'icon' => 'fas fa-music',
                'color' => '#fd7e14'
            ],
            [
                'name' => 'Language',
                'description' => 'Learn new languages and improve communication skills',
                'slug' => 'language',
                'icon' => 'fas fa-language',
                'color' => '#20c997'
            ],
            [
                'name' => 'Health & Fitness',
                'description' => 'Improve your health, fitness, and wellness',
                'slug' => 'health-fitness',
                'icon' => 'fas fa-heartbeat',
                'color' => '#dc3545'
            ],
            [
                'name' => 'Personal Development',
                'description' => 'Develop personal skills, productivity, and mindset',
                'slug' => 'personal-development',
                'icon' => 'fas fa-brain',
                'color' => '#6c757d'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
