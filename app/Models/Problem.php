<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $fillable = [
        'user_id',
        'department',
        'course',
        'chapter',
        'difficulty',
        'reward',
        'deadline',
        'title',
        'description',
        'attachment',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bookmarks()
{
    return $this->hasMany(Bookmark::class);
}
}
