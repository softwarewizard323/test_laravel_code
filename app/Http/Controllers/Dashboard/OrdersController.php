<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Data\OrderEnd;
use App\Http\Controllers\Controller;
use App\Models\Data\NewOrder;
use App\Repositories\NewOrderRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Input;


class OrdersController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var NewOrderRepository
     */
    protected $orders;

    public function __construct(NewOrderRepository $orders)
    {
        $this->middleware('auth');
        $this->middleware('maintenance');
        $this->middleware('banned');
        $this->orders = $orders;
    }

    public function index(Authenticatable $user)
    {
        return view('dashboard.orders.index', [
            'user' => $user,
            'orders' => $this->orders->forOrders($user),
        ]);
    }

    public function process($id)
    {
        $order = NewOrder::find($id);

        // If isset ending pending campaign
        if (Input::get('endPending')) {
            if ($order) {
                $order->delete();
            }

            return redirect('/dashboard');
        }

        // If isset end campaign
        if (Input::get('endCampaign')) {
            if ($order) {
                $model = new OrderEnd();
                $model->order_id = $order->order_id;
                $model->username = \Auth::user()->username;
                $model->request_end = date("Y-m-d H:i:s");
                $model->status = 0;
                $model->save();
            }

            return redirect('/dashboard');
        }

        if (Input::get('reOrder')) {
            if ($order) {
                $order->status = 0;
                $order->date = date("Y-m-d H:i:s");
                $order->admin_status = 0;
                $order->save();

                OrderEnd::where('order_id', $order->order_id)->delete();
            }

            return redirect('/dashboard/orders');
        }
    }
}
