@extends('dashboard.layouts.app')

@section('title', ' - My Account')

@section('content')
    <!-- Main window -->
    <div class="main_container" id="msgView_page">
        <br>
        <div class="row-fluid" style="float: left;">
            <div class="widget widget-padding span9">
                <div class="widget-header">
                    <i class="icon-inbox"></i><h5>Account Balance Overview</h5>
                </div>
                <div class="widget-body" style="height: auto; overflow: auto;">
                    <div class="span4" style="text-align: center; padding: 20px;">
                        <h4>Balance Information</h4>
                        <p>Current Balance:
                            <a href="">${{ number_format($user->settings->account_balance, 2, ',', ' ') }}</a>
                        </p>
                        <p>If you have insufficient funds, here you can add money to your ExpressVisits account to be able to buy traffic.</p>
                    </div>
                    <div class="span4"
                         style="text-align: center; border-right: solid 1px #CCC; border-left: solid 1px #CCC; padding: 20px;">
                        <h4>Add Money</h4>
                        <form action="{{ url('/dashboard/balance') }}" method="post">
                            {{ csrf_field() }}
                            <input name="ip_1" type="hidden" value="@if(isset($_SERVER['HTTP_X_FORWARDED_FOR'] )) {{ $_SERVER['HTTP_X_FORWARDED_FOR'] }} @endif"/>
                            <input name="ip_2" type="hidden" value="@if(isset($_SERVER['REMOTE_ADDR'] )) {{ $_SERVER['REMOTE_ADDR'] }} @endif"/>
                            <p>Enter Amount (minimum $20):
                                <input class="span4" type="number" min="20" max="10000" style="text-align: center;" name="accBalance" required/>
                            </p>
                            <p>
                                <button class="btn btn-large btn-payment" name="balanceSubmit" value="Submit">Submit &raquo;</button>
                            </p>
                            <p>*</p>
                        </form>
                    </div>
                    <div class="span4" style="text-align: center; padding: 20px;">
                        <h4>Use Voucher</h4>
                        <form action="{{ url('/dashboard/voucher') }}" method="post">
                            {{ csrf_field() }}
                            <p>
                                Use valid voucher to increase account balance:
                                <input type="text" name="voucher" id="voucher" class="span4" style="text-align: center;" required/>
                            </p>
                            <div>
                                <button class="btn btn-large btn-payment" value="Submit">Submit &raquo;</button>
                                <div class="voucher_avail_result" id="voucher_avail_result"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row-fluid" style="margin-top: 25px; float: left;">
                <div class="widget widget-padding span9">
                    @if(session('voucherSuccess'))
                        <div class="alert alert-success fade in">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Congratulation!</strong> You have successfully used voucher and your account balance is now increased for voucher value.
                        </div>
                    @endif
                    @if(session('voucherFailed'))
                        <div class="alert alert-error fade in">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Sorry!</strong> That voucher code is not valid. Make sure you have valid voucher code, or
                            <a href="{{ url('/dashboard/support') }}">contact our support</a> if you have lost it.
                        </div>
                    @endif
                    <div class="widget-header">
                        <i class="icon-folder-open"></i><h5>Transaction History</h5>
                    </div>
                    <div class="widget-body" style="height: auto; overflow: auto;">
                        @if ( $balance->count() > 0 )
                            <table id="campaigns" class="table table-striped table-bordered dataTable">
                                <thead>
                                <tr>
                                    <th>Transaction #</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Payment System</th>
                                    <th>Transaction identification number</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($balance as $data)
                                    <tr>
                                        <td>#{{ $data->ab_id }}</td>
                                        <td>{{ date('F d, Y', strtotime($data->date)) }}</td>
                                        <td><i class="fa fa-usd"></i>{{ $data->amount }}</td>
                                        <td>{{ ucfirst($data->payment_method) }}</td>
                                        <td>{{ ucfirst($data->txn_id) }}</td>
                                        <td>
                                            @if ($data['status'] == 0) <span class="label label-warning">Incompleted</span> @else <span class="label label-success">Completed</span> @endif
                                            @if ($data['status'] == 0) <a href="" class="btn btn-mini btn-success"><i class="icon-shopping-cart"></i> Complete Payment</a> @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div style="text-align:center;font-size:25px;padding-top:40px;padding-bottom:40px;" class="span12">No Transactions.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('page_script')

    <style type="text/css">
        .success{
            color:#009900;
        }
        .error{
            color:#F33C21;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#voucher').keyup(function () { // Keyup function for check the user action in input
                console.log(this);
                var Voucher = $(this).val(); // Get the username textbox using $(this) or you can use directly $('#username')
                var VoucherAvailResult = $('#voucher_avail_result'); // Get the ID of the result where we gonna display the results
                if (Voucher.length > 4) { // check if greater than 2 (minimum 3)
                    $.ajax({ // Send the username val to another checker.php using Ajax in POST menthod
                        type: 'POST',
                        data: {voucher: Voucher, check: true, _token: "{{ csrf_token() }}"},
                        url: '{{ url('/dashboard/voucher') }}',
                        dataType: 'JSON',
                        beforeSend: function () {
                            VoucherAvailResult.html('Loading...'); // Preloader, use can use loading animation here
                        },
                        success: function (response) { // Get the result and asign to each cases
                            if (response.count == 0) {
                                VoucherAvailResult.html('<span class="error">Voucher Code Not Valid</span>');
                            }
                            else if (response.count > 0) {
                                VoucherAvailResult.html('<span class="success">Voucher Code Valid</span>');
                            }
                            else {
                                alert('Problem with sql query');
                            }
                        }
                    });
                } else {
                    VoucherAvailResult.html('<span class="error">Voucher Code cant have less then 8 characters</span>');
                }
                if (Voucher.length == 0) {
                    VoucherAvailResult.html('');
                }
            });

            $('#voucher').keydown(function (e) { // Dont allow users to enter spaces for their username and passwords
                if (e.which == 32) {
                    return false;
                }
            });
        });
    </script>

@stop