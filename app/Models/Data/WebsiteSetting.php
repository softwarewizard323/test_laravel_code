<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $table = 'ev_website_settings';

    public $timestamps = false;

    public static function get($setting)
    {
        return WebsiteSetting::where('setting', $setting)->first()->value;
    }
}
