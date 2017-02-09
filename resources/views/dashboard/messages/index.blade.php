@extends('dashboard.layouts.app')

@section('title', ' - My Messages')

@section('content')

    <!-- Main window -->
    <div class="main_container" id="msgView_page">
        <br>
        <div class="row-fluid">
            <div class="widget widget-padding span12">
                <div class="widget-header">
                    <i class="icon-inbox"></i>
                    <h5>My Messages</h5>
                </div>
                <div class="widget-body">
                    <table class="table table-hover" data-provides="rowlink">
                        <tbody>
                        @if ($messages->count() > 0)
                        @foreach($messages as $message)
                        <tr @if ($message['messageStatus'] == 0) style="background: #F5F5F5;" @endif>
                            <td>
                                @if ($message['adminUsername'] == 'piyushk61') piyush @else {{ $message['adminUsername'] }} @endif
                                <span class="label label-success">admin</span>
                                <span class="badge">{{ $message->replies() ->count()}}</span>
                            </td>
                            <td>
                                {{ $message->packageMasterName }} {{ $message->packageName }} Booster / <b>Order #{{ $message['orderID'] }}</b>
                            </td>
                            <td>
                                @if ($message['messageStatus'] == 0) <b> @endif
                                <a href="{{ url('/dashboard/message', ['id' => $message['messageID']]) }}" class="rowlink">
                                    {{ $message['messageTitle'] }}
                                </a>
                                @if ($message['messageStatus'] == 0) </b> @endif
                            </td>
                            <td>
                                <time>@if (date('d-m-Y', strtotime($message['statusUpdated'])) == date('d-m-Y', time()) ) Today @else {{ date('d-m-Y', strtotime($message['statusUpdated'])) }} @endif</time>
                            </td>
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
                        <button class="btn"  id="delete" type="submit" name="delete" value="Delete Selected Messages" onclick="return confirm('Are you sure want to delete these message(s)');"><i class="icon-trash"></i> Delete</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
