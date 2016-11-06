<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dodolan Desain</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/fonts.css')}}" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" type="x-icon" href="{{asset('assets/img/logo.png')}}">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway-Thin', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                font-family: Montserrat ;
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .welcome-logo{
                max-width : 150px ;
                margin : 0 ;
                padding : 0 ;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Register</a>
                </div>
            @endif

            <div class="content">
                <p><img src="{{asset('assets/img/logo.png')}}" class="welcome-logo"></p>
                <div class="title m-b-md">
                    Dodolan Desain
                </div>

                <div class="links">
                    <a href="#">Home</a>
                    <a href="#">Gallery</a>
                    <a href="#">How it works</a>
                    <a href="#">Order</a>
                    <a href="https://github.com/asharimh97/dodolan">Documentation</a>
                </div>
            </div>
        </div>
    </body>
</html>
