@extends('dashboard.layouts.app')

@section('breadcrumb')
    <li><a href="{{url('/dashboard/useful-services')}}">Useful Services</a></li>
    <li class="active"> Website Builder</li>
@stop

@section('content')
<div class="col-md-9">
    <section class="widget">
        <div class="widget-body">
            <h3>Thank you. Your payment has been successful.</h3>
            <p>
                If you have any questions regarding your order, submit new ticket, specify paypal transaction ID inside your ticket so we can easier track down your order.
            </p>
            <p style="text-align:center">You can now:</p>
            <p style="text-align:center"><a href="{{ url('/dashboard/useful-services/website-builder') }}" class="btn btn-warning">Place new order</a> or <a href="{{ url('/dashboard/orders') }}" class="btn btn-success">View your orders</a></p>
        </div>
    </section>
</div>
@endsection
