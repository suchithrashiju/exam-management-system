<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'teacher_id',
        'duration',
        'total_mark',
        'pass_mark',
        'is_published',
        'is_archived',
    ];
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

}
