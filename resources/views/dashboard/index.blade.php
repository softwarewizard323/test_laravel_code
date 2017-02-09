@extends('dashboard.layouts.app')

@section('breadcrumb')
    <li class="active">Campaigns</li>
@stop

@section('content')

    <!-- Main window -->
    <div class="main_container" id="campaign_page">

        @if ($all_news->count() > 0)
        <div class="row-fluid" style="margin-top: 15px; font-size: 17px;">
            <div class="widget widget-padding span12">
                <div class="widget-header">
                    <i class="icon-rss-sign"></i>
                    <h5>Latest ExpressVisits News <span class="badge badge-success">{{ $all_news->count() }}</span></h5>
                </div>
                <div class="widget-body" style="border-bottom:none!important; margin-bottom:0!important;padding-bottom:0!important;">
                    <ul class="unstyled" style="margin-bottom:0!important;padding-bottom:0!important">
                        @foreach($pinned_news as $news)
                        <li>
                            <i class="fa fa-flag" style="margin:0 4px 0 2px;"></i>
                            @if (date('d-m-Y', strtotime($news['news_date'])) == date('d-m-Y')) [<strong>Today</strong>] @else [<strong>{{ date('d-m-Y', strtotime($news['news_date'])) }}</strong>] @endif
                            {{ $news['news_title'] }}
                            @if ($news['news_content'] != '')
                            <a href="#evNews{{ $news['news_id'] }}" data-toggle="modal">Read More &raquo;</a>
                            @endif
                        </li>
                        <!-- Modal -->
                        <div id="evNews{{ $news['news_id'] }}" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-header">
                                <button type="button" class="close icon-remove" data-dismiss="modal" aria-hidden="true"></button>
                                <p style="font-size:18px;"><b>{{ $news['news_title'] }}</b></p>
                            </div>
                            <div class="modal-body">
                                {!! str_replace("\\","",$news['news_content']) !!}
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                            </div>
                        </div>
                        @endforeach
                    </ul>
                </div>
                <div class="widget-body" style="padding-bottom: 5px; height:82px; overflow-y:scroll; padding-top:0!important">
                    <ul>
                        @foreach($all_news as $news)
                        <li>
                            @if (date('d-m-Y', strtotime($news['news_date'])) == date('d-m-Y')) [<strong>Today</strong>] @else [<strong>{{ date('d-m-Y', strtotime($news['news_date'])) }}</strong>] @endif
                            {{ $news['news_title'] }}
                            @if ($news['news_content'] != '')
                                <a href="#evNews{{ $news['news_id'] }}" data-toggle="modal">Read More &raquo;</a>
                            @endif
                        </li>
                        <!-- Modal -->
                        <div id="evNews{{ $news['news_id'] }}" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-header">
                                <button type="button" class="close icon-remove" data-dismiss="modal" aria-hidden="true"></button>
                                <p style="font-size:18px;"><b>{{ $news['news_title'] }}</b></p>
                            </div>
                            <div class="modal-body">
                                {!! str_replace("\\","",$news['news_content']) !!}
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                            </div>
                        </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @else
        <br>
        @endif

        @if ($lowBalanceCheck > $user->settings->account_balance)
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4>Heads up!</h4>
            Your account balance is too low allowing you to run your active campagins for next <strong>{{ floor($user->settings->account_balance / $dailySpending) }} day(s)</strong>.
            In order to have your campaigns running, make sure you upload more money on your account balance from <a href="{{ url('/dashboard/balance') }}">this page</a>.
        </div>
        @endif

        <div class="row-fluid">
            <div class="widget widget-padding span12">
                <div class="widget-header">
                    <i class="icon-anchor"></i>
                    <h5>View </h5>
                    <div class="dropdown" style="width: 250px;float:left;margin:15px 0 0 5px;">
                        <a class="dropdown-toggle" id="drop4" role="button" data-toggle="dropdown" href="#" style="padding-top: 8px;">
                            @if ($type == 'cosmetic') Cosmetic Traffic Campaigns @elseif ($type == 'arbitrage') Arbitrage Traffic Campaigns @elseif ($type == 'conversion') Conversion Traffic Campaigns @endif
                            <b class="caret" style="margin-top: 8px;"></b>
                        </a>
                        <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ url('/dashboard/campaign/cosmetic') }}"><i class="icon-map-marker"></i> Cosmetic Traffic Campaigns</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ url('/dashboard/campaign/arbitrage') }}"><i class="icon-eye-open"></i> Arbitrage Traffic Campaigns</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ url('/dashboard/campaign/conversion') }}"><i class="icon-leaf"></i> Conversion Traffic Campaigns</a></li>
                        </ul>
                    </div>
                    <span class="badge badge-success" style="margin-top: 17px;">{{ $orders->count() }}</span>
                </div>

                <div class="widget-body">

                    @if ($orders->count() > 0)
                        @if ($type == 'cosmetic')
                        <table id="campaigns" class="table table-striped table-bordered dataTable">
                            <thead>
                            <tr>
                                <th style="text-align:center;">ID #</th>
                                <th style="text-align:center;">Status</th>
                                <th style="text-align:center;">Type</th>
                                <th>Website</th>
                                <th style="text-align:center;">Google TLD</th>
                                <th style="text-align:center;">GA Tracking</th>
                                <th style="text-align:center;">Country</th>
                                <th style="text-align:center;">Daily Visitors</th>
                                <th style="text-align:center;">Daily Payments</th>
                                <th style="text-align:center;">Start Date</th>
                                <th style="text-align:center;">Messages</th>
                                <th style="text-align:center;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td style="text-align:center;">#{{ $order['order_id'] }}</td>
                                @if ($order->end()->count() > 0)
                                <td style="text-align:center;"><span class="label label-important">Pending End</span></td>
                                @else
                                <td style="text-align:center;">
                                    @if ($order['status'] == 0) <span class="label label-info">Pending</span>
                                    @elseif ($order['status'] == 1) <span class="label label-success">Active</span>
                                    @elseif ($order['status'] == 2) <span class="label label-warning">Paused</span>
                                    @else <span class="label label-important">Ended</span>
                                    @endif
                                </td>
                                @endif
                                <td style="text-align:center;">@if ($order['dripfeed'] == 1) <i class="icon-time"></i> @endif {{ $order['type'] }}</td>
                                <td>{{ $order['website'] }}</td>
                                <td style="text-align:center">@if ($order['type'] == 'Google') google.{{ $order['google_ext'] }} @endif</td>
                                <td style="text-align:center">@if ($order['ga_track'] == 'basic') Basic @else Free @endif<br><i>{{ $order['ga_tracking_code'] }}</i></td>
                                <td style="text-align:center;">
                                    <span class="flag-icon flag-icon-{{ $order->shortCountry }}"></span>
                                    {{ $order->country }}
                                </td>
                                <td style="text-align:center;"><a href="#keywords{{ $order['order_id'] }}" data-toggle="modal"><i class="icon-hdd"></i> {{ number_format($order['total_quantity']) }}</a></td>
                                <td style="text-align:center;">${{ $order['price'] }}</td>
                                <td style="text-align:center;">{{ date('d-m-Y', strtotime($order['date'])) }}</td>
                                <td style="text-align:center;">
                                    @if ($order->messageCheck)
                                        <a class="btn btn-danger btn-mini" href="{{ url('/dashboard/message', ['id' => $order->messageCheck->messageID]) }}"><i class="icon-envelope"></i> New Message</a>
                                    @else
                                        <button class="btn btn-mini disabled" type="button"><i class="icon-envelope"></i> No Messages</button>
                                    @endif
                                </td>
                                <td style="text-align:right;">
                                    @if ($order['status'] == 1)
                                    <form action="{{ url('/dashboard/order', ['id' => $order->order_id]) }}" method="post">
                                        {{ csrf_field() }}
                                        <button onclick="return confirm('Are you sure want to end this active campaign?');" class="btn btn-mini btn-bloody btn-tooltip" type="submit" id="example{{ $order['order_id'] }}" name="endCampaign" value="1" href="#" rel="tooltip" data-placement="left" data-original-title="Terminating active campaign can take up to 48 hours (usually within 24 hours)"><i class="icon-stop"></i> &nbsp;End</button>
                                    </form>
                                    @else
                                    <form action="{{ url('/dashboard/order', ['id' => $order->order_id]) }}" method="post">
                                        {{ csrf_field() }}
                                        <button onclick="return confirm('Are you sure want to end this pending campaign?');" class="btn btn-mini btn-bloody btn-tooltip" type="submit" id="example{{ $order['order_id'] }}" name="endPending" value="1" href="#" rel="tooltip" data-placement="left" data-original-title="Terminating pending campaign will remove it from our system and you wont be able to recover it"><i class="icon-stop"></i> &nbsp;End</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>

                            <?php
                            //array of keywords and their number of visitors
                            $keywords = explode(';', $order['keywords']);
                            $totalKeywords = count($keywords);
                            $visitors = explode(';', $order['quantity']);
                            ?>

                            <div id="keywords{{ $order['order_id'] }}" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h3>{{ $totalKeywords }} @if ($totalKeywords > 1) Keywords @else Keyword @endif</h3>
                                </div>
                                <div class="modal-body">
                                    <div class='span12'>
                                        <div class="row">
                                            <div class='span6' style='padding:5px 10px;background:#F4F4F4;text-align:right'><i class='icon-tag'></i> Keyword</div>
                                            <div class='span6' style='padding:5px 10px;background-color:#F4F4F4'><i class='icon-globe'></i> Visitors</div>
                                        </div>
                                        @foreach(array_combine($keywords, $visitors) as $keyword => $visitor)
                                        <div class="row" style="padding-top:10px; border-top:solid 1px #DDD;height:auto;overflow:auto;">
                                            <div class="span6" style="margin-left:0;text-align:right;padding-right:10px;">{{ $keyword }}</div>
                                            <div class="span6" style="padding-left:10px;">{{ number_format((double)$visitor, 2, ',', ' ') }}</div>
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
                        @elseif ($type == 'conversion') { ?>
                        <table id="campaigns" class="table table-striped table-bordered dataTable">
                            <thead>
                            <tr>
                                <th style="text-align:center;">ID #</th>
                                <th>Website</th>
                                <th style="text-align:center;">Package Size</th>
                                <th style="text-align:center;">Keywords</th>
                                <th style="text-align:center;">Status</th>
                                <th style="text-align:center;">Price</th>
                                <th style="text-align:center;">Start Date</th>
                                <th style="text-align:center;">Messages</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td style="text-align:center;">#{{ $order['co_id'] }}</td>
                                <td>{{  $order['corder_website'] }}</td>
                                <td style="text-align:center;">{{ $order['corder_package'] }}</td>
                                <td>{{ $order['corder_keywords'] }}</td>
                                <td style="text-align:center;">
                                    @if ($order['corder_status'] == '0') <span class="label label-info">Pending</span>
                                    @elseif ($order['corder_status'] == '1') <span class="label label-success">Active</span>
                                    @else <span class="label label-danger">Completed</span>
                                    @endif
                                </td>
                                <td style="text-align:center;">@if ($order['corder_price'] == '') Unknown @else ${{ $order['corder_price'] }} @endif</td>
                                <td style="text-align:center;">{{ date('d-m-Y', strtotime($order['corder_date'])) }}</td>
                                <td style="text-align:center;">
                                    @if ($order->messageCheck)
                                        <a class="btn btn-danger btn-mini" href="{{ url('/dashboard/message', ['id' => $order->messageCheck->messageID]) }}"><i class="icon-envelope"></i> New Message</a>
                                    @else
                                        <button class="btn btn-mini disabled" type="button"><i class="icon-envelope"></i> No Messages</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @endif
                    @else
                    <div style="margin: 100px auto; font-size: 19px; color: #999; text-align: center;">No Active or Pending campaigns. Please visit <a href="{{ url('/dashboard/booster/google') }}">this page</a> to place your new order.</div>
                    @endif

                </div>

                @if ($type == 'cosmetic')
                <div class="widget-footer row-fluid">
                    <div class="row-fluid">
                        <span class="label label-important" style="float: left;text-align:center;">IMPORTANT!</span>
                        <p class="span10">All campaigns have a minimum runtime, and even if you have pressed the ended button, the campaign will still continue running if the runtime hasn't been met. Each sources have different runtime. Please check under sources description to know it's runtime. E.g 2 days</p>
                    </div>
                </div>
                @elseif ($type == 'conversion')
                <div class="widget-footer row-fluid">
                    <div class="row-fluid">
                        <span class="label label-important" style="float: left;text-align:center;">IMPORTANT!</span>
                        <p class="span10">Once your campaign is under Pending status, you need to wait until our administration team sets the price and send you the message for that specific order. Once you agree with the price and reply back to our administration team you campaign will be activated and placed to Active status.</p>
                    </div>
                </div>
                @endif
                <!-- /widget-body -->

            </div>
        </div>
    </div>

@endsection

@section('page_script')
    <script>
        $('.btn-tooltip').tooltip();
    </script>
@stop