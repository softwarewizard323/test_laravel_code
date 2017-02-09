@extends('dashboard.layouts.app')

@section('content')

    {{ Html::style('http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css') }}

	<style type="text/css">
		a.dripfeed_link{ text-decoration: underline}
		a.dripfeed_link:hover{ text-decoration:none;}
	</style>

	<!-- Main window -->
	<div class="main_container">
		<br>
		<div class="row-fluid">
			<div class="widget widget-padding span10" id="wizard">
				<div class="wizard">
					<ul class="steps">
						<li data-target="#step1" class="complete"><span class="badge badge-success">1</span>Step 1<span class="chevron"></span></li>
						<li data-target="#step2" class="active"><span class="badge badge-info">2</span>Step 2<span class="chevron"></span></li>
						<li data-target="#step3"><span class="badge">3</span>Step 3<span class="chevron"></span></li>
						<li data-target="#step4"><span class="badge">4</span>Step 4<span class="chevron"></span></li>
					</ul>
				</div>

				<div class="widget-body" style="height: auto; overflow: auto;">

					<div style="text-align:center;color:#666;margin:10px 0 25px 35px;padding-bottom:5px;border-bottom:solid 1px #DDD;" class="span11">
						<p style="font-size:28px;">Setup Your Order</p>
						<p>On this page you are able to setup all necessary things about your incoming traffic such as keyword, daily visitors number and add a website that will be used in this campaign.</p>
					</div>

					<form method="post" action="{{ url('/dashboard/booster/direct/confirm') }}" id="calculationForm">
                        {{ csrf_field() }}
						<input type="hidden" id="postPriceHidden" value="{{ $price }}" >
						<input type="hidden" name="username" value="{{ $user->username }}">
						<input type="hidden" name="totalprice" id="txtTotalPrice" />
						<input type="hidden" name="source" value="{{ $source_name }}" />
						<input type="hidden" name="type" value="{{ $traffic_type }}" />

                        <div class="control-group span11">
                            <label class="control-label span2 oplabels" style="min-width:150px;">Traffic Source:</label>
                            <div class="controls">
                                <input readonly class="span4" type="text" id="txtSource" value="{{ $source->source_name }}" />
                            </div>
                        </div>

                        <div class="control-group span11">
                            <label class="control-label span2 oplabels" style="min-width:150px;">Traffic Type:</label>
                            <div class="controls">
                                <input readonly class="span4" type="text" id="txtSource" @if ($traffic_type == 'Google') value="Google Booster" @else value="Direct Traffic" @endif />
                            </div>
                        </div>

						<div class="control-group span11">
							<label class="control-label span2 oplabels" style="min-width:150px;">Country:</label>
							<div class="controls">
								<input readonly class="span4" type="text" id="txtCountry"  name="country" value="{{ $country }}" />
							</div>
						</div>

                        <div class="control-group span8" style="margin: 0 0 10px 16%;padding-left:10px;border-left: solid 1px #CCC;">
                            @if ($traffic_type == 'Google') Please submit only a URL that is being indexed in Google.com <br>@endif
                            Make sure you add URL in following format <i>http://www.example.com</i>
                        </div>

						<div class="control-group span11">
							<label class="control-label span2 oplabels" style="min-width:150px;">Website:</label>
							<div class="controls">
								<input required="required" class="span9" id="wizard_url" type="url" name="website" placeholder="http://www.example.com">
							</div>
						</div>

						<div class="control-group span11">
                            <label class="control-label span2 oplabels" style="min-width:150px;"><a href="{{ url('/faq?id=7') }}" target="_blank" class="dripfeed_link"><i class="icon-time"></i> 24h Dripfeed: <span class="badge badge-warning"><i class="icon-question-sign"></i></span></a></label>
							<div class="controls span9" style="margin-left: 14.5%;margin-top:-30px;margin-bottom:20px;padding:10px;border-left: solid 1px #CCC;background:@if ($countDripFeed > 0) #CEFFC6 @else #F8E3E3 @endif">
								@if ($countDripFeed > 0) <span class="label label-success">Available For This Country</span> @else <span class="label label-important">Not Available For This Country</span>@endif
								@if ($countDripFeed > 0) <input type="checkbox" name="dripfeed" value="Yes" /> Do you want to drip your traffic for 24h? @endif
							</div>
						</div>

						<div class="control-group span8" style="margin-left: 16%;padding-left:10px;border-left: solid 1px #CCC;">
							@if ($traffic_type == 'Google')
                            Now lets define the keywords which you want to use for your traffic source.<br />
                            Under "<i>Keyword</i>" field, fill in the keyword you want to use which will reflect inside your Google Analytics.<br />
                            Use slider to choose how many visitors you want for that specific keyword.<br />
                            To add new keyword and the # of visitors for that new keyword click on <span class="btn btn-mini btn-payment"><i class="icon-plus-sign"></i> Add New Keyword</span> button.<br />
                            If you added the keyword by mistake, click on <a class="btn btn-danger btn-mini"><i class="icon-trash"></i></a> button.
							@else
                            Use slider to choose how many visitors you want to receive every day.
							@endif
						</div>

						@if ($traffic_type == 'Google')
                        <div class="control-group span11" id="templateWrapper">
                            <div class="keywordTemplate ui-widget-content" style="padding:20px 10px 0 10px;border:solid 1px #E6D5B8;background:#FFEDCC;height:auto;overflow:auto;">
                                <div>
                                    <label class="control-label span2 oplabels" style="min-width:150px;">Daily Visitors:</label>
                                    <input type="text" name="keywordcount-1" class="keywordCount" readonly />
                                    <div class="singleSlider" style="display:inline-block;width:50%;margin-left:20px;">
                                    </div>
                                    <button type="button" class="deleteButton btn btn-danger btn-mini" style="position:relative;margin-right:10px;float:right;"><i class="icon-trash"></i></button>
                                </div>

                                <div class="control-group">
                                    <label class="control-label span2 oplabels" style="min-width:150px;">Keyword name:</label>
                                    <input type="text" name="keywordtext-1" class="span6 txtKeyword" placeholder="Type keyword" required="required" />
                                </div>
                            </div><!-- END keywordTemplate -->
                        </div><!-- END #templateWrapper -->
						@else
                        <div class="control-group span11" id="templateWrapper">
                            <div class="keywordTemplate ui-widget-content" style="padding:20px 10px 0 10px;border:solid 1px #E6D5B8;background:#FFEDCC;height:auto;overflow:auto;">
                                <div>
                                    <label class="control-label span2 oplabels" style="min-width:150px;">Daily Visitors:</label>
                                    <input type="text" name="keywordcount-1" class="keywordCount" readonly />
                                    <div class="singleSlider" style="display:inline-block;width:50%;margin-left:20px;">
                                    </div>
                                </div>

                            </div><!-- END keywordTemplate -->
                        </div><!-- END #templateWrapper -->
						@endif
						@if ($traffic_type == 'Google')
                        <div class="control-group span11" style="text-align:center;padding:10px 0 40px 0;border-top:solid 1px #CCC;">
                            <button type="button" id="btnAddNewKeyword" class="btn btn-payment"><i class="icon-plus-sign"></i> Add New Keyword</button><br /><small>$0.25 will be charged from your account balance for every additional keyword.</small>
                        </div>
						@endif

                        <div class="text-center span6 offset3" style="margin-top:20px;margin-bottom:60px;background:#f4f4f4;padding:15px;">
                            <p><Input type="checkbox" required> <strong>I agree</strong></p>
                            <p>1. Please read our full TOS, including refund policy here: <a href="{{ url('/tos') }}" target="_blank">{{ url('/tos') }}</a></p>
                        </div>

                        <div class="opaccbalance span11">
                            <strong>ACCOUNT BALANCE:</strong> ${{ number_format($user->settings->account_balance, 2, ',', ' ') }}
                        </div>
                        <div class="oppayments span11">
                            <ul class="unstyled">
                                <li style="margin-bottom:5px;"><strong>TOTAL DAILY VISITORS:</strong> <span id="txtTotalCount"></span></li>
                                <li style="margin-bottom:5px;"><strong>CPC PRICE:</strong> ${{ $price }}</li>
                                <li style="font-size: 22px; color: #E65B3E; margin-bottom:5px;"><strong>TOTAL DAILY PRICE: $<span id="totalPriceLabel"></span></strong></li>
                            </ul>
                        </div>
                        <div class="opbutton span11">
                            <div class="pull-left span5" style="line-height:50px;"><a href="{{ url('/dashboard/booster/direct') }}"><i class="icon-chevron-left"></i> Back to Traffic Sources</a></div>
                            <div class="pull-right span5" style="text-align:right;"><button class="btn btn-large btn-payment" type="submit" name="campaignSubmit" value="Buy Now" ><i class="icon-shopping-cart"></i> Continue to Checkout</button></div>
                        </div>

                        <script type="text/html" id="templateScript">
                            <div class="keywordTemplate ui-widget-content" style="padding:20px 10px 0 10px;margin-top:5px;border:solid 1px #E6D5B8;background:#FFEDCC;height:auto;overflow:auto;">
                                <div>
                                    <label class="control-label span2 oplabels" style="min-width:150px;">Daily Visitors:</label>
                                    <input type="text" name="keywordcount-" class="keywordCount" readonly="readonly" />
                                    <div class="singleSlider" style="display:inline-block;width:50%;margin-left:20px;">
                                    </div>
                                    <button type="button" class="deleteButton btn btn-danger btn-mini" style="position:relative;margin-right:10px;float:right;"><i class="icon-trash"></i></button>
                                </div>

                                <div class="control-group span10">
                                    <label class="control-label span2 oplabels" style="min-width:150px;">Keyword name:</label>
                                    <input type="text" name="keywordtext-" class="span6 txtKeyword" placeholder="Type keyword" required="required" />
                                </div>
                            </div><!-- END keywordTemplate -->
                        </script>

					</form>
				</div>
			</div>
		</div>
    </div>
    <!-- /Main window -->

@endsection

@section('page_script')
    {{ Html::script('include/js/jquery-ui.js') }}
    {{ Html::script('include/js/site.js') }}
@endsection