@extends('admin.layouts.app')

@section('breadcrumb')
@stop

@section('content')
<div class="main_container" id="campaign_page">
    <br>
        <div class="widget-body">
            <div class="row-fluid">
                <div class="widget widget-padding span12">
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
                                    <th style="text-align:center;">User</th>
                                    <th style="text-align:center;">Website</th>
                                    <th style="text-align:center;">Country</th>
                                    <th style="text-align:center;">Package</th>
                                    <th style="text-align:center;">Keywords</th>
                                    <th style="text-align:center;">Status</th>
                                    <th style="text-align:center;">Start Date</th>
                                    <th style="text-align:center;">Messages</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td style="text-align:center;">#{{ $order['co_id'] }}</td>
                                    <td style="text-align:center;">{{ $order['user'] }}</td>
                                    <td style="text-align:center;">{{ $order['corder_website'] }}</td>
                                    <td style="text-align:center;">{{ $order['country'] }}</td>
                                    <td style="text-align:center;">{{ $order['corder_package'] }}</td>
                                    <td style="text-align:center;">{{ $order['corder_keywords'] }}</td>
                                    <td style="text-align:center;">
                                        @if ($order['corder_status'] == 0)
                                        <span class="label label-info">Pending</span>
                                        @elseif ($order['corder_status'] == 1)
                                        <span class="label label-success">Active</span>
                                        @else <span class="label label-important">Ended</span>
                                        @endif
                                    </td>
                                    <td style="text-align:center;">{{ date('d-m-Y', strtotime($order['corder_date'])) }}</td>
                                        <td>
                                            <?php $adminMessage = $order->adminMessageCheck ?>
                                            @if (!$adminMessage) <a class="btn btn-mini" href="{{ url('/admin/message/cnew', ['id' => $order['co_id']]) }}"><i class="icon-edit"></i> Start New Message</a>
                                            @elseif ($adminMessage['messageStatus'] == '1' ) <a class="btn btn-primary btn-mini" href="{{ url('/admin/message', ['id' => $adminMessage['messageID']]) }}"><i class="icon-mail-reply-all"></i> Reply Message</a>
                                            @elseif ($adminMessage['messageStatus'] == '0' )<a class="btn btn-danger btn-mini" href="{{ url('/admin/message', ['id' => $adminMessage['messageID']]) }}"><i class="icon-envelope"></i> 1 New Message</a>
                                            @endif
                                        </td>
                                    <td style="text-align:right;">
                                        <a href="{{ url('/admin/conversion/update/delete', ['id' => $order['co_id']]) }}" class="btn btn-mini btn-danger" style="margin-top:3px;" onclick="return confirm('Are you sure want to delete this order?');"><i class="icon-remove-circle"></i> Delete</a>
                                        @if ($order['corder_status'] == '0')
                                            <form action="{{ url('/admin/conversion/update/start', ['id' => $order['co_id']]) }}" method="post">
                                                {{ csrf_field() }}
                                                <input name="username" value="{{ $order['user'] }}" type="hidden" />
                                                <button class="btn btn-mini btn-success" type="submit" style="margin-top:3px;" onclick="return confirm('Are you sure want to activate this order');"><i class="icon-play"></i> Activate</button>
                                            </form>
                                        @endif
                                        @if ($order['corder_status'] == '1')
                                            <form action="{{ url('/admin/conversion/update/end', ['id' => $order['co_id']]) }}" method="post">
                                                {{ csrf_field() }}
                                                <input name="username" value="{{ $order['user'] }}" type="hidden" />
                                                <button class="btn btn-mini btn-danger" type="submit" style="margin-top:3px;" onclick="return confirm('Are you sure want to end this order');"><i class="icon-play"></i> End</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
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