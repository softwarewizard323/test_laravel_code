<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminSourceRequest;
use App\Models\Data\SourceReview;
use App\Http\Controllers\Controller;
use App\Models\Data\Source;
use App\Models\Data\DripfeedCountry;
use Illuminate\Support\Facades\Input;

class SourcesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.sources.index', [
            'sources' => Source::all(),
            'reviews' => SourceReview::all(),
            'dripFeedCountries' => DripfeedCountry::all()
        ]);
    }

    public function add(AdminSourceRequest $request)
    {
        if ($request->isMethod('post')) {
            $source = Source::create($request->all());

            return redirect(url('/admin/source', ['id' => $source->source_id]));
        }

        return view('admin.sources.add');
    }

    public function edit(AdminSourceRequest $request, $id)
    {
        $source = Source::find($id);

        if ($request->isMethod('post')) {
            $source->update($request->all());

            return redirect(url('/admin/source', ['id' => $source->source_id]));
        }

        return view('admin.sources.edit', [
            'source' => $source
        ]);
    }

    public function delete($id)
    {
        Source::where('source_id', $id)->delete();
        return redirect('/admin/sources');
    }

    public function dripFeed()
    {
        if (!empty(Input::get('addDripDeedCountry'))) {
            $model = new DripfeedCountry();
            $model->country = Input::get('addDripDeedCountry');
            $model->save();
        }

        if (!empty(Input::get('deleteDripDeedCountry'))) {
            DripfeedCountry::where('country', Input::get('deleteDripDeedCountry'))->delete();
        }

        return redirect('/admin/sources');
    }
}
