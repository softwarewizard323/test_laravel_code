@extends('dashboard.layouts.app')

@section('title', ' - Support')

@section('content')

    <!-- Main window -->
    <div class="main_container" id="msgRead_page">
        <br>
        <div class="row-fluid">
            <div class="widget widget-padding span10">
                <div class="widget-header">
                    <i class="icon-ticket"></i>
                    <h5>Please fill in the form below to open a new ticket.</h5>
                    <div class="widget-buttons">
                        <a class="btn btn-danger" href="{{ url('/dashboard/support') }}" style="margin:-5px 0 0 0; color:#FFF;"><i class="icon-remove-sign"></i> Cancel</a>
                    </div>
                </div>
                <div class="widget-body">

                    <div class="widget-footer">
                        <div class="row-fluid">
                            <form class="span12" action="{{ url('/dashboard/support/new', ['type' => $type]) }}" method="post" id="ticketSubmit">
                                {{ csrf_field() }}

                                <div class="control-group">
                                    <div class="controls">
                                        <span style="margin: 5px 10px 0 0;; display: block; float: left; width:100px;">Ticket Title:</span>
                                        <input type="text" name="ticketTitle" class="span11" value="" placeholder="Ticket Title"/>
                                    </div>
                                    <div class="controls">
                                        <span style="margin: 5px 10px 0 0;; display: block; float: left; width:100px;">Priority:</span>
                                        <select name="ticketPriority" id="select3-basic" tabindex="1" data-placeholder="Days.." class="span2">
                                            <option value="1">High</option>
                                            <option value="2" selected="selected">Medium</option>
                                            <option value="3">Low</option>
                                        </select>
                                    </div>
                                    @if ($type == 'cosmetic')
                                    <div class="controls">
                                        <span style="margin: 5px 10px 0 0;; display: block; float: left; width:100px;">Order ID:</span>
                                        <select name="OrderID" id="select3-basic" tabindex="1" class="span3" style="float: left;">
                                            <option value="0">None</option>
                                            @foreach($orders as $order)
                                            <option value="{{ $order['order_id'] }}">#{{ $order['order_id'] }} - {{ $order->packageMasterName }} {{ $order->packageName }} Booster</option>
                                            @endforeach
                                        </select>
                                        <span style="margin: 5px 10px 0 15px;; display: block; float: left;">If your ticket is about any specific order you have created please choose your order id in here.</span>
                                    </div>
                                    @elseif ($type == 'conversion')
                                    <div class="controls">
                                        <span style="margin: 5px 10px 0 0;; display: block; float: left; width:100px;">Order ID:</span>
                                        <select name="COrderID" id="select3-basic" tabindex="1" class="span3" style="float: left;">
                                            <option value="0">None</option>
                                            @foreach($conversions as $conversion)
                                            <option value="{{ $conversion['co_id'] }}">#{{ $conversion['co_id'] }} - Conversion Package</option>
                                            @endforeach
                                        </select>
                                        <span style="margin: 5px 10px 0 15px;; display: block; float: left;">If your ticket is about any specific order you have created please choose your order id in here.</span>
                                    </div>
                                    @else

                                    @endif

                                    <hr style="margin-top: 50px;clear:both">

                                    <div class="controls">
                                        <textarea name="ticketText" class="replybox span12" style="height: 250px" placeholder="Click Here to describe your problem&hellip;"></textarea>
                                    </div>

                                    <div class="pull-right">
                                        <button class="btn btn-primary" type="submit" name="ticketSubmit" value="Send" > <i class="icon-reply"></i> Send Ticket</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
