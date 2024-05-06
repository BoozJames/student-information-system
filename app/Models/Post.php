<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_title',
        'post_content',
        'post_type',
        'post_uploaded_by',
    ];

    // Define the 'user' relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'post_uploaded_by');
    }
}
