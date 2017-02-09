@extends('admin.layouts.app')

@section('breadcrumb')
@stop

@section('content')
<div class="main_container" id="campaign_page">
<br>

    <div class="widget-body">
    <div class="row-fluid">
        <div class="widget widget-padding span12" style="padding-bottom:80px;">
            <div class="widget-header">
                <i class="icon-anchor"></i>
                <h5>
                    {{ $title }}
                    <span class="badge badge-success">{{ $orders->count() }}</span>
                </h5>
            </div>

            <div class="widget-body">
            @if($orders->count() > 0)
            <table id="campaigns" class="table table-striped table-bordered dataTable">
            <thead>
            <tr>
                <th style="text-align:center;">ID #</th>
                <th style="text-align:center;">Status</th>
                <th style="text-align:center;">User</th>
                <th style="text-align:center;">Source</th>
                <th>Website</th>
                <th style="text-align:center;">Country</th>
                <th style="text-align:center;">Daily Visitors</th>
                <th style="text-align:center;">Daily Payments</th>
                <th style="text-align:center;">Start Date</th>
                <th style="text-align:center;">Allowed End Date</th>
                <th style="text-align:center;">Messages</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($orders as $order)
                <tr>
                <td style="text-align:center;">#{{ $order['order_id'] }}</td>
                <td style="text-align:center;">
                    @if ($order['status'] == 0)
                        <span class="label label-info">Pending</span>
                    @elseif ($order['status'] == 1)
                        <span class="label label-success">Active</span>
                    @elseif ($order['status'] == 2)
                        <span class="label label-warning">Paused</span>
                    @else 
                        <span class="label label-important">Ended</span>
                    @endif
                </td>
                <td style="text-align:center;">{{ $order['username']}}</td>
                <td style="text-align:center;">
                    @if($order['dripfeed'] == 1)<i class="icon-time"></i>@endif
                    {{ $order['type'] }}
                </td>
                <td>{{ $order['website'] }}</td>
                <td style="text-align:center;">
                    <span class="flag-icon flag-icon-{{ $order['shortCountry'] }}"></span>
                    {{ $order['country'] }}
                </td>
                <td style="text-align:center;"><a href="#keywords{{$order['order_id']}}" data-toggle="modal"><i class="icon-hdd"></i> {{ number_format($order['total_quantity']) }}</a></td>
                <td style="text-align:center;">${{ $order['price'] }}</td>
                <td style="text-align:center;">{{ date('d-m-Y', strtotime($order['order_date'])) }}</td>
                <td style="text-align:center;">
                    {{ date('d-m-Y', strtotime($order['order_date'] . " +3 days")) }}
                </td>
                <td>
                <?php $adminMessage = $order->adminMessageCheck ?>
                @if (!$adminMessage) <a class="btn btn-mini" href="{{ url('/admin/message/new', ['id' => $order['order_id']]) }}"><i class="icon-edit"></i> Start New Message</a>
                @elseif ($adminMessage['messageStatus'] == '1' ) <a class="btn btn-primary btn-mini" href="{{ url('/admin/message', ['id' => $adminMessage['messageID']]) }}"><i class="icon-mail-reply-all"></i> Reply Message</a>
                @elseif ($adminMessage['messageStatus'] == '0' ) <a class="btn btn-danger btn-mini" href="{{ url('/admin/message', ['id' => $adminMessage['messageID']]) }}"><i class="icon-envelope"></i> 1 New Message</a>
                @endif
                @if (!$adminMessage)
                    <br>
                    <div class="dropdown">
                        <a class="dropdown-toggle btn btn-mini" data-toggle="dropdown" href="#" style="margin-top: 5px;"><i class="icon-envelope"></i> Start Quick Message</a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li><a href="{{ url('/admin/message/new', ['id' => $order['order_id'], 'template' => 1]) }}">URL not indexed</a></li>
                            <li><a href="{{ url('/admin/message/new', ['id' => $order['order_id'], 'template' => 2]) }}">Insufficient Funds</a></li>
                            <li><a href="{{ url('/admin/message/new', ['id' => $order['order_id'], 'template' => 3]) }}">Blogspot URLs Not Accepted</a></li>
                            <li><a href="{{ url('/admin/message/new', ['id' => $order['order_id'], 'template' => 4]) }}">$100 Insufficient Funds</a></li>
                            <li><a href="{{ url('/admin/message/new', ['id' => $order['order_id'], 'template' => 5]) }}">Site down</a></li>
                            <li><a href="{{ url('/admin/message/new', ['id' => $order['order_id'], 'template' => 6]) }}">Large Campaign Precheck</a></li>
                            <li><a href="{{ url('/admin/message/new', ['id' => $order['order_id'], 'template' => 7]) }}">VIP Message</a></li>
                            <li><a href="{{ url('/admin/message/new', ['id' => $order['order_id']]) }}">Other</a></li>
                        </ul>
                    </div>
                @endif
                </td>
                <td style="text-align:right;">
                <a href="{{ url('/admin/orders/update/edit', ['id' => $order['order_id']]) }}" class="btn btn-mini btn-info"><i class="icon-eject"></i> Edit</a><br />
                <form action="{{ url('/admin/orders/update/end', ['id' => $order['order_id']]) }}" method="post">
                    {{ csrf_field() }}
                    <input name="username" value="{{ $order['username'] }}" type="hidden" />
                    <button class="btn btn-mini btn-danger" type="submit" style="margin-top:3px;" onclick="return confirm('Are you sure want to end this order');"><i class="icon-stop"></i> Confirm End</button>
                </form>
                </td>
                </tr>
                <div id="keywords{{ $order['order_id'] }}" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3>{{ count($order['keywords']) }} Keyword @if(count($order['keywords']) > 1)s @endif</h3>
                    </div>
                    <div class="modal-body">
                        <div class='span12'>
                            <div class="row">
                                <div class='span6' style='padding:5px 10px;background:#F4F4F4;text-align:right'><i class='icon-tag'></i> Keyword</div>
                                <div class='span6' style='padding:5px 10px;background-color:#F4F4F4'><i class='icon-globe'></i> Visitors</div>
                            </div>
                            @foreach(array_combine( explode(';', $order['keywords']), explode(';', $order['quantity'])) as $keyword => $visitor)
                            <div class="row" style="padding-top:10px; border-top:solid 1px #DDD;height:auto;overflow:auto;">
                                <div class="span6" style="margin-left:0;text-align:right;padding-right:10px;">{{ $keyword }}</div><div class="span6" style="padding-left:10px;">{{ number_format((float)$visitor) }}</div>'
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Close</a>
                    </div>
                </div>
            @endforeach
            </tbody>
            </table>
        @else
            <div style="margin: 50px auto; font-size: 19px; color: #999; text-align: center;">No campaigns.</div>
        @endif
        </div>
            <!-- /widget-body --> 
        </div>
    </div>
    </div>
</div>
@stop