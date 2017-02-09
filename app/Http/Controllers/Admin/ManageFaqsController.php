<?php

namespace App\Http\Controllers\Admin;

use App\Models\Data\Faq;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Input;

class ManageFaqsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
//        $query_faq = " SELECT * FROM tbl_faq ";
        $data = (object)[];
        $data->allFAQs = Faq::all();

        return view('admin.faq.manage-faq', compact('data'));
    }

    public function editFaq($id, Authenticatable $user)
    {
        $faq = Faq::find($id);
        return view('admin.faq.edit-faq', compact('faq', 'user'));
    }

    public function addFaq(Authenticatable $user)
    {
        $faq = new Faq();
        return view('admin.faq.edit-faq', compact('faq', 'user'));
    }

    public function deleteFaq($id)
    {
        Faq::find($id)->delete();
        return redirect(\URL::previous());
    }

    public function save(Authenticatable $user)
    {
        $model = new Faq();
        if (($id = Input::get('id')) != '' ){
            $model = Faq::find($id);
        }
        $model->faq_question = Input::get('faqQuestion');
        $model->faq_asnwer = Input::get('faqText');
        $model->faq_status  =Input::get('status');
        $model->user = $user->username;
        $model->save();
        return redirect('admin/faq');
    }
}