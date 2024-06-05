<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'question_text',
        'description',
        'choice1',
        'choice2',
        'choice3',
        'choice4',
        'correct_choice',
        'mark',
    ];
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
