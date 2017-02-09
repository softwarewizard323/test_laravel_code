<?php

namespace App\Repositories;

use App\Models\Data\DripfeedCountry;
use App\Models\Data\Source;
use App\Models\Data\VipUser;
use App\Models\Data\NewOrder;
use Illuminate\Contracts\Auth\Authenticatable;

class BoosterRepository
{
    protected $vip;
    protected $order;
    protected $source;
    protected $dripfeed;

    /**
     * The task repository instance.
     *
     * @var Source
     * @var VipUser
     * @var NewOrder
     * @var DripfeedCountry
     */
    public function __construct(VipUser $vip, NewOrder $order, Source $source, DripfeedCountry $dripfeed)
    {
        $this->vip = $vip;
        $this->order = $order;
        $this->sourse = $source;
        $this->dripfeed = $dripfeed;
    }

    public function vip(Authenticatable $user)
    {
        return $this->vip
            ->where('username', $user->username)
            ->where('status', '!=', 1)
            ->first();
    }

    public function sources($type)
    {
        return $this->sourse
            ->where('source_type', $type)
            ->where('source_discount', 0)
            ->get();
    }

    public function source($id)
    {
        return $this->sourse
            ->where('source_id', $id)
            ->first();
    }

    public function dailySpending(Authenticatable $user)
    {
        return $this->order
            ->where('username', $user->username)
            ->where('status', 1)
            ->where('discount', 0)
            ->groupBy('username')
            ->sum('price');
    }

    public function countDripfeed($country)
    {
        return $this->dripfeed
            ->where('country', $country)
            ->count();
    }
}