<?php

namespace App;

use App\Models\Data\BannedUser;
use App\Models\Data\UserSettings;
use App\Models\Domain\Dashboard;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'ev_users';

    const ADMIN_NAME = 'admin';

    const SPECIAL = [
        'admin_name' => 'testx',
        'guest_name' => 'Guest',
        'admin_level' => 1,
        'guest_level' => 1,
        'user_level' => 1,
    ];

    const LEVELS = [
        1 => 'Basic Level',
        2 => 'Advanced Level',
        3 => 'Premier Level',
        6 => 'Forum Admin',
        7 => 'Support Admin',
        8 => 'Order Admin',
        9 => 'Admin'
    ];

    const LEVEL_BASIC = 1;
    const LEVEL_ADVANCED = 2;
    const LEVEL_PREMIER = 3;
    const LEVEL_FORUM_ADMIN = 6;
    const LEVEL_SUPPORT_ADMIN = 7;
    const LEVEL_ORDER_ADMIN = 8;
    const LEVEL_ADMIN = 9;

    const RESERVED = 'Guest';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'username', 'email', 'password', 'userlevel', 'userid', 'timestamp',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Check if user has admin role.
     *
     * @return mixed
     */
    public function getIsAdminAttribute()
    {
        return ($this->userlevel == self::LEVEL_ADMIN || $this->username  == self::ADMIN_NAME);
    }

    public function getIsForumAdminAttribute()
    {
        return ($this->userlevel == self::LEVEL_FORUM_ADMIN);
    }

    public function getIsSupportAdminAttribute()
    {
        return ($this->userlevel == self::LEVEL_SUPPORT_ADMIN || $this->userlevel == self::LEVEL_ADMIN);
    }

    public function getIsOrderAdminAttribute()
    {
        return ($this->userlevel == self::LEVEL_ORDER_ADMIN || $this->userlevel == self::LEVEL_ADMIN);
    }

    public function getIsBannedAttribute()
    {
        $user = BannedUser::where('username', $this->username)->first();
        return ($user) ? true : false;
    }

    public function getSettingsAttribute()
    {
        return UserSettings::where('username', $this->username)->first();
    }

    public function getFullNameAttribute()
    {
        return $this->fname . ' ' . $this->lname;
    }

    public function getGravatarAttribute()
    {
        return Dashboard::get_gravatar($this->email);
    }
}
