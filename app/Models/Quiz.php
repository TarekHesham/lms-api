<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizes';

    public function user()
    {
        return $this->belongsTo(User::class);
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
        $now = now();

        return $query->where('is_published', 1)
            ->where('start_at', '<=', $now)
            ->where('end_at', '>=', $now);
    }
}
