<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'file_path',
        'submitted_at',
        'locked_at',
        'grade',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // Accessor for formatted locked_at date
    public function getLockedAtAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }

    // Mutator for setting locked_at attribute
    public function setLockedAtAttribute($value)
    {
        $this->attributes['locked_at'] = $value ? Carbon::parse($value) : null;
    }
}
