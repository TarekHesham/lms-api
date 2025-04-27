<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function submissions()
    {
        return $this->hasMany(QuizSubmission::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_published', true)
            ->where('start_time', '<=', now())
            ->where('end_time', '>=', now());
    }
}
