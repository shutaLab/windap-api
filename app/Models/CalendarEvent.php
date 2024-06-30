<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CalendarEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'start',
        'end',
        'is_absent'
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
        'is_absent' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
