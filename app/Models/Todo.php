<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['user_id', 'title', 'completed'];

    protected $casts = [
        'completed' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeTitle($query, $title)
    {
        return $query->where('title', 'LIKE', '%' . $title . '%');
    }

    public function scopeCompleted($query, $completed)
    {
        return $query->where('completed', $completed);
    }
}
