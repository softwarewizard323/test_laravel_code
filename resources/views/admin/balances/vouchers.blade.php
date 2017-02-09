@extends('admin.layouts.app')

@section('content')
    <!-- Main window -->
    <div class="main_container" id="campaign_page">
        <br>

        <div class="widget-body">
            <div class="row-fluid">
                <div class="widget widget-padding span12">
                    <div class="widget-header">
                        <i class="icon-gift"></i>
                        <h5>Available Vouchers</h5>
                        @if ($data->allVouchers->count() !=0 )
                        <div class="widget-buttons">
                            <a href="#voucher" role="button" data-toggle="modal" class="btn btn-payment" style="margin:-5px 0 0 0; color: #FFF;">
                                <i class="icon-gift"></i> Create Voucher
                            </a>
                        </div>
                        @endif
                    </div>

                    <div class="widget-body">
                        @if ($data->allVouchers->count() !=0 )
                        <table id="balance" class="table table-striped table-bordered dataTable">
                            <thead>
                            <tr>
                                <th style="text-align:center;">Voucher ID</th>
                                <th style="text-align:center;">Voucher Code</th>
                                <th style="text-align:center;">Voucher Amount</th>
                                <th style="text-align:center;">Voucher Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                           @foreach($data->allVouchers as $voucher)
                            <tr>
                                <td style="text-align:center;">
                                    {{ $voucher->coupon_id}}
                                </td>
                                <td style="text-align:center;">
                                    {{ $voucher->coupon_code }}
                                </td>
                                <td style="text-align:center;">
                                    ${{ $voucher->coupon_amount }}
                                </td>
                                <td style="text-align:center;">
                                    {{ date('d-m-Y', strtotime($voucher->coupon_date)) }}
                                </td>
                                <td style="text-align:right;">
                                    <a href="{{ url('admin/balance/vouchers/delete' , ['id' => $voucher->coupon_id] ) }}"
                                       role="button" data-toggle="modal" class="btn btn-mini btn-danger" onclick="return confirm('Are you sure want to delete this voucher?');">
                                        <i class="icon-trash"></i> Delete Voucher
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="lead" style="text-align:center;padding:10% 0;">No Vouchers Created<br><a href="#voucher" role="button" data-toggle="modal" class="btn btn-payment btn-large"><i class="icon-gift"></i> Create Voucher</a></div>
                            @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div id="voucher" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action="{{ url('admin/balance/vouchers/create') }}" method="post">
            {{ csrf_field() }}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel"><i class="icon-gift"></i> Create Voucher</h3>
            </div>
            <div class="modal-body">
                <p>Voucher Amount: <div class="input-prepend input-append"><span class="add-on">$</span>
                    <input type="text" name="voucherAmount" value="" /><span class="add-on">.00</span></div></p>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
@endsection