<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'user_type',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'user_type' => 'integer',
        'status' => 'integer',
    ];

    const USER_TYPE = ['admin' => 1, 'customer' => 2];
    const STATUS = ['pending' => 0, 'active' => 1, 'blocked' => 2];

    /**
     * Set the user's first name.
     *
     * @param string $value
     * @return void
     */
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = strtolower($value);
    }

    /**
     * Set the user's last name.
     *
     * @param string $value
     * @return void
     */
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = strtolower($value);
    }

    /**
     * Set the user's email.
     *
     * @param string $value
     * @return void
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = trim(strtolower($value));
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Set the user's password.
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make(trim($value));
    }

    /**
     * Prepare proper error handling for url attribute
     *
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->info && $this->info->avatar_url) {
            return asset($this->info->avatar_url);
        }

        return asset('assets/media/avatars/blank.png');
    }

    /**
     * Get the user's user_type.
     *
     * @return string
     */
    public function getUserRoleAttribute()
    {
        return array_flip(self::USER_TYPE)[$this->user_type];
    }

    /**
     * Get the user's current status.
     *
     * @return string
     */
    public function getUserStatusAttribute()
    {
        return array_flip(self::STATUS)[$this->status];
    }

    /**
     * User relation to info model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function info()
    {
        return $this->hasOne(UserInfo::class, 'user_id', 'id');
    }

    /**
     * User relation to license model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function licenses()
    {
        return $this->hasMany(License::class, 'user_id', 'id');
    }
}
