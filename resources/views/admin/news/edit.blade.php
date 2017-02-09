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
                <h5>Edit news #{{ $news['news_id'] }}</h5>
                <div class="widget-buttons">
                    <a class="btn" href="{{ url('/admin/news') }}" style="margin:-5px 0 0 0;"><i class="icon-remove-sign"></i> Cancel</a>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-footer">
                    <div class="row-fluid">
                        <form action="{{ url('/admin/news/edit', ['id' => $news['news_id']]) }}" method="post" name="form1" id="form1">
                            {{ csrf_field() }}
                            <div class="control-group">
                                <div class="controls">
                                    <input type="text" name="news_title" class="span12" value="{{ $news['news_title'] }}" size="32" />
                                    @if($errors->has('news_title'))
                                        <font color="#ff0000" size="2">{{ $errors->first('news_title') }}</font>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <textarea class="replybox span12" style="height: 250px" name="news_content" cols="50" rows="5">{!! $news['news_content'] !!}</textarea>
                                    @if($errors->has('news_content'))
                                        <font color="#ff0000" size="2">{{ $errors->first('news_content') }}</font>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <select name="news_status">
                                        <option value="1" @if ($news['news_status'] == 1) SELECTED @endif>Activate</option>
                                        <option value="0" @if ($news['news_status'] == 0) SELECTED @endif>Deactivate</option>
                                    </select>
                                </div>
                                <div class="pull-right">
                                    <input class="btn btn-primary" type="submit" value="Update News" />
                                </div>
                            </div>
                        </form>
                    </div> <!-- END widget-footer -->
                </div> <!-- END widget-body -->
            </div> <!--- END widget widget-padding span10 -->
        </div> <!-- END row-fluid -->
    </div>
</div>
@stop