@extends('layouts.app')

@section('title', ' - FAQs')
@section('keywords', 'Send traffic to your site seo get google on first page')
@section('description', "Supplying Premium Traffic. Leading Web-Traffic Supplier in the web. Get your Google's Organic Traffic here. As seen in Blackhatworld.")

@section('style')
<style type="text/css">
    .panel-heading{height:40px!important;}
    .panel-title{margin-top:0px!important;}
</style>
@stop

@section('headers')

    {{ Html::script('js/bootstrap.min.js') }}
    {{ Html::style('css/bootstrap.min.css') }}
    <style type="text/css">
        .panel-heading{height:40px!important;}
        .panel-title{margin-top:0px!important;}
    </style>

@stop

@section('breadcrumb')
<div class="header header_thin">
    <div class="container_12">
        <div class="breadcrumbs"><a href="{{ url('/') }}">Homepage</a> <span class="separator">&nbsp;</span>FAQs</div>
    </div>
</div>
@stop

@section('content')

<!-- content -->
<div class="content">
    <div class="post-item post-detail">
        <div class="entry">

            <div class="title_big">
                <h2>Got a <span>Question?</span></h2>
                <p class="subtitle">If you have questions about our service, you will most probably find your answer below.</p>
            </div>

            <div class="row">

                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php $c = 1; ?>
                    @foreach($faqs as $faq)
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading{{ $faq->faq_id }}">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $faq->faq_id }}" aria-expanded="true" aria-controls="collapse{{ $faq->faq_id }}">
                                    {{ $c++ }}. {{ $faq->faq_question }}
                                </a>
                            </h4>
                        </div>
                        <div id="collapse{{ $faq->faq_id }}" class="panel-collapse collapse @if($id == $faq->faq_id) in @endif" role="tabpanel" aria-labelledby="heading{{ $faq->faq_id }}">
                            <div class="panel-body">
                                {!! $faq->faq_asnwer !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>

        </div>
    </div>
</div>
<!--/ content -->

@stop

@section('page_script')
@stop