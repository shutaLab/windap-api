<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'start_date', 'end_date', 'is_absent'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_absent' => 'boolean'
    ];
}
