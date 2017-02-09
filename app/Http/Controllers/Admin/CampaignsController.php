<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Auth\Authenticatable;
use App\Http\Controllers\Controller;
use App\Models\Data\NewConversionOrder;
use App\Models\Domain\SendMail;

class CampaignsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index($filter = null)
    {
        $status = [
            0 => 'pending',
            1 => 'active',
            3 => 'completed'
        ];

        if (!in_array($filter, $status)) {
            abort(404);
        }

        return view('admin.conversion.index', [
            'title' => 'User '. ucfirst($filter) .' Conversion Orders',
            'orders' => NewConversionOrder::where('corder_status', array_search($filter, $status))->get(),
        ]);
    }

    /*
    * UPDATE
    */

    public function get($id)
    {
        $order = NewConversionOrder::where('co_id', $id)->first();
        if (!$order) {
            abort(404);
        }

        return $order;
    }

    public function delete($id)
    {
        $order = $this->get($id);
        $order->delete();

        return redirect(\URL::previous());
    }

    public function startCampaign(Authenticatable $user, $id)
    {
        $order = $this->get($id);
        $order->corder_status = 1;
        $order->save();

        SendMail::sendStartConversion($user, $order);

        return redirect(\URL::previous());
    }

    public function endCampaign($id)
    {
        $order = $this->get($id);
        $order->corder_status = 3;
        $order->save();

        return redirect(\URL::previous());
    }
}
