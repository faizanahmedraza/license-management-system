<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class UserInfo extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    /**
     * Prepare proper error handling for url attribute
     *
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        // if file avatar exist in storage folder
        $avatar = public_path(Storage::url($this->avatar));
        if (is_file($avatar) && file_exists($avatar)) {
            // get avatar url from storage
            return Storage::url($this->avatar);
        }

        // check if the avatar is an external url, eg. image from google
        if (filter_var($this->avatar, FILTER_VALIDATE_URL)) {
            return $this->avatar;
        }

        // no avatar, return blank avatar
        return asset('assets/media/avatars/blank.png');
    }

    /**
     * User info relation to user model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
