<?php

namespace App\Http\Controllers\Admin;

use App\Models\Data\BalanceHistory;
use App\Models\Data\OrderEnd;
use App\User;
use App\Models\Data\UserSettings;
use App\Models\Domain\SendMail;
use Illuminate\Http\Request;
use App\Models\Data\NewOrder;
use App\Models\Data\Source;
use App\Repositories\NewOrderRepository;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    private $orders;

    public function __construct(NewOrderRepository $newOrderRepository)
    {
        $this->middleware('auth');
        $this->middleware('admin');

        $this->orders = $newOrderRepository;
    }

    public function index($filter = null)
    {
        if ($filter == 'update') {
            abort(404);
        }

        $status = [
            0 => 'pending',
            1 => 'active',
            3 => 'completed'
        ];

        return view('admin.orders.index', [
            'filter' => $filter,
            'title' => 'User '. ucfirst($filter) .' Orders',
            'orders' => $this->orders->forAdminWithStatus(array_search($filter, $status)),
        ]);
    }

    public function hidden()
    {
        return view('admin.orders.index', [
            'filter' => 'hidden',
            'title' => 'Hidden Pending User Orders',
            'orders' => $this->orders->forAdminWithStatus(0, 1),
        ]);
    }

    public function end()
    {
        return view('admin.orders.end', [
            'filter' => 'end',
            'title' => '# of campaigns that users requested to End',
            'orders' => $this->orders->forAdminEnd(),
        ]);
    }

    /*
    * UPDATE
    */

    public function get($id)
    {
        $order = NewOrder::where('order_id', $id)->first();
        if (!$order) {
            abort(404);
        }

        return $order;
    }

    public function edit(Request $request, $id)
    {
        if ($request->isMethod('post'))
        {
            $order = $this->get($id);
            $order->username = $request->username;
            $order->source = $request->source;
            $order->country = $request->country;
            $order->quantity = $request->quantity;
            $order->total_quantity = $request->total_quantity ;
            $order->website = $request->website;
            $order->keywords = $request->keywords;
            $order->price = $request->price;
            $order->date = $request->date;
            $order->type = $request->type;
            $order->status = $request->status;
            $order->save();

            return redirect($request->previous_page);
        }

        return view('admin.orders.edit', [
            'sources' => Source::get(),
            'order' => $this->get($id),
        ]);
    }

    public function delete($id)
    {
        $order = $this->get($id);
        $order->delete();

        return redirect(\URL::previous());
    }

    public function hide($id)
    {
        $order = $this->get($id);
        $order->admin_status = 1;
        $order->save();

        return redirect(\URL::previous());
    }

    public function reveal($id)
    {
        $order = $this->get($id);
        $order->admin_status = 0;
        $order->save();

        return redirect(\URL::previous());
    }

    public function startCampaign($id)
    {
        $order = $this->get($id);
        $order->status = 1;
        $order->save();

        $user = User::where('username', $order->username)->first();

        UserSettings::where('username', $user->username)->update(['account_balance' => $user->settings->account_balance - 0.20]);

        $history = new BalanceHistory();
        $history->username = $user->username;
        $history->amount = 0.50;
        $history->order_id = $order->order_id;
        $history->type = 'activation';
        $history->save();

        SendMail::sendStartCampaign($user, $order);

        return redirect(\URL::previous());
    }

    public function endCampaign($id)
    {
        $order = $this->get($id);
        $order->status = 3;
        $order->save();

        OrderEnd::where('order_id', $order->order_id)->update(['status' => 1]);

        return redirect(\URL::previous());
    }

    public function confirmCampaign($id)
    {
        $order = $this->get($id);
        OrderEnd::where('order_id', $order->order_id)->update(['status' => 1]);

        return redirect(\URL::previous());
    }
}
