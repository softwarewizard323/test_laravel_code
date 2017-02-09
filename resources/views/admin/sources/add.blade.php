@extends('admin.layouts.app')

@section('breadcrumb')
@stop

@section('content')
<div class="main_container" id="msgRead_page">
<br>
    <div class="row-fluid">
        <div class="widget widget-padding span8">
            <div class="widget-header">
                <i class="icon-anchor"></i>
                <h5>Add New Source</h5>
            </div>
            <div class="widget-body" style="height: auto; overflow: auto;">
                {{ Form::open(['url' => '/admin/source/add']) }}
                <div class="row span10" style="margin-left:2.5%">
                    <div class="span3 pull-left text-left">Source name:</div>
                    <div class="span9 pull-left">
                        {!! Form::text('source_name', null, ['class' => 'span12']) !!}
                        @if($errors->has('source_name'))
                            <font color="#ff0000" size="2">{{ $errors->first('source_name') }}</font>
                        @endif
                    </div>
                </div>
                <div class="row span10">
                    <div class="span3 pull-left text-left">Source description:</div>
                    <div class="span9 pull-left">
                        {!! Form::textarea('source_desc', null, ['class' => 'replybox span12', 'rows' => 5, 'cols' => 50]) !!}
                        @if($errors->has('source_desc'))
                            <font color="#ff0000" size="2">{{ $errors->first('source_desc') }}</font>
                        @endif
                    </div>
                </div>
                <div class="row span10">
                    <div class="span3 pull-left text-left">Source country:</div>
                    <div class="span9 pull-left">
                        {!! Form::text('source_country', null, ['class' => 'span12']) !!}
                        @if($errors->has('source_country'))
                            <font color="#ff0000" size="2">{{ $errors->first('source_country') }}</font>
                        @endif
                    </div>
                </div>
                <div class="row span10">
                    <div class="span3 pull-left text-left">Source price:</div>
                    <div class="span9 pull-left">
                        {!! Form::text('source_price', null, ['class' => 'span12']) !!}
                        @if($errors->has('source_price'))
                            <font color="#ff0000" size="2">{{ $errors->first('source_price') }}</font>
                        @endif
                    </div>
                </div>
                <div class="row span10">
                    <div class="span3 pull-left text-left">Allow 24h dripfeed:</div>
                    <div class="span9 pull-left">
                        {!! Form::hidden('source_dripfeed', 0) !!}
                        {!! Form::checkbox('source_dripfeed') !!}
                    </div>
                </div>
                <div class="row span10">
                    <div class="span3 pull-left text-left">Source subscribe:</div>
                    <div class="span9 pull-left">
                        {!! Form::hidden('source_subscribe', 0) !!}
                        {!! Form::checkbox('source_subscribe') !!}
                    </div>
                </div>
                <div class="row span10">
                    <div class="span3 pull-left text-left">Source status:</div>
                    <div class="span9 pull-left">
                        {!! Form::select('source_status', ['2' => 'Limited', 1 => 'Competitive', 0 => 'Active']) !!}
                    </div>
                </div>
                <div class="row span10">
                    <div class="span3 pull-left text-left">Source discount:</div>
                    <div class="span9 pull-left">
                        {!! Form::hidden('source_discount', 0) !!}
                        {!! Form::checkbox('source_discount') !!}
                    </div>
                </div>
                <div class="row span10" style="margin-top:2.5%">
                    <div class="span3 pull-left text-left">&nbsp;</div>
                    <div class="span9 pull-left">
                        <input type="submit" value="Insert Source" class="btn btn-success btn-large" />
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<style>
    .span10 { margin-bottom: 10px; }
    .span9 .span12 { margin-bottom: 0; }
</style>
@stop