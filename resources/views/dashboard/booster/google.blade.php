@extends('dashboard.layouts.app')

@section('content')

	<!-- Main window -->
	<div class="main_container">
		<br />
		<div class="row-fluid">
            @if ($dailySpending * 3 > $user->settings->account_balance)
			<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Heads up!</h4> Your account balance is too low allowing you to run your active campagins for next <strong>{{ floor($user->settings->account_balance / $dailySpending) }} day(s)</strong>.
				In order to have your campaigns running, make sure you upload more money on your account balance from <a href="{{ url('/dashboard/balance') }}">this page</a>.
			</div>
			@endif
			@if ($user->settings->account_balance < 15)
            <div class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4>Warning!</h4> You can't place any new orders until you increase your account balance.
            </div>
			@endif
			<div class="widget widget-padding span12" id="wizard" style="margin-left:0">
				<div class="wizard">
					<ul class="steps">
						<li data-target="#step1" class="active"><span class="badge badge-info">1</span>Step 1<span class="chevron"></span></li>
						<li data-target="#step2"><span class="badge">2</span>Step 2<span class="chevron"></span></li>
						<li data-target="#step3"><span class="badge">3</span>Step 3<span class="chevron"></span></li>
						<li data-target="#step4"><span class="badge">4</span>Step 4<span class="chevron"></span></li>
					</ul>
				</div>

				<div class="widget-body" style="height:auto; overflow: auto;">

					<div style="text-align:center;color:#666;margin:10px 0 10px 0;padding-bottom:5px;border-bottom:solid 1px #DDD;" class="span12">
						<p style="font-size:28px;">Select Source &amp; Country</p>
						<p>In below table you have a choice to choose one of countries under one source. Once you choose the country you are able to see a price of traffic for that country and source. Once you are done, click on <span class="btn btn-mini btn-payment"><i class="icon-chevron-right"></i> Continue</span> button.</p>
					</div>

					<table class="table table-striped table-bordered dataTable">
						<thead>
						<tr>
							<th width="35%">Item</th>
							<th width="16%" style="text-align:center;">Country</th>
							<th width="15%" style="text-align:center;"><span style="font-weight:normal;"><i>Updated Daily</i></span> <a id="example" class="badge badge-inverse" href="#" rel="tooltip" data-placement="top" data-original-title="Prices are directly affected by availability. Availability are affected significantly by clients demand and network supply.">?</a><br />Pricing (Per visit)</th>
							<th width="9%" style="text-align:center;">Traffic Status</th>
							<th width="9%"></th>
						</tr>
						</thead>
						<tbody>

                        @foreach($sources as $source)
						<form action="{{ url('/dashboard/booster/google/setup') }}" method="post">
                            {{ csrf_field() }}
							<input name="traffic-type" type="hidden" value="Google" />
							<tr>
                                <input value="{{ $source->source_id }}" type="hidden" name="source"/>
                                <td>
                                    <span style="font-weight:bold">{{ $source->source_name }}</span><br/>
                                    {!! \Illuminate\Support\Str::words($source->source_desc, 18, '...') !!}
                                    <a href="#sourceDescription{{ $source->source_id }}" role="button" data-toggle="modal">Read more</a>
                                </td>
								<td>
                                    <select required id="country{{ $source->source_id }}" class="country-select span12" name="country" style="color:#333!important;" data-id="{{ $source->source_id }}" @if (isset($vip->username) and $user->username == $vip->username) data-prices="{{ $source->jsonVipPrices }}" @else data-prices="{{ $source->jsonPrices }}" @endif>
                                        <option value="">SELECT COUNTRY</option>
                                        @foreach (explode(',', $source->source_country) as $value)
                                        <option class="{{ ((trim($value) == 'India')?'India':"").''.((trim($value) != 'India')?'Other':"") }}" value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
								</td>
                                <td>
                                    <div style="font-size:18px;line-height:30px;float:left;">$</div><input id="amount{{$source->source_id}}" value="" readonly name="price" type="text" style="float:left;" class="span10"/>
                                </td>
								<td style="text-align:center;">
                                    <div id="competetive{{ $source->source_id }}" style="display: none;">
                                        <span class="label label-info">Competitive</span>
                                    </div>
                                    <div id="active{{ $source->source_id }}" style="display: none;">
                                        <span span class="label label-success">Active</span>
                                    </div>
                                </td>
								<td style="text-align:right;">
                                    @if ($user->settings->account_balance < 15)
                                    <span class="btn btn-small btn-payment disabled"><i class="icon-chevron-right"></i> Continue</span>
                                    @else
                                    <button class="btn btn-small btn-payment" type="submit"><i class="icon-chevron-right"></i> Continue</button>
                                    @endif
                                    <a href="http://www.blackhatworld.com/blackhat-seo/seo-link-building/531993-expressvisits-com-premium-traffic-provider-get-your-google-organic-traffic-instantly.html" role="button" data-toggle="modal" class="btn btn-mini btn-success" style="margin-top: 3px;" target="_blank"><i class="icon-comment"></i> Write Review</a>
								</td>
							</tr>
						</form>

                        <!-- Source description popup window -->
                        <div id="sourceDescription{{ $source->source_id }}" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove-sign"></i></button>
                                <h3 id="myModalLabel">{{ $source->source_name}} full description</h3>
                            </div>
                            <div class="modal-body">
                                {!! $source->source_desc !!}
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                            </div>
                        </div>

						<!-- Add new country modal window -->
						<div id="writeReview{{ $source->source_id }}" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove-sign"></i></button>
								<h4 id="myModalLabel">Write Review for "{{ $source->source_name}}"</h4>
							</div>
							<div class="modal-body" style="overflow:hidden;">
                                <form action="{{ url('/dashboard/review/create') }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $source->source_id }}" name="sourceID"/>
									<p style="text-align:center;">Write your review for this source:</p>
									<p><textarea class="span12" rows="10" name="reviewText"></textarea></p>
									<p style="text-align:center;">Rate traffic quality:</p>
									<p style="text-align:center;"><select name="reviewRating">
											<option value="5">Excelent</option>
											<option value="4">Very Good</option>
											<option value="3">Good</option>
											<option value="2">Poor</option>
											<option value="1">Very poor</option>
										</select></p>
									<p style="text-align:center;"><button type="submit" class="btn btn-payment"><i class="icon-play-circle"></i> Submit Review</button></p>
								</form>
							</div>
							<div class="modal-footer">
								<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
							</div>
						</div>
                        @endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- /Main window -->

@endsection

@section('page_script')
    <script>
        $('#example').tooltip();

        $('.country-select').change(function () {
            var prices = $(this).data('prices');
            $('#amount'+$(this).data('id')).val(prices[$(this).val()]);

            var option = $(this).find('option:selected');
            $('#competetive'+$(this).data('id')).toggle(option.hasClass('India'));
            $('#active'+$(this).data('id')).toggle(option.hasClass('Other'));
        });
    </script>
@stop