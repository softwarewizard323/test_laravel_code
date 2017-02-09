<?php

namespace App\Http\Controllers\Admin;

use App\Models\Data\Signature;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Input;

class SignaturesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $data = (object)[];
        $data->allSignatures = Signature::all();

        return view('admin.signatures.signature', compact('data'));
    }

    public function create(Authenticatable $user)
    {
        return view('admin.signatures.create-signature', compact('user'));
    }

    public function save(Authenticatable $user)
    {
        $model = new Signature();
        $model->signature_content = Input::get('signatureText');
        $model->signature_user = $user->username;
        $model->save();
        return redirect(url('/admin/signatures'));
    }

    public function delete($id)
    {
        Signature::find($id)->delete();
        return redirect(\URL::previous());
    }

    public function groupDelete()
    {
        if (!empty(Input::get('checkbox'))) {
            Signature::whereIn('signature_id', Input::get('checkbox'))->delete();
        }
        return redirect(\URL::previous());
    }

}