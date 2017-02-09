@extends('dashboard.layouts.app')

@section('title', ' - Support')

@section('content')

    <!-- Main window -->
    <div class="main_container" id="campaign_page">
        <div class="row-fluid" style="margin-top:20px;">
            <div class="widget widget-padding span6" style="border-top:solid 1px #CCC;">
                <div class="widget-body">
                    <div class="col-lg-12">
                        <img src="{{url("include/style/img/{$program_type}.png")}}" class="img-responsive">
                    </div>
                </div>
                <!-- /widget-body -->
            </div>
        </div>
    </div>

@stop
