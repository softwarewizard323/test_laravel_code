@extends('admin.layouts.app')

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
                        <a class="btn" href="{{ url('/admin/messages') }}" style="margin:-5px 0 0 0;"><i class="icon-backward"></i></a>
                        <a class="btn" href="#" style="margin:-5px 0 0 0;"><i class="icon-edit"></i></a>
                        <a href="{{ url('/admin/message/unread', ['id' => $message->messageID]) }}" class="btn btn-warning" onclick="return confirm('Are you sure want to unread this message');" style="color: #FFF; margin:-5px 0 0 0;"><i class="icon-folder-close-alt"></i></a>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="row-fluid">
                        <div class="header span12">
                            <div class="pull-left">
                                <strong>@if ($message->reply['adminUsername'] == 'piyushk61') piyush <span class="label label-success">admin</span> @else {{ $message->reply['adminUsername'] }} <span class="label label-success">admin</span> @endif</strong>
                            </div>
                            <div class="pull-right">
                                <time>{{ date('l, d/m/Y',strtotime($message->messageDate)) }}</time>
                            </div>
                        </div>
                        <p>{!! str_replace("\\","",$message->messageText) !!}</p>
                        <p>@if($message->signature) {!!  $message->signature->signature_content !!} @endif</p>
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
                            <form class="span12" action="{{ url('/admin/message', ['id' => $message->messageID]) }}" method="post" id="messageSubmit">
                                {{ csrf_field() }}
                                <input type="hidden" name="userUsername" value="{{ $message['userUsername'] }}" />
                                <div class="control-group">
                                    <div class="controls">
                                        <textarea name="msgAnswer" class="replybox span12" style="height: 250px; margin-bottom: 0" placeholder="Click Here to Reply&hellip;"></textarea>
                                        @if($errors->has('msgAnswer'))
                                            <font color="#ff0000" size="2">{{ $errors->first('msgAnswer') }}</font>
                                        @endif
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                    @if ($signatures->count() > 0)
                                        @foreach($signatures as $signature)
                                        <div id="signature{{ $signature['signature_id'] }}" style="margin: 0 0 15px 0; padding: 0 0 0 15px; border-left: solid 2px #CCC;">{!! $signature['signature_content']  !!}</div>
                                        @endforeach

                                        <select name="signatureID" id="signature">
                                            <option class="showSignature0" value="0">No Signature</option>
                                            @foreach($signatures as $signature)
                                            <option class="showSignature{{ $signature['signature_id'] }}" value="{{ $signature['signature_id'] }}">Signature {{ $signature['signature_id'] }}</option>
                                            @endforeach
                                        </select>

                                        <a href="{{ url('/admin/signature/create') }}" class="btn btn-warning btn-mini" style="margin: 0 0 11px 15px;">Add New Signiture</a>
                                    @endif
                                    </div>
                                    <div class="pull-right">
                                        <button class="btn btn-primary" type="submit" name="answerSubmit" value="Send" ><i class="icon-reply"></i> Reply</button>
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

@section('page_script')
    <script>
        $(function() {
            $('#signature').change(function() {
                var option = $(this).find('option:selected');
                @foreach($signatures as $signature)
                $('#signature{{ $signature['signature_id'] }}').toggle(option.hasClass('showSignature{{ $signature['signature_id'] }}'));
                @endforeach
            }).change();
        });
    </script>
@stop