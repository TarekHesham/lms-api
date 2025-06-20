<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function quizSubmissions() {
        return $this->hasMany(QuizSubmission::class);
    }
}
