<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function solutions(): HasMany
    {
    return $this->hasMany(Solution::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bookmarkedBy(): BelongsToMany
    {
    return $this->belongsToMany(User::class, 'bookmarks');
    }
    public function conversations(): HasMany
    {
    return $this->hasMany(Conversation::class);
    }
}
