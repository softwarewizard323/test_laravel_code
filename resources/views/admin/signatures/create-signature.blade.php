@extends('admin.layouts.app')

@section('content')
    <!-- Main window -->
    <div class="main_container" id="msgRead_page">
        <br>
        <div class="row-fluid">
            <div class="widget widget-padding span10">
                <div class="widget-header">
                    <i class="icon-envelope-alt"></i>
                    <h5>Write new signature</h5>
                    <div class="widget-buttons">
                        <a class="btn" href="{{ url('admin/signatures') }}" style="margin:-5px 0 0 0;"><i
                                    class="icon-remove-sign"></i> Cancel</a>
                    </div>
                </div>
                <div class="widget-body">
                    <div class="widget-footer">
                        <div class="row-fluid">
                            <form class="span12" action="{{ url('admin/signature/create') }}" method="post" id="signatureSubmit">
                                {{ csrf_field() }}
                                <input type="hidden" name="adminUsername" value="{{ $user->username }}"/>
                                <div class="control-group">
                                    <div class="controls">
                                        <textarea name="signatureText" class="replybox span12" style="height: 250px"
                                                  placeholder="Click here to type signature&hellip;"></textarea>
                                    </div>
                                    <div class="pull-right">
                                        <button class="btn btn-primary" type="submit" name="signatureSubmit"
                                                value="Send"><i class="icon-reply"></i> Send
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> <!-- END widget-footer -->
                </div> <!-- END widget-body -->
            </div> <!--- END widget widget-padding span10 -->
        </div> <!-- END row-fluid -->
    </div>
    @endsection