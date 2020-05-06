<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'userId', 'title', 'completed'
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];

    public function scopeGetAll()
    {
        return self::select('userId', 'id', 'title', 'completed')->get();
    }

}
