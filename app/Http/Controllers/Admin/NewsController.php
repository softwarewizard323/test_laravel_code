<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Auth\Authenticatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminNewsRequest;
use App\Models\Data\News;
use Illuminate\Support\Facades\Input;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.news.index', [
            'allNews' => News::get()
        ]);
    }

    public function add(Authenticatable $user, AdminNewsRequest $request)
    {
        if ($request->isMethod('post')) {
            $news = new News();
            $news->news_title = $request->news_title;
            $news->news_content = $request->news_content;
            $news->news_writer = $user->username;
            $news->save();

            return redirect('/admin/news');
        }

        return view('admin.news.add', [
            'user' => $user
        ]);
    }

    public function edit(AdminNewsRequest $request, $id)
    {
        $news = News::find($id);

        if ($request->isMethod('post')) {
            $news->news_title = $request->news_title;
            $news->news_content = $request->news_content;
            $news->news_status = ($request->news_status == 1) ? 1 : 0;
            $news->save();
        }

        return view('admin.news.edit', [
            'news' => $news
        ]);
    }

    public function status($id)
    {
        $news = News::find($id);
        if ($news) {
            $news->news_status = ($news->news_status == 1) ? 0 : 1;
            $news->save();
        }

        return redirect('/admin/news');
    }

    public function delete($id = null)
    {
        if ($id) {
            News::where('news_id', $id)->delete();
        } else {
            if (is_array(Input::get('checkbox'))) {
                News::whereIn('news_id', Input::get('checkbox'))->delete();
            }
        }

        return view('admin.news.loader');
    }
}
