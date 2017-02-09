@extends('dashboard.layouts.app')

@section('content')
    <style type="text/css">
        a.dripfeed_link {
            text-decoration: underline
        }

        a.dripfeed_link:hover {
            text-decoration: none;
        }
    </style>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
    <!-- Main window -->
    <div class="main_container">
        <br>
        <div class="row-fluid">
            <div class="widget widget-padding span10" id="wizard">
                <div class="wizard">
                    <ul class="steps">
                        <li data-target="#step1" class="complete"><span class="badge badge-success">1</span>Step 1<span
                                    class="chevron"></span></li>
                        <li data-target="#step2" class="active"><span class="badge badge-info">2</span>Step 2<span
                                    class="chevron"></span></li>
                        <li data-target="#step3"><span class="badge">3</span>Step 3<span class="chevron"></span></li>
                        <li data-target="#step4"><span class="badge">4</span>Step 4<span class="chevron"></span></li>
                    </ul>
                </div>
                <script src="http://code.jquery.com/jquery-latest.js"></script>

                <div class="widget-body" style="height: auto; overflow: auto;">

                    <div style="text-align:center;color:#666;margin:10px 0 25px 35px;padding-bottom:5px;border-bottom:solid 1px #DDD;"
                         class="span11">
                        <p style="font-size:28px;">Setup Your Order</p>
                        <p>On this page you are able to setup all necessary things about your incoming traffic such as
                            keyword, daily visitors number and add a website that will be used in this campaign.</p>
                    </div>

                    <form method="post" action="{{ url('/dashboard/traffic/adsense/confirm') }}" id="calculationForm">
                        {{ csrf_field() }}
                        <input type="hidden" id="postPriceHidden" value=" {{ $data->price }} ">
                        <input type="hidden" name="username" value="{{ $user->username }}">
                        <input type="hidden" name="totalprice" id="txtTotalPrice"/>
                        <input type="hidden" name="source" value="{{ $data->source }}"/>
                        <input type="hidden" name="type" value="{{ $data->traffic }}"/>
                        <input type="hidden" name="referrer" value="{{ $data->referrer }}"/>

                        <div class="control-group span11">
                            <label class="control-label span2 oplabels" style="min-width:150px;">Traffic Source:</label>
                            <div class="controls">
                                <input readonly class="span4" type="text" id="txtSource"
                                       value="{{ $data->sourceTab->source_name }}"/>
                            </div>
                        </div>

                        <div class="control-group span11">
                            <label class="control-label span2 oplabels" style="min-width:150px;">Traffic Type:</label>
                            <div class="controls">
                                <input readonly class="span4" type="text" id="txtSource"
                                       value="Adsense {{ $data->referrer }}"/>
                            </div>
                        </div>

                        <div class="control-group span11">
                            <label class="control-label span2 oplabels" style="min-width:150px;">Country:</label>
                            <div class="controls">
                                <input readonly class="span4" type="text" id="txtCountry" name="country"
                                       value="{{ $data->country }}"/>
                            </div>
                        </div>

                        <div class="control-group span8"
                             style="margin: 0 0 10px 16%;padding-left:10px;border-left: solid 1px #CCC;">
                            @if ($data->traffic == 'Google')
                                Please submit only a URL that is being indexed in Google.com
                            @endif
                            <br>
                            Make sure you add URL in following format <i>http://www.example.com</i>
                        </div>

                        <div class="control-group span11">
                            <label class="control-label span2 oplabels" style="min-width:150px;">Website:</label>
                            <div class="controls">
                                <input required="required" class="span9" id="wizard_url" type="url" name="website"
                                       placeholder="http://www.example.com">
                            </div>
                        </div>

                        @if ($data->referrer == 'Google')
                            <div class="control-group span11">
                                <label class="control-label span2 oplabels" style="min-width:150px;">
                                    Google Domain (TLD):
                                </label>
                                <div class="controls"> http://www.google.
                                    <select name="google_tld">
                                        <option value="com">com</option>
                                        <option value="ad">ad</option>
                                        <option value="ae">ae</option>
                                        <option value="com.af">com.af</option>
                                        <option value="com.ag">com.ag</option>
                                        <option value="com.ai">com.ai</option>
                                        <option value="am">am</option>
                                        <option value="co.ao">co.ao</option>
                                        <option value="com.ar">com.ar</option>
                                        <option value="as">as</option>
                                        <option value="at">at</option>
                                        <option value="com.au">com.au</option>
                                        <option value="az">az</option>
                                        <option value="ba">ba</option>
                                        <option value="com.bd">com.bd</option>
                                        <option value="be">be</option>
                                        <option value="bf">bf</option>
                                        <option value="bg">bg</option>
                                        <option value="com.bh">com.bh</option>
                                        <option value="bi">bi</option>
                                        <option value="bj">bj</option>
                                        <option value="com.bn">com.bn</option>
                                        <option value="com.bo">com.bo</option>
                                        <option value="com.br">com.br</option>
                                        <option value="bs">bs</option>
                                        <option value="co.bw">co.bw</option>
                                        <option value="by">by</option>
                                        <option value="com.bz">com.bz</option>
                                        <option value="ca">ca</option>
                                        <option value="cd">cd</option>
                                        <option value="cf">cf</option>
                                        <option value="cg">cg</option>
                                        <option value="ch">ch</option>
                                        <option value="ci">ci</option>
                                        <option value="cl">cl</option>
                                        <option value="cm">cm</option>
                                        <option value="com.co">com.co</option>
                                        <option value="co.cr">co.cr</option>
                                        <option value="com.cu">com.cu</option>
                                        <option value="cv">cv</option>
                                        <option value="com.cy">com.cy</option>
                                        <option value="cz">cz</option>
                                        <option value="de">de</option>
                                        <option value="dj">dj</option>
                                        <option value="dk">dk</option>
                                        <option value="dm">dm</option>
                                        <option value="com.do">com.do</option>
                                        <option value="dz">dz</option>
                                        <option value="com.ec">com.ec</option>
                                        <option value="ee">ee</option>
                                        <option value="com.eg">com.eg</option>
                                        <option value="es">es</option>
                                        <option value="com.et">com.et</option>
                                        <option value="fi">fi</option>
                                        <option value="com.fj">com.fj</option>
                                        <option value=fm"">fm</option>
                                        <option value="fr">fr</option>
                                        <option value="ga">ga</option>
                                        <option value="ge">ge</option>
                                        <option value="gg">gg</option>
                                        <option value="com.gh">com.gh</option>
                                        <option value="com.gi">com.gi</option>
                                        <option value="gl">gl</option>
                                        <option value="gm">gm</option>
                                        <option value="gp">gp</option>
                                        <option value="gr">gr</option>
                                        <option value="com.gt">com.gt</option>
                                        <option value="gy">gy</option>
                                        <option value="com.hk">com.hk</option>
                                        <option value="hn">hn</option>
                                        <option value="hr">hr</option>
                                        <option value="ht">ht</option>
                                        <option value="hu">hu</option>
                                        <option value="co.id">co.id</option>
                                        <option value="ie">ie</option>
                                        <option value="co.il">co.il</option>
                                        <option value="im">im</option>
                                        <option value="co.in">co.in</option>
                                        <option value="iq">iq</option>
                                        <option value="is">is</option>
                                        <option value="it">it</option>
                                        <option value="je">je</option>
                                        <option value="com.jm">com.jm</option>
                                        <option value="jo">jo</option>
                                        <option value="co.jp">co.jp</option>
                                        <option value="co.ke">co.ke</option>
                                        <option value="com.kh">com.kh</option>
                                        <option value="ki">ki</option>
                                        <option value="kg">kg</option>
                                        <option value="co.kr">co.kr</option>
                                        <option value="com.kw">com.kw</option>
                                        <option value="kz">kz</option>
                                        <option value="la">la</option>
                                        <option value="com.lb">com.lb</option>
                                        <option value="li">li</option>
                                        <option value="lk">lk</option>
                                        <option value="co.ls">co.ls</option>
                                        <option value="lt">lt</option>
                                        <option value="lu">lu</option>
                                        <option value="lv">lv</option>
                                        <option value="com.ly">com.ly</option>
                                        <option value="co.ma">co.ma</option>
                                        <option value="md">md</option>
                                        <option value="me">me</option>
                                        <option value="mg">mg</option>
                                        <option value="mk">mk</option>
                                        <option value="ml">ml</option>
                                        <option value="mn">mn</option>
                                        <option value="ms">ms</option>
                                        <option value="com.mt">com.mt</option>
                                        <option value="mu">mu</option>
                                        <option value="mv">mv</option>
                                        <option value="mw">mw</option>
                                        <option value="com.mx">com.mx</option>
                                        <option value="com.my">com.my</option>
                                        <option value="co.mz">co.mz</option>
                                        <option value="com.na">com.na</option>
                                        <option value="com.nf">com.nf</option>
                                        <option value="com.ng">com.ng</option>
                                        <option value="com.ni">com.ni</option>
                                        <option value="ne">ne</option>
                                        <option value=nl"">nl</option>
                                        <option value="no">no</option>
                                        <option value="com.np">com.np</option>
                                        <option value="nr">nr</option>
                                        <option value="nu">nu</option>
                                        <option value="co.nz">co.nz</option>
                                        <option value="com.om">com.om</option>
                                        <option value="com.pa">com.pa</option>
                                        <option value="com.pe">com.pe</option>
                                        <option value="com.ph">com.ph</option>
                                        <option value="com.pk">com.pk</option>
                                        <option value="pl">pl</option>
                                        <option value="pn">pn</option>
                                        <option value="com.pr">com.pr</option>
                                        <option value="ps">ps</option>
                                        <option value="pt">pt</option>
                                        <option value="com.py">com.py</option>
                                        <option value="com.qa">com.qa</option>
                                        <option value="ro">ro</option>
                                        <option value="ru">ru</option>
                                        <option value="rw">rw</option>
                                        <option value="com.sa">com.sa</option>
                                        <option value="com.sb">com.sb</option>
                                        <option value="sc">sc</option>
                                        <option value="se">se</option>
                                        <option value="com.sg">com.sg</option>
                                        <option value="sh">sh</option>
                                        <option value="si">si</option>
                                        <option value="sk">sk</option>
                                        <option value="com.sl">com.sl</option>
                                        <option value="sn">sn</option>
                                        <option value="so">so</option>
                                        <option value="sm">sm</option>
                                        <option value="st">st</option>
                                        <option value="com.sv">com.sv</option>
                                        <option value="td">td</option>
                                        <option value="tg">tg</option>
                                        <option value="co.th">co.th</option>
                                        <option value="com.tj">com.tj</option>
                                        <option value="tk">tk</option>
                                        <option value="tl">tl</option>
                                        <option value="tm">tm</option>
                                        <option value="tn">tn</option>
                                        <option value="to">to</option>
                                        <option value="com.tr">com.tr</option>
                                        <option value="tt">tt</option>
                                        <option value="com.tw">com.tw</option>
                                        <option value="co.tz">co.tz</option>
                                        <option value="com.ua">com.ua</option>
                                        <option value="co.ug">co.ug</option>
                                        <option value="co.uk">co.uk</option>
                                        <option value="com.uy">com.uy</option>
                                        <option value="co.uz">co.uz</option>
                                        <option value="com.vc">com.vc</option>
                                        <option value="co.ve">co.ve</option>
                                        <option value="vg">vg</option>
                                        <option value="co.vi">co.vi</option>
                                        <option value="com.vn">com.vn</option>
                                        <option value="vu">vu</option>
                                        <option value="ws">ws</option>
                                        <option value="rs">rs</option>
                                        <option value="co.za">co.za</option>
                                        <option value="co.zm">co.zm</option>
                                        <option value="co.zw">co.zw</option>
                                        <option value="cat">cat</option>
                                        <option value="xxx">xxx</option>
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="control-group span11">
                            <label class="control-label span2 oplabels" style="min-width:150px;">
                                <a href="{{ url('/faq?id=7') }}" target="_blank"
                                   class="dripfeed_link"><i class="icon-time"></i> 24h Dripfeed:
                                    <span class="badge badge-warning">
                                        <i class="icon-question-sign"></i>
                                    </span>
                                </a>
                            </label>
                            <div class="controls span9"
                                 style="margin-left: 14.5%;margin-top:-30px;margin-bottom:20px;padding:10px;border-left: solid 1px #CCC;
                                 background:<?php if ( isset($data->countryDripFeed)) {
                                     echo '#CEFFC6';
                                 } else {
                                     echo '#F8E3E3';
                                 } ?>">
                                @if( isset($data->countryDripFeed) )
                                    <span class="label label-success">Available For This Country</span>
                                @else
                                    <span class="label label-important">Not Available For This Country</span>'
                                @endif

                                @if( isset($data->countryDripFeed) )
                                    <input type="checkbox" name="dripfeed" value="Yes"/> Do you want to drip your
                                    traffic for 24h?
                                @endif
                            </div>
                        </div>
                        @if($data->referrer == 'Google')
                            <hr>
                            <div class="control-group span11"  style="display: none;">
                                <label class="control-label span2 oplabels" style="min-width:150px;">
                                    <a href="{{ url('/faq?id=9') }}" target="_blank"
                                       class="dripfeed_link">
                                        <i class="icon-random"></i> GA Traffic Monitoring
                                        <span class="badge badge-warning">
                                        <i class="icon-question-sign"></i>
                                    </span>
                                    </a>
                                </label>
                                <div class="controls span9" style="margin-left:0; padding-left:0">
                                    <ul class="unstyled">
                                        <li>
                                            <input type="radio" name="ga_track" value="free" checked id="free">
                                            <strong>Free:</strong> Do it yourself. ($0)
                                        </li>
                                        <li>
                                            <input type="radio" name="ga_track" value="basic" id="basic">
                                            <strong>Basic:</strong> ($0.50/day)
                                        </li>
                                        <li style="margin-top:10px">
                                            <input type="text" class="span3" id="basic-field" name="ga_tracking_code"
                                                   placeholder="Google Analytic UA" style=" display:none;">
                                        </li>
                                        <li>
                                            <input type="radio" name="ga_track" value="advanced" disabled>
                                            <strong>Advance:</strong> Coming soon
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <hr>
                            <div class="control-group span8"
                                 style="margin-left: 16%;padding-left:10px;border-left: solid 1px #CCC;">
                                @if ($data->traffic == 'Google')
                                    Now lets define the keywords which you want to use for your traffic source.<br/>
                                    Under "<i>Keyword</i>" field, fill in the keyword you want to use which will reflect
                                    inside
                                    your Google Analytics.<br/>
                                    Use slider to choose how many visitors you want for that specific keyword.<br/>
                                    To add new keyword and the # of visitors for that new keyword click on
                                    <span class="btn btn-mini btn-payment">
                                    <i class="icon-plus-sign"></i> Add New Keyword</span> button.<br/>
                                    If you added the keyword by mistake, click on
                                    <a class="btn btn-danger btn-mini"><i class="icon-trash"></i></a> button.
                                @else
                                    Use slider to choose how many visitors you want to receive every day.
                                @endif
                            </div>
                        @endif

                        @if ($data->referrer == 'Google')
                            @if ($data->traffic == 'Google')
                                <div class="control-group span11" id="templateWrapper">
                                    <div class="keywordTemplate ui-widget-content"
                                         style="padding:20px 10px 0 10px;border:solid 1px #E6D5B8;background:#FFEDCC;height:auto;overflow:auto;">
                                        <div>
                                            <label class="control-label span2 oplabels" style="min-width:150px;">
                                                Daily Visitors:
                                            </label>
                                            <input type="text" name="keywordcount-1" class="keywordCount" readonly/>
                                            <div class="singleSlider"
                                                 style="display:inline-block;width:50%;margin-left:20px;">
                                            </div>
                                            <button type="button" class="deleteButton btn btn-danger btn-mini"
                                                    style="position:relative;margin-right:10px;float:right;">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label span2 oplabels" style="min-width:150px;">Keyword
                                                name:</label>
                                            <input type="text" name="keywordtext-1" class="span6 txtKeyword"
                                                   placeholder="Type keyword" required="required"/>
                                        </div>
                                    </div><!-- END keywordTemplate -->
                                </div><!-- END #templateWrapper -->
                            @endif
                        @else
                            <div class="control-group span11" id="templateWrapper">
                                <div class="keywordTemplate ui-widget-content"
                                     style="padding:20px 10px 0 10px;border:solid 1px #E6D5B8;background:#FFEDCC;height:auto;overflow:auto;">
                                    <div>
                                        <label class="control-label span2 oplabels" style="min-width:150px;">Daily
                                            Visitors:</label>
                                        <input type="text" name="keywordcount-1" class="keywordCount" readonly/>
                                        <div class="singleSlider"
                                             style="display:inline-block;width:50%;margin-left:20px;">
                                        </div>
                                    </div>

                                </div><!-- END keywordTemplate -->
                            </div><!-- END #templateWrapper -->
                        @endif
                        @if ($data->referrer == 'Google')
                        @if ($data->traffic == 'Google')
                        <div class="control-group span11"
                             style="text-align:center;padding:10px 0 40px 0;border-top:solid 1px #CCC;">
                            <button type="button" id="btnAddNewKeyword" class="btn btn-payment">
                            <i class="icon-plus-sign"></i> Add New Keyword
                            </button>
                            <p>
                                <small>
                                    $0.10 will be charged from your account balance for every additional keyword.
                                </small>
                            </p>
                        </div>
                        @endif
                        @endif

                        <div class="text-center span6 offset3"
                             style="background:#f4f4f4;padding:15px; height:130px; overflow-y:scroll">
                            <p>
                                1. Some special characters keyword like Chinese or Arabic have issues in
                                appearing in
                                Google Analytic correctly. If you decide to use non-english keyword, please be
                                aware
                                that this phenomenon could occur. You could end the campaign if you notice this
                                issue
                                occurring, however we do not provide any refunds for this reason.
                            </p>
                            <p>2. Please read our full TOS, including refund policy here:
                                <a href="{{ url('/tos') }}" target="_blank">{{ url('/tos') }}</a>
                            </p>
                            <p>3. Campaigns could stay in pending status for up to 72 hours till activation (If
                                there are massive orders in queue, most orders are normally activated within 24
                                hours). We setup new campaigns daily from 1am- 4am (Time zone: New York)
                            </p>
                        </div>
                        <div class="text-center span6 offset3"
                             style="margin-bottom:60px;background:#f4f4f4;padding:15px;">
                            <p><Input type="checkbox" required><strong>I agree</strong></p>
                        </div>

                        <div class="opaccbalance span11">
                            <strong>ACCOUNT BALANCE:</strong>
                            ${{  number_format($user->settings->account_balance, 2, ',', ' ')}}
                        </div>
                        <div class="oppayments span11">
                            <ul class="unstyled">
                                <li style="margin-bottom:5px;">
                                    <strong>TOTAL DAILY VISITORS:</strong>
                                    <span id="txtTotalCount"></span>
                                </li>
                                <li style="margin-bottom:5px;">
                                    <strong>CPC PRICE:</strong> ${{ $data->price }}
                                </li>
                                <li style="font-size: 22px; color: #E65B3E; margin-bottom:5px;">
                                    <strong>TOTAL DAILY PRICE: $<span id="totalPriceLabel"></span></strong>
                                </li>
                            </ul>
                        </div>
                        <div class="opbutton span11">
                            <div class="pull-left span5" style="line-height:50px;">
                                <a href="{{url('/dashboard/traffic/adsense')}}"><i class="icon-chevron-left"></i> Back to Traffic
                                    Sources</a>
                            </div>
                            <div class="pull-right span5" style="text-align:right;">
                                <button class="btn btn-large btn-payment" type="submit" name="campaignSubmit"
                                        value="Buy Now"><i class="icon-shopping-cart"></i> Continue to Checkout
                                </button>
                            </div>
                        </div>

                        <script type="text/html" id="templateScript">
                            <div class="keywordTemplate ui-widget-content"
                                 style="padding:20px 10px 0 10px;margin-top:5px;border:solid 1px #E6D5B8;background:#FFEDCC;height:auto;overflow:auto;">
                                <div>
                                    <label class="control-label span2 oplabels" style="min-width:150px;">
                                        Daily Visitors:
                                    </label>
                                    <input type="text" name="keywordcount-" class="keywordCount"
                                           readonly="readonly"/>
                                    <div class="singleSlider"
                                         style="display:inline-block;width:50%;margin-left:20px;"></div>
                                    <button type="button" class="deleteButton btn btn-danger btn-mini"
                                            style="position:relative;margin-right:10px;float:right;"><i
                                                class="icon-trash"></i></button>
                                </div>

                                <div class="control-group span10">
                                    <label class="control-label span2 oplabels" style="min-width:150px;">Keyword
                                        name:</label>
                                    <input type="text" name="keywordtext-" class="span6 txtKeyword"
                                           placeholder="Type keyword" required="required"/>
                                </div>
                            </div><!-- END keywordTemplate -->
                        </script>
                        {{ Html::script('include/js/jquery-ui.js') }}
                        {{ Html::script('include/js/site.js') }}

                        <script type="text/javascript">
                            $(document).ready(function () {
                                $('#free').click(function () {
                                    $('#basic-field').hide('fast');
                                });
                                $('#basic').click(function () {
                                    $('#basic-field').show('fast');
                                });
                            });
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main window -->
@endsection