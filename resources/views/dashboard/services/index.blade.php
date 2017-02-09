@extends('dashboard.layouts.app')

@section('breadcrumb')
    <li class="active"> Useful Services</li>
@stop

@section('content')

    @if($message = Session::get('message'))
    <div class="alert alert-success alert-sm"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{!! $message !!}}</div>
    @endif

    <div class="col-md-3">
        <section class="widget">
            <header class="ui-sortable-handle">
                <h4>
                    <i class="fa fa-cog fa-lg"></i> Website <span class="fw-semi-bold">Builder</span>
                </h4>
                <div class="widget-controls">
                    <a data-widgster="expand" title="" href="#" style="display: none;" data-original-title="Expand"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    <a data-widgster="collapse" title="" href="#" data-original-title="Collapse" style="display: inline;"><i class="glyphicon glyphicon-chevron-down"></i></a>
                </div>
            </header>
            <div class="widget-body">
                <p style="text-align: center;">
                    Get fresh and custom-built website that you can use
                    alongside ExpressVisits traffic. All website come with content, custom design, WordPress CMS, 
                    SEO optimized and all necessary plugins so you can easily
                    start its maintenance and upgrades.
                </p>
                <p style="text-align: center;">
                    <a href="{{ url('/dashboard/useful-services/website-builder') }}" class="btn btn-primary">Open</a>
                </p>
            </div>
        </section>
    </div>
    <div class="col-md-3">
        <section class="widget">
            <header class="ui-sortable-handle">
                <h4>
                    <i class="fa fa-money"></i> Website <span class="fw-semi-bold">Marketplace</span>
                </h4>
                <div class="widget-controls">
                    <a data-widgster="expand" title="" href="#" style="display: none;" data-original-title="Expand"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    <a data-widgster="collapse" title="" href="#" data-original-title="Collapse" style="display: inline;"><i class="glyphicon glyphicon-chevron-down"></i></a>
                </div>
            </header>
            <div class="widget-body">
                <p style="text-align: center;">
                    Looking for ways to start using our traffic but don't want to wait till
                    your website is built? Or you just want to expand number of website you are using
                    alongside our traffic? Here you can find pre-built website's that already have
                    organic traffic, nice design, content, page rank, and can be used with our traffic immediately.
                </p>
                <p style="text-align: center;">
                    <a href="#" class="btn btn-primary disabled">Coming Soon</a>
                </p>
            </div>
        </section>
    </div>
    <div class="col-md-3">
        <section class="widget">
            <header class="ui-sortable-handle">
                <h4>
                    <i class="fa fa-database"></i> Website <span class="fw-semi-bold">Hosting</span>
                </h4>
                <div class="widget-controls">
                    <a data-widgster="expand" title="" href="#" style="display: none;" data-original-title="Expand"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    <a data-widgster="collapse" title="" href="#" data-original-title="Collapse" style="display: inline;"><i class="glyphicon glyphicon-chevron-down"></i></a>
                </div>
            </header>
            <div class="widget-body">
                <p style="text-align: center;">
                    Have problems with your hosting and ExpressVisits traffic? Get rid
                    of those problems with our super fast and reliable traffic providers
                    that won't give you any headache.
                </p>
                <p style="text-align: center;">
                    <a href="#" class="btn btn-primary disabled">Coming Soon</a>
                </p>
            </div>
        </section>
    </div>
    <div class="col-md-3">
        <section class="widget">
            <header class="ui-sortable-handle">
                <h4>
                    <span class="glyphicon glyphicon-question-sign"></span> Dedicated <span class="fw-semi-bold">Tutor</span>
                </h4>
                <div class="widget-controls">
                    <a data-widgster="expand" title="" href="#" style="display: none;" data-original-title="Expand"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    <a data-widgster="collapse" title="" href="#" data-original-title="Collapse" style="display: inline;"><i class="glyphicon glyphicon-chevron-down"></i></a>
                </div>
            </header>
            <div class="widget-body">
                <p style="text-align: center;">
                    Yes, it's finally here. After so many requests from ExpressVisits clients we are finally 
                    bringing dedicated tutors that you can book for your self for few hours ir days that
                    will teach you how to effectively use our traffic and how to improve your website to get
                    better Google search rank and even get organic traffic. Keep in mind that our tutors are available
                    only trough Skype chat.
                </p>
                <p style="text-align: center;">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tutorModal">Request</a>
                </p>
            </div>
        </section>
    </div>
    <div id="tutorModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
            <form method="post" action="{{ url('/dashboard/useful-services/tour') }}" class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Request Dedicated Tutor</h4>
                    </div>
                <div class="modal-body">
                    <div>
                        <div class="form-group">
                            <label for="normal-field" class="col-sm-5 control-label">Name:</label>
                            <div class="col-sm-6">
                                <input type="text" name="name" class="form-control" value="" placeholder="" required>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="normal-field" class="col-sm-5 control-label">Email:</label>
                            <div class="col-sm-6">
                                <input type="text" name="email" class="form-control" value="" placeholder="" required>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="normal-field" class="col-sm-5 control-label">Skype ID:</label>
                            <div class="col-sm-6">
                                <input type="text" name="skype_id" class="form-control" value="" placeholder="" required>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="normal-field" class="col-sm-5 control-label">Reason your are asking for tutor:</label>
                            <div class="col-sm-6">
                                <input type="text" name="reason" class="form-control" value="" placeholder="" required>
                            </div>
                        </div>              
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="requestTutor" class="btn btn-primary">Request</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection