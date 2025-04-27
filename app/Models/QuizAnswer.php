<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    protected $table = 'quiz_answers';

    protected $fillable = [
        'quiz_submission_id',
        'question_id',
        'option_id',
        'points_earned',
        'is_correct',
    ];

    public function submission()
    {
        return $this->belongsTo(QuizSubmission::class);
    }
    
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    
    public function option()
    {
        return $this->belongsTo(QuestionOption::class);
    }
}
