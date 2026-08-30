<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Problem;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name',
    'email',
    'role',
    'password',
    'points',
    'account_status',
    'suspended_until',
    'phone',
    'department',
    'profile_picture',
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'suspended_until' => 'datetime',
        ];
    }
    public function problems()
{
    return $this->hasMany(Problem::class);
}
    public function bookmarkedProblems(): BelongsToMany
{
    return $this->belongsToMany(Problem::class, 'bookmarks');
}
public function badgeName(): string
{
    if ($this->points >= 4000) {
        return 'Platinum';
    }

    if ($this->points >= 3000) {
        return 'Diamond';
    }

    if ($this->points >= 2000) {
        return 'Gold';
    }

    if ($this->points >= 1000) {
        return 'Silver';
    }

    return 'Copper';
}
public function nextBadgePoints(): ?int
{
    if ($this->points < 1000) {
        return 1000;
    }

    if ($this->points < 2000) {
        return 2000;
    }

    if ($this->points < 3000) {
        return 3000;
    }

    if ($this->points < 4000) {
        return 4000;
    }

    return null;
}
public function badgeProgress(): int
{
    if ($this->points >= 4000) {
        return 100;
    }

    if ($this->points >= 3000) {
        return (int) (($this->points - 3000) / 1000 * 100);
    }

    if ($this->points >= 2000) {
        return (int) (($this->points - 2000) / 1000 * 100);
    }

    if ($this->points >= 1000) {
        return (int) (($this->points - 1000) / 1000 * 100);
    }

    return (int) ($this->points / 1000 * 100);
}
public function wallet(): HasOne
{
    return $this->hasOne(Wallet::class);
}
public function warnings(): HasMany
{
    return $this->hasMany(UserWarning::class, 'user_id');
}
public function reportsReceived(): HasMany
{
    return $this->hasMany(Report::class, 'reported_user_id');
}

public function solutions(): HasMany
{
    return $this->hasMany(Solution::class, 'student_tutor_id');
}
public function issuedWarnings(): HasMany
{
    return $this->hasMany(UserWarning::class, 'admin_id');
}
public function studentConversations(): HasMany
{
    return $this->hasMany(Conversation::class, 'student_id');
}

public function tutorConversations(): HasMany
{
    return $this->hasMany(Conversation::class, 'student_tutor_id');
}

public function sentMessages(): HasMany
{
    return $this->hasMany(Message::class, 'sender_id');
}

public function reviewsGiven(): HasMany
{
    return $this->hasMany(Review::class, 'reviewer_id');
}

public function reviewsReceived(): HasMany
{
    return $this->hasMany(Review::class, 'reviewed_user_id');
}
}
