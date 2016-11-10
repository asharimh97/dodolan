<!DOCTYPE html>
<html>
    <head>
        <title>Dodolan Design - Page Not Found</title>

        <!-- <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css"> -->
        <style type="text/css" href="{{asset('assets/css/app.css')}}"></style>
        <style type="text/css" href="{{asset('assets/css/style.css')}}"></style>
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 120px;
            }

            .subtitle{
                font-size : 30px ;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">404</div>
                <div>
                    <p class="subtitle">Page Not Found</p>
                    <p>Lost buddy? <a href="{{ url('/') }}">Back to home</a>.</p>
                </div>
            </div>
        </div>
    </body>
</html>
