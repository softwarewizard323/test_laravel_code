@extends('dashboard.layouts.app')

@section('breadcrumb')
    <li class="active">Community</li>
@stop

@section('content')

    @if($banned)
    <div class="alert alert-danger alert-sm">
        <span class="fw-semi-bold">Sorry!</span> You are banned from forum by <b>{{ $banned->banned_by }}</b>.
        <br>
        <b>Reason:</b> {{ $banned->reason }}<br>
        <b>Ban will expire:</b> @if($banned->banned_till == 0) Newer @else {{ date("d M Y H:i", $banned->banned_till) }} @endif
        <br><br>
        <i>Contact our support if you think it is mistake!</i>
    </div>
    @endif
    @if($disabled)
    <div class="alert alert-warning alert-sm">
        <span class="fw-semi-bold">Sorry!</span> Community is temporally disabled, please come back later.
    </div>
    @endif

@endsection
