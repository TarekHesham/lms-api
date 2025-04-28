<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\QuizSubmission;
use App\Models\Student;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1- Create dummy users and students xD
        User::factory(10)->create()->each(function($user){
            $user->student()->create();
        });

        // 2- Create dummy quizzes and every quiz contain questuon contain 4 options !!
        Quiz::factory(5)->create()->each(function($quiz) {
            Question::factory(10)->create(['quiz_id' => $quiz->id])
                ->each(function($question){
                    QuestionOption::factory(4)->create([
                        'question_id' => $question->id
                    ]);
                });
        });

        // 5- Creat some submissions
        Student::all()->each(function($student){
            $quizzes = Quiz::inRandomOrder()->take(3)->get();
            foreach ($quizzes as $quiz) {
                $submission = QuizSubmission::factory()->create([
                    'student_id' => $student->id,
                    'quiz_id'    => $quiz->id,
                ]);

                foreach ($quiz->questions as $question) {
                    $option = $question->options->random();

                    QuizAnswer::factory()->create([
                        'quiz_submission_id' => $submission->id,
                        'question_id'        => $question->id,
                        'option_id'          => $option->id,
                        'is_correct'         => $option->is_correct,
                        'points_earned'      => $option->is_correct ? $question->points : 0,
                    ]);
                }
            }
        });
    }
}
