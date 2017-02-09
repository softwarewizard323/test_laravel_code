@extends('dashboard.layouts.app')

@section('breadcrumb')
    <li class="active">Order History</li>
@stop

@section('content')
    <div class="main_container" id="campaign_page">
        <br>
        <div class="row-fluid">
            <div class="widget widget-padding span12">
                <div class="widget-header">
                    <i class="icon-anchor"></i>
                    <h5>My Previous Orders <span class="badge badge-success">{{$orders->count()}}</span></h5>
                </div>
                <div class="widget-body">
                    @if($orders->count() > 0)
                        <table class="table table-striped table-bordered dataTable">
                            <thead>
                            <tr>
                                <th style="text-align:center;">ID #</th>
                                <th style="text-align:center;">Status</th>
                                <th style="text-align:center;">Source</th>
                                <th style="text-align:center;">Type</th>
                                <th>Website</th>
                                <th style="text-align:center;">Country</th>
                                <th style="text-align:center;">Daily Visitors</th>
                                <th style="text-align:center;">Daily Payments</th>
                                <th style="text-align:center;">End Date</th>
                                <th style="text-align:center;">Messages</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td style="text-align: center;">#{{ $order->order_id }}</td>
                                    <td style="text-align: center;">
                                        @if ($order->status == 0)
                                            <span class="label label-info">Pending</span>
                                        @elseif($order->status == 1)
                                            <span class="label label-success">Active</span>
                                        @elseif($order->status == 2)
                                            <span class="label label-warning">Paused</span>
                                        @else
                                            <span class="label label-important">Ended</span>
                                        @endif
                                    </td>
                                    <td style="text-align:center;">@if($order->Source) {{ $order->Source->source_name }} @endif</td>
                                    <td style="text-align:center;">{{ $order->type }}</td>
                                    <td>{{ $order->website }}</td>
                                    <td style="text-align: center;">
                                        <span class="flag-icon flag-icon-{{ $order->shortCountry }}"></span>
                                        {{ $order->country }}
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="#keywords{{ $order->order_id }}" data-toggle="modal"><i class="icon-hdd"></i> {{ number_format($order->total_quantity) }}</a>
                                    </td>
                                    <td style="text-align: center;">${{ $order->price }}</td>
                                    <td style="text-align: center;">
                                        @if ($order->End)
                                        {{ date('F d, Y', strtotime($order->end->date)) }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (!$order->messageCheck)
                                            <button class="btn btn-mini disabled" type="button">
                                                <i class="icon-envelope"></i> No Messages
                                            </button>
                                        @else
                                            <a class="btn btn-primary btn-mini" href="{{ url('/dashboard/message', ['id' => $order->messageCheck->messageID ]) }}">
                                                <i class="icon-envelope"></i> New Message
                                            </a>
                                        @endif
                                    </td>
                                </tr>

                                <div id="keywords{{ $order->order_id }}" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h3>{{count($order->keywords)}} @if (count($order->keywords) > 1) Keywords @else Keyword @endif</h3>
                                    </div>
                                    <div class="modal-body">
                                        <div class='span12'>
                                            <div class="row">
                                                <div class='span6' style='padding:5px 10px;background:#F4F4F4;text-align:right'>
                                                    <i class='icon-tag'></i> Keyword
                                                </div>
                                                <div class='span6' style='padding:5px 10px;background-color:#F4F4F4'>
                                                    <i class='icon-globe'></i> Visitors
                                                </div>
                                            </div>
                                            @foreach(array_combine(explode(';', $order->keywords), explode(';', $order->quantity)) as $keyword => $visitor)
                                                <div class="row" style="padding-top:10px; border-top:solid 1px #DDD;height:auto;overflow:auto;">
                                                    <div class="span6" style="margin-left:0;text-align:right;padding-right:10px;">
                                                         {{ $keyword }}
                                                    </div>
                                                    <div class="span6" style="padding-left:10px;">
                                                         {{  number_format($visitor) }}
                                                    </div>
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
                        <div style="margin: 50px auto; font-size: 19px; color: #999; text-align: center;">
                            No expired campaigns.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
