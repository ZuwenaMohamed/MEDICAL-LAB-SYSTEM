<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Traits\HasRoles;

#[Fillable([
    'name',
    'email',
    'password',
    'status',
    'employee_number',
    'phone',
    'last_login_at',
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory,HasRoles, Notifiable;

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
        ];
    }

        public function branches(): BelongsToMany
    {
        return $this->belongsToMany(Branch::class)
            ->withTimestamps();
    }
    protected static function booted(): void
    {
        static::creating(function (User $user) {
            if (empty($user->employee_number)) {
                $lastNumber = User::whereNotNull('employee_number')
                    ->selectRaw("MAX(CAST(SUBSTRING(employee_number, 4) AS UNSIGNED)) as number")
                    ->value('number');

                $user->employee_number = 'EMP' . str_pad(
                    ($lastNumber ?? 0) + 1,
                    4,
                    '0',
                    STR_PAD_LEFT
                );
            }
        });
    }
    public function getEncryptedIdAttribute(): string
    {
        return Crypt::encryptString((string) $this->id);
    }
}
