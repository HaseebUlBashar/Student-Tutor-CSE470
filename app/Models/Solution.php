<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Solution extends Model
{
    protected $fillable = [
        'problem_id',
        'student_tutor_id',
        'description',
        'attachment',
        'reward',
        'status',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'reward' => 'decimal:2',
    ];

    public function problem(): BelongsTo
    {
        return $this->belongsTo(Problem::class);
    }

    public function studentTutor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_tutor_id');
    }

    public function reviews(): HasMany
{
    return $this->hasMany(Review::class);
}
}
