<?php

namespace App\Repositories;

use App\Models\Data\UserSettings;
use Illuminate\Contracts\Auth\Authenticatable;

class UserSettingsRepository
{

    /**
     * The task repository instance.
     *
     * @var UserSettings
     */
    protected $userSetting;

    public function __construct(UserSettings $userSettings)
    {
        $this->userSetting = $userSettings;
    }

    /**
     * Get all of the tasks for a given user.
     *
     * @param  $user
     * @return Collection
     */
    public function userSettings($user)
    {
        return $this->userSetting->where('username', $user->username)->first();
    }
}