@extends('admin.layouts.app')

@section('title', ' - My Messages')

@section('content')

    <!-- Main window -->
    <div class="main_container" id="msgView_page">
        <br>
        <div class="row-fluid">
            <div class="widget widget-padding span12">
                <form method="post" action="{{ url('/admin/message/delete') }}">
                    {{ csrf_field() }}

                    <div class="widget-header">
                        <i class="icon-inbox"></i>
                        <h5>My Messages</h5>
                    </div>

                    <div class="widget-body">
                        <table class="table table-hover" data-provides="rowlink">
                            <tbody>
                            @if ($messages->count() > 0)
                            @foreach($messages as $message)
                                <tr @if ($message->status['messageStatus'] == 0) style="background: #F5F5F5;" @endif>
                                    <td>
                                        <input type="checkbox" name="checkbox[]" id="checkbox[]" value="{{ $message['messageID'] }}">
                                    </td>
                                    <td>
                                        {{ $message['userUsername'] }}
                                    </td>
                                    <td>
                                        @if ($message['orderID'] != '0') Cosmetic Traffic @else Conversion Traffic @endif / <b>
                                        Order #@if ($message['orderID'] != '0') {{ $message['orderID'] }} @else {{ $message['corder_id'] }} @endif</b>
                                        <span class="badge">{{ $message->replies() ->count()}}</span></td>
                                    <td>
                                        @if ($message->status['messageStatus'] == 0 ) <b> @endif
                                        <a href="{{ url('/admin/message', ['id' => $message['messageID']]) }}" class="rowlink">{{ $message['messageTitle'] }}</a>
                                        @if ($message->status['messageStatus'] == 0 ) </b> @endif
                                    </td>
                                    <td>
                                        <time>@if (date('d-m-Y', strtotime($message['statusUpdated'])) == date('d-m-Y', time())) Today @else {{ date('d-m-Y', strtotime($message['statusUpdated'])) }} @endif</time></td>
                                </tr>
                            @endforeach
                            @else
                                <div style="margin: 50px auto; font-size: 19px; color: #999; text-align: center;">No messages inside your Inbox.</div>
                            @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="widget-footer">
                        <div class="pull-left">
                            <p class="muted" style="margin: 5px">Showing {{ $messages->count() }} of {{ $messages->count() }}</p>
                        </div>
                        <div class="pull-right">
                            @if ($messages->count() > 0)
                            <button class="btn" id="delete" type="submit" name="delete" value="Delete Selected Messages" onclick="return confirm('Are you sure want to delete these message(s)');"> <i class="icon-trash"></i> Delete</button>
                            <button class="btn" name="loadMore"><i class="icon-plus"></i> Load More</button>
                            @endif
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
