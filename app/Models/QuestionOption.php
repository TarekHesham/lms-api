<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    
    public function answers()
    {
        return $this->hasMany(QuizAnswer::class);
    }
}
