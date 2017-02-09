@extends('dashboard.layouts.app')

@section('content')
    {{ Html::script('http://code.jquery.com/jquery-latest.js') }}
    <!-- Main window -->
    <div class="main_container" id="booster_page">
        <br>
        <div class="row-fluid">
            <div class="widget widget-padding span9" id="wizard">
                <div class="wizard">
                    <ul class="steps">
                        <li data-target="#step1" class="complete"><span class="badge badge-success">1</span>Step 1<span
                                    class="chevron"></span></li>
                        <li data-target="#step2" class="complete"><span class="badge badge-success">2</span>Step 2<span
                                    class="chevron"></span></li>
                        <li data-target="#step3" class="active"><span class="badge badge-info">3</span>Step 3<span
                                    class="chevron"></span></li>
                        <li data-target="#step4"><span class="badge">4</span>Step 4<span class="chevron"></span></li>
                    </ul>
                </div>

                <div class="widget-body" style="height:auto;overflow:auto;text-align:center;">

                    <div style="text-align:center;color:#666;margin:10px 0 25px 35px;padding-bottom:5px;border-bottom:solid 1px #DDD;"
                         class="span11 row">
                        <p style="font-size:28px;">Order Confirmation</p>
                        <p>Please review below details of your order and if everything is OK click on
                            <span class="btn btn-small btn-payment"><i class="icon-ok-sign"></i> Complete Order</span>
                            button in order to submit it to our moderation team. Your order will be in pending status up
                            to 48 hours. Once your order is activated by our moderation team, every day your account
                            balance will be deducted by ${{ $data->totalPrice }} so make sure that you balance is always at
                            positive level. If you wish to stop any campaigns, simply click the "End" button manually.
                        </p>
                    </div>

                    <div class="row span11">
                        <div>
                            <span class="span6" style="text-align:right;"><b>Traffic Source : &nbsp;</b></span>
                            <span class="span6" style="text-align:left;">{{ $data->sourceTab->source_name }}</span>
                        </div>
                        <div>
                            <span class="span6" style="text-align:right;"><b>Traffic Type : &nbsp;</b></span>
                            <span class="span6" style="text-align:left;">
                                @if ($data->type == 'Google')Google Booster @elseif ($data->type == 'Other Booster')
                                    Other Booster @else Direct Booster @endif
                        </span>
                        </div>
                        <div>
                            <span class="span6" style="text-align:right;"><b>Country : &nbsp;</b></span>
                            <span class="span6" style="text-align:left;">{{ $data->country }}</span>
                        </div>


                        @if ($data->type == 'Google')
                            <div>
                                {{ $keywords = explode(';', $data->combinedKeywords) }}
                                {{ $visitors = explode(';', $data->combinedCounts) }}
                                <span class="span6" style="text-align:right;"><b>Keywords : &nbsp;</b></span>
                                <span class="span6" style="text-align:left;">
                            @foreach ($keywords as $keyword)
                                        <span class="label label-info">{{  $keyword }}</span>
                                    @endforeach
                        </span>
                            </div>
                            <div>
                        <span class="span6" style="text-align:right;">
                            <b>Visitors for above keywords : &nbsp;</b>
                        </span>
                                <span class="span6" style="text-align:left;">
                                    <?php $count_values = array('0'); $kwcounter = 0;?>
                            @foreach ($visitors as $visitor)<?php  $count_values[$kwcounter]++ ?>
                                    <span class="label label-info"> {{  $english_format_number = number_format($visitor) }} </span>
                                    @endforeach
                        </span>
                            </div>
                        @endif
                        <div>
                        <span class="span6" style="text-align:right;">
                            <b>24 dripfeed selected : &nbsp;</b>
                        </span>
                            <span class="span6" style="text-align:left;">
                            @if ($data->dripfeed == 1)
                                    <span class="label label-success">Yes</span>
                                @else
                                    <span class="label label-important">No</span>
                                @endif
                        </span>
                        </div>
                        <div>
                            <span class="span6" style="text-align:right;"><b>Total visitors : &nbsp;</b></span>
                            <span class="span6" style="text-align:left;">
                            {{ $english_format_number = number_format($data->sum) }}
                        </span>
                        </div>
                        <div>
                            <span class="span6" style="text-align:right;"><b>Website : &nbsp;</b></span>
                            <span class="span6" style="text-align:left;">{{ $data->websiteurl }} </span>
                        </div>
                        @if ($data->type == 'Google')
                            <?php $count_kyw = $count_values[$kwcounter]; $additional_kyw = $count_kyw - 1; $additional_kyw_price = $additional_kyw * 0.10; ?>
                            @if ($additional_kyw != 0)
                                <div>
                                    <span class="span6" style="text-align:right;">
                                    <b> One time payment for {{ $additional_kyw }} additional keyword @if ($additional_kyw > 0)s @endif :&nbsp;</b>
                                    </span>
                                    <span class="span6" style="text-align:left;">$ {{  $additional_kyw_price }}</span>
                                </div>
                            @endif
                        @else
                        @endif

                        <div>
                        <span class="span6"
                              style="text-align:right;"><b>One time campaign activation payment : &nbsp;</b></span>
                            <span class="span6" style="text-align:left;">$0.20</span>
                        </div>
                        <div>
                            <span class="span6" style="text-align:right;"><b>Daily payments : &nbsp;</b></span>
                            <span class="span6" style="text-align:left;">${{  $data->totalPrice }}</span>
                        </div>
                    </div>
                    <div class="row span11" style="margin-top:50px;padding-top:20px;border-top:solid 1px #DDD;">

                        <form action="{{ url('/dashboard/traffic/clicks/complete') }}" method="post">
                            {{ csrf_field() }}
                            @if (isset($additional_kyw) and $additional_kyw != 0)
                                <input type="hidden" value="{{  $additional_kyw_price }}" name="additionalKeywords"/>
                            @endif

                            @if ($data->dripfeed)
                                <input type="hidden" value="1" name="dripfeed"/>
                            @else
                                <input type="hidden" value="0" name="dripfeed"/>
                            @endif
                            <input type="hidden" value="{{ $data->source }}" name="source"/>
                            <input type="hidden" value="{{ $data->country }}" name="country"/>
                            <input type="hidden" value="{{ $data->dripfeed }}" name="dripfeed"/>
                            <input type="hidden" value="{{ $data->combinedKeywords }}" name="combinedKeywords"/>
                            <input type="hidden" value="{{ $data->combinedCounts }}" name="combinedCounts"/>
                            <input type="hidden" value="{{ $data->sum }}" name="sum"/>
                            <input type="hidden" value="{{ $data->totalPrice }}" name="totalPrice"/>
                            <input type="hidden" value="{{ $data->websiteurl }}" name="websiteurl"/>
                            <input type="hidden" value="{{ $data->type }}" name="type"/>
                            <button type="submit" class="btn btn-payment btn-large"><i class="icon-ok-sign"></i>
                                Complete Order
                            </button>
                        </form>
                    </div>
                    <div class="row span11" style="margin-top:10px;">
                        or
                    </div>
                    <div class="row span11">
                        <a href="{{ url('/dashboard/traffic/clicks') }}"><i class="icon-remove-circle"></i> Cancel Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main window -->
@endsection