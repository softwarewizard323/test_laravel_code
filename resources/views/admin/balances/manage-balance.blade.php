@extends('admin.layouts.app')

@section('content')
<!-- Main window -->
<div class="main_container" id="campaign_page">
    <br>
    <div class="widget-body">
        <div class="row-fluid">
            <div class="widget widget-padding span12">
                <div class="widget-header">
                    <i class="icon-anchor"></i>
                    <h5>Users account balances for Active Users</h5>
                    <div class="widget-buttons">
                        <strong>Last deduct: <span style="color:#C00;">{{$data->lastDeduct->date}}</span></strong>
                        <a href="{{ url('/admin/balance/manage/deduct') }}" class="btn btn-payment" style="margin:-5px 0 0 0; color: #FFF;">
                            <i class="icon-play-circle"></i> Deduct Funds
                        </a>
                    </div>
                </div>

                <div class="widget-body" style="height: 60px; overflow: auto;">
                    <span class="pull-left" style="height:60px;overflow:hidden;margin-right:30px;line-height:33px;display:block;">View Account Balances for:</span>
                    <ul class="nav nav-pills pull-left">
                        <li>
                            <a href="{{ url('/admin/balance/manage/all') }}"><i class="icon-user"></i> All Users</a>
                        </li>
                        <li class="disabled"><a href="{{ url('/admin/balance/manage') }}">
                                <i class="icon-user"></i> Active Users</a>
                        </li>
                    </ul>
                    <ul class="nav nav-pills pull-right">
                        <li class="disabled">This Month Earnings:
                            <strong style="color:#C00">${{ $data->earnings }}</strong>
                        </li>
                    </ul>
                </div>

                <div class="widget-body">
                    <table id="balance" class="table table-striped table-bordered dataTable">
                        <thead>
                        <tr>
                            <th style="text-align:center;">Username</th>
                            <th style="text-align:center;">Account Balance</th>
                            <th style="text-align:center;">Daily Spending</th>
                            <th style="text-align:center;">Active Campaigns</th>
                            <th style="text-align:center;">Max. Days to Run</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--while ($row_allusers = mysql_fetch_assoc($allusers)) ?>--}}
                        @foreach($data->users as $rowUser)
                        <?php
                            $countOrders = $rowUser->countOrders;
							$dailySpending = $rowUser->dailySpending;

							$maxDays = floor(($dailySpending !=0 ) ?  $rowUser->account_balance / $dailySpending : 0);

                        ?>
                        @if ($countOrders != 0 &&  ( $maxDays !=0) )
                        <?php
                            $low = ($dailySpending * 2 > $rowUser->account_balance ) ? 'color:#C00;font-weight:bold' : '';
                        ?>
                        <tr>
                            <td style="text-align:center;{{ $low }}">
                                {{ $rowUser->username }}
                            </td>
                            <td style="text-align:center;{{$low}}">
                                ${{ $rowUser->account_balance }}
                            </td>
                            <td style="text-align:center;">
                                ${{ number_format((float)$dailySpending, 2, '.', '') }}
                            </td>
                            <td style="text-align:center;">
                                 {{ $countOrders }}
                            </td>
                            <td style="text-align:center;{{$low}}">
                                {{  floor(($dailySpending !=0 ) ?  $rowUser->account_balance / $dailySpending : null) }} days
                            </td>
                            <td style="text-align:center;">
                                <a href="#myModal{{ $rowUser->username }}" role="button" data-toggle="modal"
                                   class="btn btn-mini btn-info">Edit Balance</a>
                            </td>
                        </tr>

                        <div id="myModal{{ $rowUser->username }}" class="modal hide fade" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <form action="{{ url('/admin/balance/manage/update') }}" method="post">
                                {{ csrf_field() }}
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                    <h3 id="myModalLabel">Update {{ $rowUser->username }} account balance</h3>
                                </div>
                                <div class="modal-body" style="text-align:center;">
                                    <p>Add new account balance for this user and click "Save changes" button.</p>
                                    <input name="username" value="{{ $rowUser->username }}" type="hidden" />
                                    <p><input name="balance" value="{{ $rowUser->account_balance }}" size="25" /></p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                    <button class="btn btn-primary" type="submit">Save changes</button>
                                </div>
                            </form>
                        </div>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <a href="{{ url('/admin/balance/vouchers') }}" class="btn btn-success pull-right" style="margin: 15px 20px 15px 0;">
                        <i class="icon-gift"></i> Manage Vouchers</a>
                    <a href="{{ url('/admin/balance/payments') }}" class="btn pull-right btn-success" style="margin: 15px 20px 15px 0;">
                        <i class="icon-calendar"></i> Vew All Payments</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.dropdown-toggle').dropdown()
</script>

@endsection