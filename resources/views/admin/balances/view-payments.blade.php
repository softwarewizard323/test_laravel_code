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
                        <h5>Users all account balance uploads</h5>
                    </div>

                    <div class="widget-body">
                        <table id="balance" class="table table-striped table-bordered dataTable">
                            <thead>
                            <tr>
                                <th style="text-align:center;">Payment ID</th>
                                <th style="text-align:center;">User</th>
                                <th style="text-align:center;">Amount</th>
                                <th style="text-align:center;">IP Address 1</th>
                                <th style="text-align:center;">IP Address 2</th>
                                <th style="text-align:center;">Date</th>
                                <th style="text-align:center;">Payment method</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data->allUsers as $rowUser)
                            <tr>
                                <td style="text-align:center;">{{ $rowUser->ab_id }}</td>
                                <td style="text-align:center;">{{ $rowUser->username}}</td>
                                <td style="text-align:center;">${{ $rowUser->amount}}</td>
                                <td style="text-align:center;">{{ $rowUser->ip_address}}</td>
                                <td style="text-align:center;">{{ $rowUser->ip_address_2}}</td>
                                <td style="text-align:center;">{{ date('d-m-Y', strtotime($rowUser->date)) }}</td>
                                <td style="text-align:center;">{{ $rowUser->payment_method}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <a href="{{ url('/admin/balance/payments') }}" class="btn pull-right btn-success" style="margin: 15px 20px 15px 0;">
                            <i class="icon-calendar"></i> Vew All Payments
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection