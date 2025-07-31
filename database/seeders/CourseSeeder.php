<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\CourseModule;
use App\Models\Video;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = User::where('role', 'teacher')->get();
        $categories = Category::all();

        if ($teachers->isEmpty() || $categories->isEmpty()) {
            return;
        }

        $courses = [
            [
                'title' => 'Complete Web Development Bootcamp',
                'description' => 'Learn web development from scratch with HTML, CSS, JavaScript, and modern frameworks. Build real-world projects and become a full-stack developer.',
                'price' => 99.99,
                'level' => 'beginner',
                'duration' => 25,
                'category' => 'Web Development',
                'learning_outcomes' => "Build responsive websites with HTML, CSS, and JavaScript\nMaster modern frameworks like React and Node.js\nCreate full-stack web applications\nDeploy websites to production servers\nUnderstand web development best practices",
                'requirements' => "Basic computer knowledge\nA computer with internet connection\nNo prior programming experience required",
                'prerequisites' => "None - this course is designed for complete beginners",
                'certificate_available' => true,
                'status' => 'published'
            ],
            [
                'title' => 'Advanced JavaScript Masterclass',
                'description' => 'Master advanced JavaScript concepts including ES6+, async programming, design patterns, and modern development practices.',
                'price' => 79.99,
                'level' => 'advanced',
                'duration' => 15,
                'category' => 'Web Development',
                'learning_outcomes' => "Master ES6+ features and modern JavaScript\nUnderstand async programming with Promises and async/await\nLearn advanced design patterns\nBuild scalable JavaScript applications\nMaster testing and debugging techniques",
                'requirements' => "JavaScript fundamentals\nBasic programming experience\nNode.js installed on your computer",
                'prerequisites' => "Intermediate JavaScript knowledge\nUnderstanding of basic programming concepts",
                'certificate_available' => true,
                'status' => 'published'
            ],
            [
                'title' => 'Mobile App Development with React Native',
                'description' => 'Learn to build cross-platform mobile applications using React Native. Create apps for both iOS and Android with a single codebase.',
                'price' => 89.99,
                'level' => 'intermediate',
                'duration' => 20,
                'category' => 'Mobile Development',
                'learning_outcomes' => "Build cross-platform mobile apps\nMaster React Native fundamentals\nIntegrate with native device features\nDeploy apps to app stores\nUnderstand mobile app architecture",
                'requirements' => "JavaScript knowledge\nReact basics\nMac computer for iOS development (optional)",
                'prerequisites' => "Basic JavaScript and React knowledge\nUnderstanding of mobile app concepts",
                'certificate_available' => true,
                'status' => 'published'
            ],
            [
                'title' => 'Data Science Fundamentals',
                'description' => 'Introduction to data science, machine learning, and statistical analysis using Python and popular data science libraries.',
                'price' => 129.99,
                'level' => 'intermediate',
                'duration' => 30,
                'category' => 'Data Science',
                'learning_outcomes' => "Understand data science fundamentals\nMaster Python for data analysis\nLearn machine learning algorithms\nCreate data visualizations\nBuild predictive models",
                'requirements' => "Python programming basics\nBasic mathematics and statistics\nComputer with Python installed",
                'prerequisites' => "Basic Python programming\nUnderstanding of basic mathematics",
                'certificate_available' => true,
                'status' => 'published'
            ],
            [
                'title' => 'UI/UX Design Masterclass',
                'description' => 'Learn the principles of user interface and user experience design. Create beautiful, functional, and user-friendly digital products.',
                'price' => 69.99,
                'level' => 'beginner',
                'duration' => 18,
                'category' => 'Design',
                'learning_outcomes' => "Master UI/UX design principles\nCreate wireframes and prototypes\nDesign user-friendly interfaces\nConduct user research and testing\nUse design tools like Figma and Sketch",
                'requirements' => "Computer with design software\nCreative mindset\nNo prior design experience required",
                'prerequisites' => "None - suitable for beginners",
                'certificate_available' => true,
                'status' => 'published'
            ]
        ];

        foreach ($courses as $courseData) {
            $category = $categories->where('name', $courseData['category'])->first();
            $teacher = $teachers->random();

            $course = Course::create([
                'title' => $courseData['title'],
                'slug' => Str::slug($courseData['title'] . '-' . time()),
                'description' => $courseData['description'],
                'price' => $courseData['price'],
                'teacher_id' => $teacher->id,
                'category_id' => $category->id,
                'level' => $courseData['level'],
                'status' => $courseData['status'],
                'duration' => $courseData['duration'],
                'prerequisites' => $courseData['prerequisites'],
                'learning_outcomes' => $courseData['learning_outcomes'],
                'requirements' => $courseData['requirements'],
                'certificate_available' => $courseData['certificate_available'],
            ]);

            // Create sample modules and videos for each course
            $this->createSampleModules($course);
        }
    }

    private function createSampleModules($course)
    {
        $modules = [
            [
                'title' => 'Introduction and Setup',
                'description' => 'Get started with the course and set up your development environment.',
                'videos' => [
                    ['title' => 'Welcome to the Course', 'duration' => 5],
                    ['title' => 'Setting Up Your Environment', 'duration' => 15],
                    ['title' => 'Course Overview', 'duration' => 10],
                ]
            ],
            [
                'title' => 'Fundamentals',
                'description' => 'Learn the basic concepts and fundamentals.',
                'videos' => [
                    ['title' => 'Basic Concepts', 'duration' => 20],
                    ['title' => 'Core Principles', 'duration' => 25],
                    ['title' => 'Practical Examples', 'duration' => 30],
                ]
            ],
            [
                'title' => 'Advanced Topics',
                'description' => 'Dive deeper into advanced concepts and techniques.',
                'videos' => [
                    ['title' => 'Advanced Techniques', 'duration' => 35],
                    ['title' => 'Best Practices', 'duration' => 25],
                    ['title' => 'Real-world Applications', 'duration' => 40],
                ]
            ]
        ];

        foreach ($modules as $index => $moduleData) {
            $module = $course->modules()->create([
                'title' => $moduleData['title'],
                'description' => $moduleData['description'],
                'order' => $index + 1,
            ]);

            foreach ($moduleData['videos'] as $videoIndex => $videoData) {
                $module->videos()->create([
                    'title' => $videoData['title'],
                    'description' => 'Video description for ' . $videoData['title'],
                    'duration' => $videoData['duration'],
                    'video_url' => 'https://example.com/video-' . ($index + 1) . '-' . ($videoIndex + 1) . '.mp4',
                    'order' => $videoIndex + 1,
                ]);
            }
        }
    }
} 