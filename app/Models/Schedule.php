<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject_id',
        'day_of_week',
        'start_time',
        'end_time',
        'attendance',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->subject->teacher();
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
