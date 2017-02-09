@extends('admin.layouts.app')

@section('breadcrumb')
    <li class="active">News</li>
@stop

@section('content')
<div class="main_container" id="msgView_page">
<br>
    <div class="row-fluid">
        <div class="widget widget-padding span12">
            <form method="post" action="{{ url('/admin/news/delete') }}">
            {{ csrf_field() }}
                <div class="widget-header">
                    <i class="icon-inbox"></i>
                    <h5>All News</h5>
                    <div class="widget-buttons">
                        <a href="{{ url('/admin/news/add') }}" class="btn btn-info" style="margin:-5px 0 0 0; color: #FFF;"><i class="icon-pencil"></i> Create News</a>
                    </div>
                </div>
                <div class="widget-body">
                    @if($allNews->count() > 0)
                    <table class="table table-hover" data-provides="rowlink">
                    <tbody>
                        @foreach( $allNews as $news )
                            <tr @if($news['news_status'] == 1 ) class="success" @endif >
                                <td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="{{ $news['news_id'] }}"></td>
                                @if($news['news_content'] != '')
                                    <td>{{ $news['news_title'] }}</td>
                                @endif
                                @if($news['news_content'] == '')
                                    <td>{{ $news['news_title'] }}</td>
                                @endif
                                <td>{{ date('d-m-Y', strtotime($news['news_date'])) }}</td>
                                <td>{{ $news['news_writer'] }}</td>
                                <td width="100">
                                    <a href="{{ url('/admin/news/delete', ['id' => $news['news_id']]) }}" class="btn btn-mini btn-danger" onclick="return confirm('Are you sure want to delete this news?');">
                                        <i class="icon-lock"></i> Delete
                                    </a><br />
                                    <a href="{{ url('/admin/news/edit', $news['news_id']) }}" class="btn btn-mini btn-warning" style="margin-top: 3px!important;"><i class="icon-edit"></i> Edit</a>
                                    <br />
                                    @if($news['news_status'] == '0')
                                        <a href="{{ url('/admin/news/status', $news['news_id']) }}" class="btn btn-mini btn-success" onclick="return confirm('Are you sure want to make this news live to users?');" style="margin-top: 3px!important;">
                                            <i class="icon-ok-circle"></i> Activate
                                        </a>
                                    @endif
                                    @if($news['news_status'] == '1')
                                        <a href="{{ url('/admin/news/status', $news['news_id']) }}" class="btn btn-mini btn-danger" onclick="return confirm('Are you sure want to hide this news from users?');" style="margin-top: 3px!important;">
                                            <i class="icon-ban-circle"></i> Deactivate
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                    @else
                        <div style="margin: 50px auto 20px auto; font-size: 19px; color: #999; text-align: center;">No news created yet.</div>
                        <div style="margin: 5px auto 50px auto; text-align: center;">
                            <a href="{{ url('/admin/news/add') }}" class="btn btn-info"><i class="icon-pencil"></i> Create News</a>
                        </div>
                    @endif
                </div>

                <div class="widget-footer">
                    <div class="pull-left">
                        <p class="muted" style="margin: 5px">Showing {{ $allNews->count() }} of {{ $allNews->count() }}</p>
                    </div>
                    <div class="pull-right">
                        @if ($allNews->count() > 0)
                        <button class="btn"  id="delete" type="submit" name="delete" value="Delete Selected Messages" onclick="return confirm('Are you sure you want to delete these news?');"> <i class="icon-trash"></i> Delete</button>
                        @endif
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@stop