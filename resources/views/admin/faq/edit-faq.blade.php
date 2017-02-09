@extends('admin.layouts.app')

@section('content')
<!-- Main window -->
<div class="main_container" id="msgRead_page">
    <br>
    <div class="row-fluid">
        <div class="widget widget-padding span10">
            <div class="widget-header">
                <i class="icon-question-sign"></i>
                <h5>Edit FAQ</h5>
                <div class="widget-buttons">
                    <a class="btn" href="{{ url('/admin/faq') }}" style="margin:-5px 0 0 0;"><i class="icon-remove-sign"></i> Cancel</a>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-footer">
                    <div class="row-fluid">
                        <form class="span12" action="{{ url('admin/faq/save') }}" method="post" id="faqSubmit">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $faq->faq_id }}" />
                            <input type="hidden" name="user" value="{{ $user->username }}" />
                            <input type="text" name="faqQuestion" class="span12" value="{{ $faq->faq_question }}" placeholder="Click Here to type faq question&hellip;">
                            <div class="control-group">
                                <div class="controls">
                                    <textarea name="faqText" class="replybox span12" style="height: 250px" placeholder="Click here to type faq answer&hellip;">
                                        {{ $faq->faq_asnwer }}
                                    </textarea>
                                </div>
                                <div class="controls">
                                    <label>Status:</label>
                                    <select name="status">
                                        <option value="1" {{ ($faq->faq_status == 1) ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ ($faq->faq_status == 0) ? 'selected' : '' }}>Not Active</option>
                                    </select>
                                </div>
                                <div class="pull-right">
                                    <button class="btn btn-primary" type="submit" name="faqSubmit" value="Send" ><i class="icon-reply"></i> Submit</button>
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