@extends('dashboard.layouts.app')

@section('breadcrumb')
    <li><a href="{{url('/dashboard/useful-services')}}">Useful Services</a></li>
    <li class="active"> Website Builder</li>
@stop

@section('content')
<div class="col-md-9">
    <section class="widget">
        <div class="widget-body">
            <h3>Website Builder FAQ</h3>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading32">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse32" aria-expanded="true" aria-controls="collapse32">
                                1. What is time frame for order complication?
                            </a>
                        </h4>
                    </div>
                    <div id="collapse32" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading32">
                        <div class="panel-body">
                            The time frame is 4-5 days after our team has accepted order. Sometimes this time frame may increase depending on amount of orders we receive.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading33">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse33" aria-expanded="false" aria-controls="collapse33">
                                2. What will you be using to build the website(s)?
                            </a>
                        </h4>
                    </div>
                    <div id="collapse33" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading33">
                        <div class="panel-body">
                            We are using WordPress CMS, alongside WP we will be using templates that will drive most clicks, install all necessary plugins for fast loading, SEO and publishing allowing you to easily manage and edit your blog.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading34">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse34" aria-expanded="false" aria-controls="collapse34">
                                3. Will I be able to add new content after all is completed?
                            </a>
                        </h4>
                    </div>
                    <div id="collapse34" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading34">
                        <div class="panel-body">
                            Yes, you can add new content trough Wordpress admin panel and manage it as any other website.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading35">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse35" aria-expanded="false" aria-controls="collapse35">
                                4. What your work include?
                            </a>
                        </h4>
                    </div>
                    <div id="collapse35" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading35">
                        <div class="panel-body">
                            <p>Our work include following things:</p>
                            <ul>
                                <li>Wordpress installation and setup,</li>
                                <li>Installation of all necessary plugins that will be used for Wordpress speed up, SEO, content management...</li>
                                <li>Template installation and setup.</li>
                                <li>Setup for .htaccess, robots.txt, sitemaps, and other necessary things for best SEO results.</li>
                                <li>Content creating, up to 5 articles are included in basic price. If you need more content added, contact our support with your order ID and we can discuss about it</li>
                                <li>Setup of basic pages such as About us, Terms of Use, Privacy Policy, Contact us...</li>
                                <li>30 days free support. In case anything happens with your website within this time frame we are offering free fixes and support. We are also offering guides on how to manage your Wordpress site if you are not familiar with that.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading36">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse36" aria-expanded="false" aria-controls="collapse36">
                                5. Can I use existing domain or I need fresh one?
                            </a>
                        </h4>
                    </div>
                    <div id="collapse36" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading36">
                        <div class="panel-body">
                            You are allowed to any domain you like, whether its existing one or one you just bought it doesn’t matter.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading37">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse37" aria-expanded="false" aria-controls="collapse37">
                                6. What you need from me in order to start the project?
                            </a>
                        </h4>
                    </div>
                    <div id="collapse37" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading37">
                        <div class="panel-body">
                            We need FTP access, cPanel in order to create database for WordPress installation and domain name.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading38">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse38" aria-expanded="false" aria-controls="collapse38">
                                7. Can I create database by myself instead of giving you cPanel access?
                            </a>
                        </h4>
                    </div>
                    <div id="collapse38" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading38">
                        <div class="panel-body">
                            Yes, as long as you provide us with database credentials so we can complete WordPress installation.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading39">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse39" aria-expanded="false" aria-controls="collapse39">
                                8. Who should use EV website builder service?
                            </a>
                        </h4>
                    </div>
                    <div id="collapse39" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading39">
                        <div class="panel-body">
                            Clients who don’t have time to setup website by them self, clients who are not familiar with website creation, clients who want to achieve maximum from their AdSense or other ad networks.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading40">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse40" aria-expanded="false" aria-controls="collapse40">
                                9. I need more then one website, what should I do?
                            </a>
                        </h4>
                    </div>
                    <div id="collapse40" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading40">
                        <div class="panel-body">
                            You need to place new order for every website individually. If all your websites are hosted under same server and you use same FTP access, you don’t need to fill up all information’s for that FTP logins, all you need to do is enter your order ID under “Anything else” field and we will understand it.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading41">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse41" aria-expanded="false" aria-controls="collapse41">
                                10. Is there limits on number of orders I can place?
                            </a>
                        </h4>
                    </div>
                    <div id="collapse41" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading41">
                        <div class="panel-body">
                            No, you are free to place as many orders as you like.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading42">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse42" aria-expanded="false" aria-controls="collapse42">
                                11. What is ExpressVisits website builder?
                            </a>
                        </h4>
                    </div>
                    <div id="collapse42" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading42">
                        <div class="panel-body">
                            In partnership with external web design company, we are launching service where our clients can quickly get new websites built tailored for Adsense which they can use alongside ExpressVisits traffic to get best possible results in revenues. Everything is managed from within ExpressVisits panels in order to make your job much easier and convenient.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading43">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse43" aria-expanded="false" aria-controls="collapse43">
                                12. How do I pay for my orders?
                            </a>
                        </h4>
                    </div>
                    <div id="collapse43" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading43">
                        <div class="panel-body">
                            Once you setup your order, you will be redirected to PayPal where you need to make your payment. Once you make the payment expect contact from one technicians who will process your order (usually within 24h).
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading44">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse44" aria-expanded="false" aria-controls="collapse44">
                                13. I need some samples of your work. Where I can find it?
                            </a>    
                        </h4>
                    </div>
                    <div id="collapse44" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading44">
                        <div class="panel-body">
                            We are not showing our samples publicly. In order to see samples, you need to request them trough the tickets and we will gladly share 3 of our designs. When creating tickets make sure you choose to send ticket to “Website builder” section.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading45">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse45" aria-expanded="false" aria-controls="collapse45">
                                14. I’m not satisfied with final results. Can I get money back?
                            </a>
                        </h4>
                    </div>
                    <div id="collapse45" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading45">
                        <div class="panel-body">
                            Unfortunately we are not able to offer money back during and after the project is completed.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading46">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse46" aria-expanded="false" aria-controls="collapse46">
                                15. When you are offering money back?
                            </a>
                        </h4>
                    </div>
                    <div id="collapse46" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading46">
                        <div class="panel-body">
                            <p>The cases when we are offering money back are:</p>
                            <ul>
                                <li>We do not process your order within 2 work days</li>
                                <li>We do not complete your website within 5 working days</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget-body" style="text-align:center">
                Done with FAQs? <i class="glyphicon glyphicon-chevron-right"></i> <a href="{{ url('/dashboard/useful-services/website-builder') }}">PLACE ORDER</a>
            </div>
        </div>
    </section>
</div>
@endsection