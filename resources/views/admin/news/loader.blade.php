@extends('admin.layouts.app')

@section('breadcrumb')
@stop

@section('content')
    <meta http-equiv="Refresh" content="0; url={{ url('/admin/news') }}">
    <div style="width: 100%; margin: 15% 0 0 0; text-align: center;">
        <h2>Pleas wait...</h2><br />{{ Html::image("include/images/body/ajax-loader.gif", null) }}
    </div>
@stop