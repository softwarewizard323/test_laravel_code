@extends('dashboard.layouts.app')

@section('breadcrumb')
    <li><a href="{{url('/dashboard/useful-services')}}">Useful Services</a></li>
    <li class="active"> Website Builder</li>
@stop

@section('content')
<div class="col-md-9">
    <section class="widget">
        <div class="widget-body">
            <div>
                <h3>Welcome to ExpressVisits website builder</h3>
                <p>With well over 3 years working as traffic and serving thousands of clients we are well familiar with this market. We know how our traffic work, what it likes, where it comes and what it expects to see on website. That's why we are launching new service as part of ExpressVisits called "Website builder". You can order completely finished website that you can use for any PPC campagins with our traffic.</p>
                <p><strong>Here's what you get with complete website construction:</strong></p>
                <ul style="list-style-type: none;">
                    <li><span class="glyphicon glyphicon-ok"></span> Fresh, clean and responsive website design</li>
                    <li><span class="glyphicon glyphicon-ok"></span> Up to 5 articles per website</li>
                    <li><span class="glyphicon glyphicon-ok"></span> Strategecly position adsense ad spots</li>
                    <li><span class="glyphicon glyphicon-ok"></span> SEO friendly</li>
                    <li><span class="glyphicon glyphicon-ok"></span> Hand picked domain name (<i>Optional</i>)</li>
                    <li><span class="glyphicon glyphicon-ok"></span> 30 days site support</li>
                </ul>
                <p><strong>Here's what you need:</strong></p>
                <ul style="list-style-type: none;">
                    <li><span class="glyphicon glyphicon-ok"></span> Server</li>
                    <li><span class="glyphicon glyphicon-ok"></span> Domain name</li>
                    <li><span class="glyphicon glyphicon-ok"></span> 1 MySQL database</li>
                    <li><span class="glyphicon glyphicon-ok"></span> FTP access to your server</li>
                </ul>
                <h3>Order TODAY for $114.00</h3>
                <form method="post" action="{{ url('/dashboard/useful-services/website-builder') }}" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="normal-field" class="col-sm-5 control-label">Choose niche for your website:</label>
                            <div class="col-sm-6">
                                 <select name="niche" class="form-control">
                                    <option value="Technology">Technology</option>
                                    <option value="Gaming">Gaming</option>
                                    <option value="Health">Health</option>
                                    <option value="Sport">Sport</option>
                                </select>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="normal-field" class="col-sm-5 control-label">Do you have FTP creditinals and domain name? :</label>
                            <div class="col-sm-6">
                                <div class="checkbox">
                                    <input id="checkbox1" type="checkbox" name="news_pinned">
                                    <label for="checkbox1">
                                    Yes
                                    </label>
                                </div>
                            </div>
                    </div>
                    <div id="ftpHost" style="display: none;background:#f4f4f4; padding:20px; margin-top:30px;margin-bottom: 5px;">
                        <p>In order that our technician access your website server, we need you to provide us with following information's. Keep in mind that this is only if you already have domain name where you want us to setup the website.</p>
                            
                        <div class="form-group">
                            <label for="normal-field" class="col-sm-4 control-label">Domain name:</label>
                                <div class="col-sm-7">
                                    <input type="text" name="domain" class="form-control" value="" placeholder="http://www.example.com">
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="normal-field" class="col-sm-4 control-label">FTP address:</label>
                                <div class="col-sm-7">
                                    <input type="text" name="ftp_address" class="form-control" value="" placeholder="ftp.example.com">
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="normal-field" class="col-sm-4 control-label">FTP username:</label>
                                <div class="col-sm-7">
                                    <input type="text" name="ftp_username" class="form-control" value="" placeholder="username">
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="normal-field" class="col-sm-4 control-label">FTP password:</label>
                                <div class="col-sm-7">
                                    <input type="text" name="ftp_password" class="form-control" value="" placeholder="password">
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="hint-field" class="col-sm-4 control-label">
                                FTP port:
                                <span class="help-block">(optional)</span>
                            </label>
                            <div class="col-sm-7">
                                <input type="text" name="ftp_port" class="form-control" value="" placeholder="21">
                            </div>
                        </div>
                            
                        <div class="form-group">
                            <label for="normal-field" class="col-sm-4 control-label">Anything else?:</label>
                            <div class="col-sm-7">
                                <textarea name="ftp_more" cols="4" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="normal-field" class="col-sm-5 control-label"></label>
                            <div class="col-sm-6">
                                <button class="btn btn-success btn-large" name="processBuilder"><i class="glyphicon glyphicon-ok"></i> Send Order</button>
                            </div>
                    </div>
                </form>
                <div class="widget-body" style="text-align:center">
                    Have a question? <i class="glyphicon glyphicon-chevron-right"></i> <a href="{{ url('/dashboard/useful-services/website-builder/faq') }}">VIEW FAQS</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('page_script')
<script>
    $(function(){ 
        $('#checkbox1').change(function () {
          $('#ftpHost').fadeToggle();
        });
    });
</script>
@endsection