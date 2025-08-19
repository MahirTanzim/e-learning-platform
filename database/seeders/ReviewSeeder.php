<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reviews')->insert([
            [
                'user_id' => 1,
                'course_id' => 1,
                'name' => 'Alice Johnson',
                'email' => 'alice@example.com',
                'title' => 'Great Course!',
                'rating' => 5,
                'body' => 'I loved the content and the instructor was very clear.',
                'pros' => 'Clear explanations, good pace',
                'cons' => 'None',
                'recommend' => true,
                'proof' => null,
                'status' => 'approved',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'course_id' => 2,
                'name' => 'Bob Anderson',
                'email' => 'bob@example.com',
                'title' => 'Needs Improvement',
                'rating' => 3,
                'body' => 'Some topics were rushed and not enough examples.',
                'pros' => 'Good materials',
                'cons' => 'Too fast, not enough examples',
                'recommend' => false,
                'proof' => null,
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'course_id' => 1,
                'name' => 'Charlie Brown',
                'email' => 'charlie@example.com',
                'title' => 'Very Helpful',
                'rating' => 4,
                'body' => 'Helped me understand the basics. Would recommend.',
                'pros' => 'Beginner friendly',
                'cons' => 'Could use more advanced topics',
                'recommend' => true,
                'proof' => null,
                'status' => 'approved',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
