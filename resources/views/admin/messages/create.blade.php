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
                    <h5>New Message for Order <b>#{{ $id }}</b> and user <b>{{ $username }}</b></h5>
                    <div class="widget-buttons">
                        <a class="btn" href="{{ url('/admin/messages') }}" style="margin:-5px 0 0 0;"><i class="icon-remove-sign"></i> Cancel New Message</a>
                    </div>
                </div>
                <div class="widget-body">
                    <div class="widget-footer">
                        <div class="row-fluid">
                            <form class="span12" action="{{ $action }}" method="post" id="messageSubmit">
                                {{ csrf_field() }}
                                <div class="control-group">
                                    <div class="controls">
                                        <input type="text" name="msgTitle" class="span12" style="margin-bottom: 0" placeholder="Click Here to type message title&hellip;">
                                        @if($errors->has('msgTitle'))
                                            <font color="#ff0000" size="2">{{ $errors->first('msgTitle') }}</font>
                                        @endif
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <textarea name="msgText" class="replybox span12" style="height: 250px; margin-bottom: 0" placeholder="Click Here to type message&hellip;">{!! $content !!}</textarea>
                                        @if($errors->has('msgText'))
                                            <font color="#ff0000" size="2">{{ $errors->first('msgText') }}</font>
                                        @endif
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        @if ($signatures->count() > 0)
                                            @foreach($signatures as $signature)
                                            <div id="signature{{ $signature['signature_id'] }}" style="margin: 0 0 15px 0; padding: 0 0 0 15px; border-left: solid 2px #CCC;">{!! $signature['signature_content'] !!}</div>
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
                                </div>
                                <div class="pull-right">
                                    <button class="btn btn-primary" type="submit" name="answerSubmit" value="Send" ><i class="icon-reply"></i> Send</button>
                                </div>
                            </form>
                        </div>
                    </div> <!-- END widget-footer -->
                </div> <!-- END widget-body -->
            </div> <!--- END widget widget-padding span10 -->
        </div> <!-- END row-fluid -->
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