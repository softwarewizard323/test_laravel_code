@extends('admin.layouts.app')

@section('breadcrumb')
    <li class="active">Campaigns</li>
@stop

@section('content')
<div class="main_container" id="msgView_page">
<br>
    <div class="row-fluid">
        <div class="widget widget-padding span12">
            <div class="widget-header">
                <i class="icon-inbox"></i>
                <h5>All Sources</h5>
                <div class="widget-buttons">
                    <a href="{{ url('/admin/source/add') }}" class="btn btn-info" style="margin:-5px 0 0 0; color: #FFF;"><i class="icon-pencil"></i> Add New Source</a>
                    <a href="#dripfeedadd" role="button" data-toggle="modal" class="btn btn-success" style="margin:-5px 0 0 0; color: #FFF;"><i class="icon-pencil"></i> Add New 24h Dripfeed</a>
                </div>
            </div>
            <div class="widget-body">
                @if ($sources->count() > 0)
                    <table class="table table-hover" data-provides="rowlink">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th style="text-align: center!important;">Dripfeed Status</th>
                                <th style="text-align: center!important;">Subscribe Status</th>
                                <th style="text-align: center!important;">Date Added</th>
                                <th style="text-align: center!important;">Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sources as $source)
                                <tr>
                                    <td>#{{ $source['source_id'] }}</td>
                                    <td>{{ $source['source_name'] }}</td>
                                    <td style="text-align: center!important;">
                                        @if ($source['source_dripfeed'] == 0)
                                            <span class="label label-warning">Disabled</span>
                                        @else
                                            <span class="label label-success">Enabled</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center!important;">
                                        @if ($source['source_subscribe'] == 0)
                                            <span class="label label-warning">Disabled</span>
                                        @else
                                            <span class="label label-success">Enabled</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center!important;">
                                        {{ date('d-m-Y', strtotime($source['source_date'])) }}
                                    </td>
                                    <td style="text-align: center!important;">
                                        @if ($source['source_status'] == 0)
                                            <span class="label label-success">Active</span>
                                        @elseif ($source['source_status'] == 1)
                                            <span class="label label-info">Competitive</span>
                                        @else
                                            <span class="label label-important">Limited</span>
                                        @endif
                                    </td>
                                    <td style="text-align: right!important;">
                                        <a href="{{ url('/admin/source', $source['source_id']) }}" class="btn btn-default"><i class="icon-edit"></i></a>
                                        <a href="{{ url('/admin/source/delete', $source['source_id']) }}" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this source?');"><i class="icon-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div style="margin: 50px auto 20px auto; font-size: 19px; color: #999; text-align: center;">No sources is created.</div>
                    <div style="margin: 5px auto 50px auto; text-align: center;">
                        <a href="{{ url('/admin/source/add') }}" class="btn btn-info">
                            <i class="icon-pencil"></i> Add New Source
                        </a>
                    </div>
                @endif
            </div>
            <div class="widget-body" style="height: auto; overflow:auto;background:#F8E3E3">
                <div class="span3">24h dripfeed is enabled for following countries:</div>
                <div class="span8">
                    @foreach ($dripFeedCountries as $dripfeeds)
                        <span class="label label-important">{{ $dripfeeds['country'] }}</span>
                    @endforeach
                </div>
                <div class="span1" style="text-align:right">
                    <a href="#dripfeedadd" role="button" data-toggle="modal" class="btn btn-mini btn-success" style="margin:-5px 0 0 0; color: #FFF;"><i class="icon-pencil"></i> Add New</a><br>
                    <a href="#dripfeeddelete" role="button" data-toggle="modal" class="btn btn-mini btn-danger" style="margin:5px 0 0 0; color: #FFF;"><i class="icon-trash"></i> Delete</a>
                </div>
            </div>
            <div class="widget-footer">
                <div class="pull-left">
                    <p class="muted" style="margin: 5px">
                        Showing {{ $sources->count() }} of {{ $sources->count() }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row-fluid">
            <div class="widget widget-padding span12">
                <div class="widget-header">
                <i class="icon-inbox"></i>
                <h5>Sources Reviews written by users</h5>
                </div>
            <div class="widget-body">
                @if($reviews->count() > 0)
                <table class="table table-hover" data-provides="rowlink">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th style="text-align: center!important;">Source Name</th>
                            <th style="text-align: center!important;">Rating</th>
                            <th style="text-align: center!important;">Content</th>
                            <th style="text-align: center!important;">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $reviews as $review )
                            <tr>    
                                <td>#{{ $review['tsr_id'] }}</td>
                                <td>{{ $review['username'] }}</td>
                                <td style="text-align: center!important;">@if($review->source) {{ $review->source->source_name }} @endif</td>
                                <td style="text-align: center!important;">
                                    @if ( $review['review_rating'] == 1 ) {{ Html::image('include/img/1-star.gif', null, ['title' => 'Bad']) }} @endif
                                    @if ( $review['review_rating'] == 2 ) {{ Html::image('include/img/2-star.gif', null, ['title' => 'Good']) }} @endif
                                    @if ( $review['review_rating'] == 3 ) {{ Html::image('include/img/3-star.gif', null, ['title' => 'Very good']) }} @endif
                                    @if ( $review['review_rating'] == 4 ) {{ Html::image('include/img/4-star.gif', null, ['title' => 'Superior']) }} @endif
                                    @if ( $review['review_rating'] == 5 ) {{ Html::image('include/img/5-star.gif', null, ['title' => 'Exceptional']) }} @endif
                                </td>
                                <td>
                                    {{ \Illuminate\Support\Str::words($review->review_text, 20, '...') }}
                                    @if($review['review_text'] != '')
                                        <a href="#review{{ $review['tsr_id']}}" role="button" class="btn btn-mini" data-toggle="modal"><i class="icon-fullscreen"></i> Read More</a>
                                    @endif
                                </td>
                                <td style="text-align: center!important;">{{ (date('d-m-Y', strtotime($review['review_date']))) }}</td>
                            </tr>                                                           
                            <!-- Modal -->
                            <div id="review{{ $review['tsr_id'] }}" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                    <h3 id="myModalLabel">Full Review</h3>
                                </div>
                                <div class="modal-body">
                                    <p>{{ $review['review_text'] }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
                            </div>
                        @endforeach
                </tbody>
                </table>
                @endif
            </div>
            <div class="widget-footer">
                <div class="pull-left">
                    <p class="muted" style="margin: 5px">Showing {{ $reviews->count() }} of {{ $reviews->count() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dripfeedadd" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        <h3 id="myModalLabel">Add New Country for 24h dripfeed</h3>
    </div>
    <form action="{{ url('/admin/sources/dripfeed') }}" method="post">
        <div class="modal-body">
            <p>
                Add Country Name: <input type="text" value="" name="addDripDeedCountry" >
            </p>
        </div>
        <div class="modal-footer">
            {{ csrf_field() }}
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="btn btn-primary" type="submit">Add</button>
        </div>
    </form>
</div>

<div id="dripfeeddelete" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        <h3 id="myModalLabel">Delete Country that needs to be deleted</h3>
    </div>
    <form action="{{ url('/admin/sources/dripfeed') }}" method="post">
        <div class="modal-body">
            <p>
                Delete Country Name: <input type="text" value="" name="deleteDripDeedCountry" >
            </p>
        </div>
        <div class="modal-footer">
            {{ csrf_field() }}
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="btn btn-danger" type="submit">Delete</button>
        </div>
    </form>
</div>
@stop