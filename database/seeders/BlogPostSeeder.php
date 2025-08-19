<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = User::where('role', 'teacher')->get();

        if ($teachers->isEmpty()) {
            return;
        }

        $blogPosts = [
            [
                'title' => 'Getting Started with Web Development',
                'content' => '<p>Web development is an exciting journey that opens up countless opportunities in the digital world. Whether you\'re a complete beginner or looking to enhance your skills, this guide will help you get started.</p><p>In this post, we\'ll cover the fundamentals of HTML, CSS, and JavaScript - the three core technologies that power the modern web.</p><h3>Why Learn Web Development?</h3><p>Web development skills are in high demand, and the field continues to grow rapidly. Here are some reasons to consider learning web development:</p><ul><li>High demand for skilled developers</li><li>Flexible career opportunities</li><li>Creative and problem-solving work</li><li>Continuous learning and growth</li></ul>',
                'status' => 'published'
            ],
            [
                'title' => 'Advanced JavaScript Techniques Every Developer Should Know',
                'content' => '<p>JavaScript has evolved significantly over the years, and modern JavaScript offers powerful features that can make your code more efficient and maintainable.</p><p>In this comprehensive guide, we\'ll explore advanced JavaScript techniques including:</p><ul><li>ES6+ features and syntax</li><li>Async programming with Promises and async/await</li><li>Functional programming concepts</li><li>Design patterns in JavaScript</li></ul><h3>ES6+ Features</h3><p>Modern JavaScript introduces many useful features that make coding more enjoyable and efficient.</p>',
                'status' => 'published'
            ],
            [
                'title' => 'The Future of Mobile App Development',
                'content' => '<p>Mobile app development is constantly evolving, with new technologies and frameworks emerging regularly. Cross-platform development has become increasingly popular, allowing developers to build apps for multiple platforms with a single codebase.</p><p>In this article, we\'ll discuss the current trends and future predictions for mobile app development.</p><h3>Cross-Platform Development</h3><p>Frameworks like React Native and Flutter have revolutionized mobile development by enabling cross-platform development without sacrificing performance.</p>',
                'status' => 'draft'
            ],
            [
                'title' => 'Data Science: From Beginner to Expert',
                'content' => '<p>Data science is one of the most exciting and rapidly growing fields in technology. It combines statistics, programming, and domain expertise to extract meaningful insights from data.</p><p>This comprehensive guide will take you from the basics to advanced concepts in data science.</p><h3>Getting Started with Python</h3><p>Python is the most popular programming language for data science due to its rich ecosystem of libraries and tools.</p>',
                'status' => 'published'
            ],
            [
                'title' => 'Design Principles for Better User Experience',
                'content' => '<p>Good design is not just about aesthetics; it\'s about creating experiences that are intuitive, efficient, and enjoyable for users. Understanding design principles is crucial for creating successful digital products.</p><p>In this post, we\'ll explore fundamental design principles that every designer and developer should know.</p><h3>User-Centered Design</h3><p>The key to creating great user experiences is putting the user at the center of the design process.</p>',
                'status' => 'published'
            ]
        ];

        foreach ($blogPosts as $postData) {
            $teacher = $teachers->random();
            
            BlogPost::create([
                'teacher_id' => $teacher->id,
                'title' => $postData['title'],
                'slug' => Str::slug($postData['title'] . '-' . time()),
                'content' => $postData['content'],
                'status' => $postData['status'],
            ]);
        }
    }
}
