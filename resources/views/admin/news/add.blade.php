@extends('admin.layouts.app')

@section('breadcrumb')
@stop

@section('content')
<div class="main_container" id="msgRead_page">
<br>
    <div class="row-fluid">
        <div class="widget widget-padding span10">
            <div class="widget-header">
                <i class="icon-envelope-alt"></i>
                <h5>Write news</h5>
                <div class="widget-buttons">
                    <a class="btn" href="{{ url('/admin/news') }}" style="margin:-5px 0 0 0;"><i class="icon-remove-sign"></i> Cancel</a>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-footer">
                    <div class="row-fluid">
                        <form class="span12" action="{{ url('/admin/news/add') }}" method="post" id="newsSubmit">
                            {{ csrf_field() }}
                            <div class="control-group">
                                <div class="controls">
                                    <input type="text" name="news_title" class="span12" placeholder="Click Here to type news title&hellip;" value="{{ old('news_title') }}">
                                    @if($errors->has('news_title'))
                                        <font color="#ff0000" size="2">{{ $errors->first('news_title') }}</font>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <textarea name="news_content" class="replybox span12" style="height: 250px" placeholder="Click here to type news&hellip;">{!! old('news_content') !!}</textarea>
                                    @if($errors->has('news_content'))
                                        <font color="#ff0000" size="2">{{ $errors->first('news_content') }}</font>
                                    @endif
                                </div>
                                <div class="pull-right">
                                    <button class="btn btn-primary" type="submit" name="newsSubmit" value="Send" ><i class="icon-reply"></i> Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> <!-- END widget-footer -->
            </div> <!-- END widget-body -->
        </div> <!--- END widget widget-padding span10 -->
    </div> <!-- END row-fluid -->
</div>
@stop