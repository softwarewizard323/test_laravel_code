<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ExpressVisits - Working On Site</title>
    {{ Html::style('include/style/css/application.min.css') }}
    <!-- as of IE9 cannot parse css files with more that 4K classes separating in two files -->
    <!--[if IE 9]>
    {{ Html::style('include/style/css/application-ie9-part2.css') }}
    <![endif]-->
    <link rel="shortcut icon" href="include/style/img/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
</head>
<body class="error-page">
    <div class="container">
        <main id="content" class="error-container" role="main">
            <div class="row">
                <div class="col-lg-4 col-sm-6 col-xs-10 col-lg-offset-4 col-sm-offset-3 col-xs-offset-1">
                    <div class="error-container">
                        <h2>Site Under Maintenance</h2>
                        <p class="error-info">We are working on it! Please come back later ;)</p>
                        <a href="{{ url('/dashboard') }}" class="btn btn-inverse">Check again</a>
                        <a href="{{ url('/logout') }}" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </main>
        <footer class="page-footer">
            <p>&copy; Copyright <?php echo date('Y'); ?>  |  All rights reserved<br>
                <small>made by <a href="{{ url('/') }}">ExpressVisits</a> - <span class="">Premium Traffic Provider</span></small>
            </p>
        </footer>
    </div>
</body>
</html>