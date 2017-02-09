@extends('layouts.app')

@section('title', ' - Premium Traffic Provider')
@section('keywords', 'Send traffic to your site seo get google on first page')
@section('description', 'ExpressVisits gives you Massive Traffic at your Command. #1 Traffic Provider that supplies Quality Traffic at Premium prices.')

@section('content')

<!-- content -->
<div class="content">
    <div class="post-detail">
        <div class="entry">

            <!-- 3 column w styled textblock -->
            <div class="row">

                <div class="col col_1_3">
                    <div class="inner">
                        <div class="text-block-1">
                            <div class="title_small">
                                <h2>GORGEOUS ANALYTICS</h2>
                                <p class="subtitle">Pump up your Google Stats</p>
                            </div>
                            <p style="text-align:center">With Google Booster you can now show off your website's stats to rabid investors who are looking to fund your site. This is a perfect opportunity especially for Site Flippers!</p>
                            <br><br><br><br>
                            <p class="text-center" style="color:#dd4436">Ready to Make Money? Join us here:</p>
                        </div>
                    </div>
                </div>

                <div class="col col_1_3">
                    <div class="inner">
                        <div class="text-block-1">
                            <div class="title_small">
                                <h2>SAFE CLICKS</h2>
                                <p class="subtitle">Protect Your Account</p>
                            </div>
                            <p style="text-align:center">Keeping your account safe is our main priority with the Adsense Booster. We know what traffic Google loves, and only use 100% legitimate White Hat techniques so that Google ban hammer doesn't come anywhere near you!</p>
                            <br><br><br>
                            <p class="text-center"><a href="{{ url('/register') }}" class="btn tf_btn_red">SIGN UP FOR A PLAN</a></p>
                        </div>
                    </div>
                </div>

                <div class="col col_1_3 ">
                    <div class="inner">
                        <div class="text-block-1">
                            <div class="title_small">
                                <h2>CONVERT TO SALES</h2>
                                <p class="subtitle">Fully Managed</p>
                            </div>
                            <p style="text-align:center">We spend the precious hours and does all the tedious optimisation and research for you to try bring sales to your website. You are getting only expensive, highly targeted traffic from networks including Google AdWords, Facebook, Bing, and Media Buys.</p>
                            <br><br><br><br>
                            <p class="text-center"><a href="{{ url('/features') }}" class="link-more2">Not yet convinced? Learn more!</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ 3 column w styled textblock -->

            <div class="divider_big"></div>

            <div class="title_big">
                <h2><span>Plans & Pricing</span></h2>
                <p class="subtitle">Choose the right plan for you!</p>
            </div>


            <!-- pricing table -->
            <div class="styled_table table_green pricing">
                <div style="text-align:center;">
                    <h2><i class="icon-eye-open"></i> Cosmetic Traffic</h2>
                </div>

                <table>
                    <thead>
                    <tr>
                        <th style="width:45%">Source</th>
                        <th style="width:30%">Target Country</th>
                        <th style="width:25%">Price per click</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($select as $row)
                        <tr>
                            <td>{{$row->source_name}}</td>
                            <td>
                                <select required id="country{{$row->source_id}}" class="country-select span12" name="country" style="color:#444!important;font-size:21px;padding:2px 5px;" data-id="{{$row->source_id}}" data-prices="{{ $row->jsonPrices }}">
                                    <option value="">SELECT COUNTRY</option>
                                    @foreach(explode(',', $row->source_country) as $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input id="amount{{ $row->source_id }}" value="SELECT COUNTRY" readonly name="price" type="text" style="border:none!important;background:none!important;font-size:21px;color:#444;text-align:center;" /></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <div style="text-align:center;">
                    <h2><i class="icon-leaf"></i> Conversion Traffic</h2>
                </div>
                <table>
                    <thead>
                    <tr>
                        <th style="width:50%">Country</th>
                        <th style="width:50%">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>All</td>
                        <td>By Quotation Basis</td>
                    </tr>
                    </tbody>
                </table>

            </div>
            <!--/ pricing table -->
            <br><br><br>
            <p class="text-center price_bottom">Interested in Reselling Our Services? <a href="#" class="topopup">Contact Us</a>.</p>

            <div class="divider_big"></div>

            <div class="title_big">
                <h2>Our Clients <span>LOVE</span> us!</h2>
                <p class="subtitle">Hear what people have to say about our services!</p>
            </div>

            <div id="testimonials" class="slideshow slideQuotes">
                <div class="slides_container">
                    <div class="slide">
                        <div class="quote-text" style="text-align:center;"><img src="images/testemonials/t1.jpg"></div>
                        <div class="quote-text">Great service. After my traffic was delivered, my traffic went up 500%, all for my keyword and all from G@@@le dot com. Will be using this service again for sure.</div>
                        <div class="quote-author"><span><a href="http://www.blackhatworld.com/blackhat-seo/seo-link-building/531993-expressvisits-com-premium-traffic-provider-get-your-google-organic-traffic-instantly.html#post5226536">James2@BHW</a></span></div>
                    </div>
                    <div class="slide">
                        <div class="quote-text" style="text-align:center;"><img src="images/testemonials/t2.jpg"></div>
                        <div class="quote-text">All I can say is wow. My analytics is showing that all the visitors came using my KW, on different state and different browser used. No bot pattern on this one!<br><br>This is superb service! I will definitely use this on my future projects.</div>
                        <div class="quote-author"><span><a href="http://www.blackhatworld.com/blackhat-seo/seo-link-building/531993-expressvisits-com-premium-traffic-provider-get-your-google-organic-traffic-instantly.html#post5228213">ice41@BHW</a></span></div>
                    </div>
                    <div class="slide">
                        <div class="quote-text" style="text-align:center;"><img src="images/testemonials/t3.jpg"></div>
                        <div class="quote-text">Great traffic and I mean exceptional, low bounce rate, viewing more than one page
                            and one of the best things it shows up in Analytics.<br><br>I have no doubt if you have adsense on your site you are going to get loads of clicks also this will be great for Flippas.<br><br>Overall 10 / 10 for the service and communication.<br><br>Will definitely be buying once I sort my sites out.</div>
                        <div class="quote-author"><span><a href="http://www.blackhatworld.com/blackhat-seo/seo-link-building/531993-expressvisits-com-premium-traffic-provider-get-your-google-organic-traffic-instantly.html#post5229413">geomuss@BHW</a></span></div>
                    </div>
                    <div class="slide">
                        <div class="quote-text" style="text-align:center;"><img src="images/testemonials/t4.jpg"></div>
                        <div class="quote-text">Just to say guys, this is real traffic, users will click on ads, confirming this is real traffic. Big vouch for him. I don't vouch often.</div>
                        <div class="quote-author"><span><a href="http://www.blackhatworld.com/blackhat-seo/seo-link-building/531993-expressvisits-com-premium-traffic-provider-get-your-google-organic-traffic-instantly-6.html#post5854024">sapmi@BHW</a></span></div>
                        <p></p>
                    </div>
                </div>
                <div id="testimonial_paginate">
                    <a href="#" class="prev">Prev</a>
                    <a href="http://www.blackhatworld.com/blackhat-seo/seo-link-building/531993-expressvisits-com-premium-traffic-provider-get-your-google-organic-traffic-instantly.html" class="link-more">VIEW MORE TESTIMONIALS</a>
                    <a href="#" class="next">Next</a>
                </div>
                <div class="clear"></div>
            </div>

            <div class="divider_big"></div>

            <div class="title_big">
                <h2>Features You'll <span>Enjoy</span></h2>
                <p class="subtitle">Services that put other Traffic Providers to shame!</p>
            </div>

            <!-- features block -->
            <div class="box box_border box_white">

                <div class="col col_1_2">
                    <div class="inner">

                        <div class="feature_block">
                            <img src="images/icons/GA.png" width="64" height="64" alt="" class="alignleft">
                            <div class="feature_descr">
                                <h3><span style="color:#1851CE">G</span><span style="color:#C61800">O</span><span style="color:#FFCF00">O</span><span style="color:#1851CE">G</span><span style="color:#31B639">L</span><span style="color:#C61800">E</span> VISITORS</h3>
                                <p>We are the leading supplier of Google Organic Traffic and as far as we know, the ONLY one. ExpressVisits provides a more affordable alternative compared to Adwords or SEO campaigns!</p>
                            </div>
                            <div class="clear"></div>
                        </div>

                    </div>
                </div>

                <div class="col col_1_2">
                    <div class="inner">

                        <div class="feature_block">
                            <img src="images/icons/adrevenue.png" width="64" height="64" alt="" class="alignleft">
                            <div class="feature_descr">
                                <h3>AD REVENUE RETURNS</h3>
                                <p>Some of our client's most proﬁtable campaigns are to buy our trafﬁc and send it to their websites. The visitors then click on the ads and the clients receive their ad revenue.</p>
                            </div>
                            <div class="clear"></div>
                        </div>

                    </div>
                </div>

                <div class="clear"></div>

                <div class="col col_1_2">
                    <div class="inner">

                        <div class="feature_block">
                            <img src="images/icons/promotion.png" width="64" height="64" alt="" class="alignleft">
                            <div class="feature_descr">
                                <h3>SITE PROMOTION</h3>
                                <p>Have you built a new site but it's not picking up as much trafﬁc as you thought it would? ExpressVisits solves that. Make your site busy with real people and make money!</p>
                            </div>
                            <div class="clear"></div>
                        </div>

                    </div>
                </div>

                <div class="col col_1_2">
                    <div class="inner">

                        <div class="feature_block">
                            <img src="images/icons/targeting.png" width="64" height="64" alt="" class="alignleft">
                            <div class="feature_descr">
                                <h3>WORLDWIDE TARGETING</h3>
                                <p>The world is in your hands.<br>Choose betweeen the US or UK or have a selected list of countries to super target your campaigns and maximise your earning potential.</p>
                            </div>
                            <div class="clear"></div>
                        </div>

                    </div>
                </div>

                <div class="clear"></div>

                <div class="col col_1_2">
                    <div class="inner">

                        <div class="feature_block">
                            <img src="images/icons/cp.png" width="64" height="64" alt="" class="alignleft">
                            <div class="feature_descr">
                                <h3>CONTROL PANEL</h3>
                                <p>With our beautiful control panel, you can have total control over your traffic campaigns. You have options from selecting targeted countries down to how many visitors a day you can send to your website.</p>
                            </div>
                            <div class="clear"></div>
                        </div>

                    </div>
                </div>

                <div class="col col_1_2">
                    <div class="inner">

                        <div class="feature_block">
                            <img src="images/icons/support.png" width="64" height="64" alt="" class="alignleft">
                            <div class="feature_descr">
                                <h3>CUSTOMER SUPPORT</h3>
                                <p>Our staff is always ready to help with your specific needs and wants. Unlike other services we place our clients as our top priority in helping them meet their goals.</p>
                            </div>
                            <div class="clear"></div>
                        </div>

                    </div>
                </div>

                <div class="clear"></div>

                <div class="cms_block">
                    <h3>WHAT OUR CLIENTS USE</h3>
                    <img src="images/platforms.png" width="605" height="40" alt="" class="cms_images">
                </div>

                <div class="clear"></div>
            </div>
            <!--/ features block -->

            <div class="clear"></div>

            <p class="text-center" style="margin-top: 50px;"><a href="{{ url('/register') }}" class="btn tf_btn_red">SIGN UP FOR A PLAN</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="{{ url('/features') }}" class="btn tf_btn_green">WHAT WE OFFER</a></p>

        </div>
    </div>
</div>
<!--/ content -->

@stop

@section('page_script')
<script>
    jQuery(document).ready(function($) {

        $('#testimonials').slides({
            hoverPause: true,
            play: 6000,
            autoHeight: true,
            pagination: false,
            generatePagination: false,
            effect: 'fade',
            fadeSpeed: 150
        });

        $('.country-select').change(function () {
            var prices = $(this).data('prices');
            $('#amount'+$(this).data('id')).val(prices[$(this).val()]);
        });
    });
</script>
@stop