<?php

namespace App\Repositories;

use App\Models\Data\NewOrder;
use Illuminate\Auth\Authenticatable;

class NewOrderRepository
{

    /**
     * The task repository instance.
     *
     * @var NewOrder
     */
    protected $order;

    public function __construct(NewOrder $order)
    {
        $this->order = $order;
    }

    /**
     * Get all of the tasks for a given user.
     *
     * @param  $user
     * @return Collection
     */
    public function forOrders($user)
    {
        return $this->order
            ->where('username', $user->username)
            ->where('status', 3)
            ->get();
    }

    public function dailySpending($user)
    {
        return $this->order
            ->where('username', $user->username)
            ->where('discount', 0)
            ->where('status', 1)
            ->get();
    }

    public function forAdminWithStatus($status, $admin_status = 0)
    {
        return $this->order
            ->where('status', $status)
            ->where('admin_status', $admin_status)
            ->orderBy('date', 'desc')
            ->get();
    }

    public function forAdminEnd($status = 0)
    {
        return $this->order
            ->select(\DB::raw('*, tbl_new_orders.date as order_date'))
            ->join('tbl_order_end', 'tbl_new_orders.order_id', '=', 'tbl_order_end.order_id')
            ->where('tbl_order_end.status', $status)
            ->get();
    }
}