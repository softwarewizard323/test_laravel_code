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
                        <h5>Available VIP Users</h5>
                        @if ($data->allVipUsers->count() != 0)
                        <div class="widget-buttons">
                            <a href="#vip" role="button" data-toggle="modal" class="btn btn-payment" style="margin:-5px 0 0 0; color: #FFF;"><i class="icon-plus"></i> Add VIP User</a>
                        </div>
                        @endif
                    </div>

                    <div class="widget-body">
                        @if ($data->allVipUsers->count() != 0)
                        <table id="balance" class="table table-striped table-bordered dataTable">
                            <thead>
                            <tr>
                                <th style="text-align:center;">VIP User ID</th>
                                <th style="text-align:center;">User</th>
                                <th style="text-align:center;">Discount amount</th>
                                <th style="text-align:center;">Creation Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data->allVipUsers as $vip )
                            <tr>
                                <td style="text-align:center;">{{ $vip->vip_user_id}}</td>
                                <td style="text-align:center;">{{ $vip->username}}</td>
                                <td style="text-align:center;">${{ $vip->discount}}</td>
                                <td style="text-align:center;">{{ date('d-m-Y', strtotime($vip->date)) }}</td>
                                <td style="text-align:right;"><a href="{{ url('admin/balance/vip/delete' , ['id' => $vip->vip_user_id] ) }}" role="button" data-toggle="modal" class="btn btn-mini btn-danger" onclick="return confirm('Are you sure want to delete user from VIP list?');"><i class="icon-trash"></i> Delete VIP User</a></td>
                            </tr>
                           @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="lead" style="text-align:center;padding:10% 0;">No VIP users added yet<br><a href="#vip" role="button" data-toggle="modal" class="btn btn-payment btn-large"><i class="icon-plus"></i> Add VIP User</a></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div id="vip" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action="{{ url('admin/balance/vip/create') }}" method="post">
            {{ csrf_field() }}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h3 id="myModalLabel">Add VIP User</h3>
            </div>
            <div class="modal-body" style="text-align:center">
                <p>User username: <div class="input-prepend input-append"><span class="add-on"><i class="icon-user"></i></span><input type="text" name="user" value="" /></div></p>
                <p>VIP discount: <div class="input-prepend input-append"><span class="add-on">$</span><input type="text" name="amount" value="" /><span class="add-on">.00</span></div></p>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
@endsection