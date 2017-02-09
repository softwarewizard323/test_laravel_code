@extends('layouts.app')

@section('title', ' - Features')
@section('keywords', 'Send traffic to your site seo get google on first page')
@section('description', "Here are some ExpressVisits highlights and features that we include in our service and the traffic we offer.")

@section('breadcrumb')
<div class="header header_thin">
    <div class="container_12">
        <div class="breadcrumbs"><a href="{{ url('/') }}">Homepage</a> <span class="separator">&nbsp;</span>Features</div>
    </div>
</div>
@stop

@section('content')

<!-- content -->
<div class="content">

    <div class="post-item post-detail">

        <div class="entry">

            <div class="title_big">
                <h2>Features That <span>IMPRESS</span></h2>
                <p class="subtitle">What defines us differently from other Traffic Providers</p>
            </div>

            <!-- 3 column w styled textblock2 -->
            <div class="row">

                <div class="col col_1_3">
                    <div class="inner">
                        <div class="text-block-2">
                            <img src="images/icons/GA2.png" alt="" class="aligncenter"><br>
                            <div class="title_small">
                                <h2><span style="color:#1851CE">G</span><span style="color:#C61800">O</span><span style="color:#FFCF00">O</span><span style="color:#1851CE">G</span><span style="color:#31B639">L</span><span style="color:#C61800">E</span> VISITORS</h2>
                                <p class="subtitle">Google on Demand</p>
                            </div>
                            <p>We are the leading supplier of Google Organic Traffic and as far as we know, the ONLY one. ExpressVisits provides a cheaper alternative compared to Adwords or SEO campaigns!</p></div>
                    </div>
                </div>

                <div class="col col_1_3">
                    <div class="inner">
                        <div class="text-block-2">
                            <img src="images/icons/graph2.png" alt="" class="aligncenter"><br>
                            <div class="title_small">
                                <h2>SECURE ANALYTICS</h2>
                                <p class="subtitle">Flaunt your Google Analytics</p>
                            </div>
                            <p>Watch as that line skyrockets! Get Traffic in confidence as you watch the visitors browse your site in real-time. Imagine what you can do with a site that's full of engaged visitors!</p>
                        </div>
                    </div>
                </div>

                <div class="col col_1_3 ">
                    <div class="inner">
                        <div class="text-block-2">
                            <img src="images/icons/dripfeed.png" alt="" class="aligncenter"><br>
                            <div class="title_small">
                                <h2>DRIPFEED</h2>
                                <p class="subtitle">Fine Tune your Traffic</p>
                            </div>
                            <p>One of the features we offer is that you get to control how many visitors you can send to your site a day. Resulting in more believable Organic Traffic that will help you seal the deal with interested parties.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ 3 column w styled textblock2 -->

            <div class="divider_space_thin"></div>

            <!-- 3 column w styled textblock2 -->
            <div class="row">

                <div class="col col_1_3">
                    <div class="inner">
                        <div class="text-block-2">
                            <img src="images/icons/revenue2.png" alt="" class="aligncenter"><br>
                            <div class="title_small">
                                <h2>PROFITABLE TRAFFIC</h2>
                                <p class="subtitle">The only limit is your IMAGINATION</p>
                            </div>
                            <p>Unlike other Traffic Providers, our traffic isn't just used for cosmetics. We deliver visitors who browse through sites and click on ads.</p>
                        </div>
                    </div>
                </div>

                <div class="col col_1_3">
                    <div class="inner">
                        <div class="text-block-2">
                            <img src="images/icons/adrevenue2.png" alt="" class="aligncenter"><br>
                            <div class="title_small">
                                <h2>AD REVENUE</h2>
                                <p class="subtitle">Turn your Site into a Money Tree</p>
                            </div>
                            <p>A proven method among our clients is to create a brand new site, strategically place Ads and flood it with our traffic. Easy payday for anyone making an income online!</p>
                        </div>
                    </div>
                </div>

                <div class="col col_1_3 ">
                    <div class="inner">
                        <div class="text-block-2">
                            <img src="images/icons/support2.png" alt="" class="aligncenter"><br>
                            <div class="title_small">
                                <h2>CUSTOMER SATISFACTION</h2>
                                <p class="subtitle">Rely on our Outstanding Reputation</p>
                            </div>
                            <p>With 1000+ Clients and more than 2000+ Orders, we are confident in making you happy with your experience with us. If many of our clients are walking with fat checks, why can't you?</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ 3 column w styled textblock2 -->

            <div class="divider_big"></div>

            <div class="title_big">
                <h2>Ready to <span>Begin your Journey?</span></h2>
                <p class="subtitle">Start now or Never.</p>
            </div>

            <p class="text-center"><a href="{{ url('/register') }}" class="btn tf_btn_red">SIGN UP FOR A PLAN</a></p>

            <div class="clear"></div>
        </div>
    </div>
</div>
<!--/ content -->

@stop

@section('page_script')
@stop