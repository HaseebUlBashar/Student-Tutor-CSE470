<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    protected $fillable = [
        'problem_id',
        'student_id',
        'student_tutor_id',
    ];

    public function problem(): BelongsTo
    {
        return $this->belongsTo(Problem::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function studentTutor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_tutor_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
