<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'resource_name',
        'resource_type',
        'resource_filename',
        'resource_url',
        'resource_uploaded_by',
    ];
}
