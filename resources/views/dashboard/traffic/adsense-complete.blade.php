@extends('dashboard.layouts.app')

@section('content')

    {{ Html::script('http://code.jquery.com/jquery-latest.js') }}
    <style>
        .container {
            margin-bottom: 50px;
            width: 600px;
        }
    </style>
    <!-- Main window -->
    <div class="main_container">
        <br>
        <div class="row-fluid">
            <div class="widget widget-padding span9" id="wizard">
                <div class="wizard">
                    <ul class="steps">
                        <li data-target="#step1" class="complete"><span class="badge badge-success">1</span>Step 1<span
                                    class="chevron"></span></li>
                        <li data-target="#step2" class="complete"><span class="badge badge-success">2</span>Step 2<span
                                    class="chevron"></span></li>
                        <li data-target="#step3" class="complete"><span class="badge badge-success">3</span>Step 3<span
                                    class="chevron"></span></li>
                        <li data-target="#step4" class="active"><span class="badge badge-info">4</span>Step 4<span
                                    class="chevron"></span></li>
                    </ul>
                </div>

                <div class="widget-body" style="height:auto;overflow:auto;text-align:center;">

                    <div style="text-align:center;color:#666;margin:10px 0 25px 35px;padding-bottom:5px;border-bottom:solid 1px #DDD;"
                         class="span11">
                        <p style="font-size:28px;">Order Completed</p>
                        <p>Please wait for few seconds until our system process your order.</p>
                    </div>

                    <div class="container" style="clear: both">
                        <div class="progress progress-striped progress-danger active">
                            <div class="bar" style="width: 0%;"></div>
                        </div>
                    </div>

                    <div class="messagePost" style="width:100%;margin-bottom:20px;color:#999;display:none;">
                        Order added in your campaign list and waiting moderator approval.
                    </div>

                    <script>
                        var progress = setInterval(function() {
                            var $bar = $('.bar');
                            if ($bar.width() >= 600) {
                                clearInterval(progress);
                                $('.progress').removeClass('active');
                                window.location = "{{ url('/dashboard') }}";
                            } else {
                                $bar.width($bar.width()+50);
                            }
                            //$bar.text(Math.ceil($bar.width()/6) + "%");
                        }, 800);

                        //Show message after 9 seconds
                        $(document).ready(function() {
                            $(".messagePost").delay(5000).fadeIn(500);
                        });
                    </script>
                </div>
            </div>
        </div>
    </div> <!-- /Main window -->

@endsection
