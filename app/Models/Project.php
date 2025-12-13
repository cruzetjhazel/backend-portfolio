<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // STATUS CONSTANTS
    public const STATUS_ONGOING   = 'ongoing';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_ARCHIVED  = 'archived';

    protected $fillable = [
        'title',
        'status',
        'description',
    ];
}
