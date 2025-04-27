<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
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
