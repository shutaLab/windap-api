<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'start', 'end', 'is_absent'];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
        'is_absent' => 'boolean'
    ];
}
