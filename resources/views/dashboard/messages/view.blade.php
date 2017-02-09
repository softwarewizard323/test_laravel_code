@extends('dashboard.layouts.app')

@section('title', ' - My Messages')

@section('content')

    <!-- Main window -->
    <div class="main_container" id="msgRead_page">
        <br>
        <div class="row-fluid">
            <div class="widget widget-padding span10">
                <div class="widget-header">
                    <i class="icon-envelope-alt"></i>
                    <h5>{{ $message['messageTitle'] }}</h5>
                    <div class="widget-buttons">
                        <a class="btn" href="{{ url('/dashboard/messages') }}" style="margin:-5px 0 0 0;"><i class="icon-backward"></i></a>
                        <a class="btn" href="#" style="margin:-5px 0 0 0;"><i class="icon-edit"></i></a>
                        <button class="btn" onclick="return confirm('Are you sure want to delete these message');"><i class="icon-trash"></i></button>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="row-fluid">
                        <div class="header span12">
                            <div class="pull-left">
                                <strong>@if ($message['adminUsername'] == 'piyushk61') piyush <span class="label label-success">admin</span> @else @if($message->repliy) {{ $message->repliy->adminUsername }} @endif <span class="label label-success">admin</span>@endif</strong>
                            </div>
                            <div class="pull-right">
                                <time>{{ date('l, d/m/Y',strtotime($message->messageDate)) }}</time>
                            </div>
                        </div>
                        <p>{!! str_replace("\\","",$message->messageText) !!}</p>
                        <p>@if($message->signature) {!! $message->signature->signature_content !!} @endif</p>
                        <hr>
                    </div>

                    @if ($message->replies)
                    @foreach($message->replies as $reply)
                    <div class="row-fluid">
                        <div class="header span12">
                            <div class="pull-left">
                                <b>
                                    @if ($reply['msgIdentify'] == '1')
                                    <span class="bold">{{ $user->username }}</span>
                                    @else
                                        @if ($reply['adminUsername'] == 'piyushk61') <strong>piyush</strong> <span class="label label-success">admin</span>
                                        @else <strong>{{ $reply->adminUsername }}</strong> <span class="label label-success">admin</span>
                                        @endif
                                    @endif
                                </b>
                            </div>
                            <div class="pull-right">
                                <time>{{ date('l, d/m/Y',strtotime($reply->msgReplyDate)) }}</time>
                            </div>
                        </div>
                        <p>{!! str_replace("\\","",$reply->msgReplyText) !!}</p>
                        <p>@if ($reply->signature) <i>{!! $reply->signature->signature_content !!}</i> @endif</p>
                    </div>
                    <hr>
                    @endforeach
                    @endif

                    <div class="widget-footer">
                        <div class="row-fluid">
                            <form class="span12" action="{{ url('/dashboard/message', ['id' => $message->messageID]) }}" method="post" id="messageSubmit">
                                {{ csrf_field() }}
                                <div class="control-group">
                                    <div class="controls">
                                        <textarea name="msgAnswer" class="replybox span12" style="height: 250px" placeholder="Click Here to Reply&hellip;"></textarea>
                                    </div>
                                    <div class="pull-right">
                                        <button class="btn btn-primary" type="submit" name="answerSubmit" value="Send" > <i class="icon-reply"></i> Reply</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
