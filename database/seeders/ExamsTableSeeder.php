<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('exams')->insert([
            [
                'name' => 'Aptitude Math Exam',
                'description' => 'Aptitude maths',
                'teacher_id' => 1,
                'duration' => 1,
                'total_mark' => 5,
                'pass_mark' => 3,
                'is_published' => true,
                'is_archived' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Aptitude GK Exam',
                'description' => 'Aptitude GK Exam',
                'teacher_id' => 1,
                'duration' => 2,
                'total_mark' => 10,
                'pass_mark' => 6,
                'is_published' => true,
                'is_archived' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Aptitude Exam',
                'description' => 'Aptitude exam',
                'teacher_id' => 2,
                'duration' => 5,
                'total_mark' => 8,
                'pass_mark' => 5,
                'is_published' => true,
                'is_archived' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ]);
    }
}
