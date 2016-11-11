<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Панель управления | Basar</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="/cms-templates/login-register-forms/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/cms-templates/login-register-forms/assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/cms-templates/login-register-forms/assets/css/form-elements.css">
    <link rel="stylesheet" href="/cms-templates/login-register-forms/assets/css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="/cms-templates/login-register-forms/assets/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/cms-templates/login-register-forms/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/cms-templates/login-register-forms/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/cms-templates/login-register-forms/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/cms-templates/login-register-forms/assets/ico/apple-touch-icon-57-precomposed.png">

</head>

<body>

<!-- Top content -->
<div class="top-content">

    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1><strong>Панель управления</strong> {{--Login &amp; Register Forms--}}</h1>
                    <div class="description"></div>
                </div>
            </div>

            @yield('content')

        </div>

    </div>
</div>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">

            <div class="col-sm-8 col-sm-offset-2">
                <div class="footer-border"></div>
                <p>Сделано командой <a href="http://qube.kz" target="_blank"><strong>Qube.kz</strong></a> <i class="fa fa-smile-o"></i></p>
            </div>

        </div>
    </div>
</footer>

<!-- Javascript -->
<script src="/cms-templates/login-register-forms/assets/js/jquery-1.11.1.min.js"></script>
<script src="/cms-templates/login-register-forms/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="/cms-templates/login-register-forms/assets/js/jquery.backstretch.min.js"></script>
<script src="/cms-templates/login-register-forms/assets/js/scripts.js"></script>

<!--[if lt IE 10]>
<script src="/cms-templates/login-register-forms/assets/js/placeholder.js"></script>
<![endif]-->

</body>

</html>