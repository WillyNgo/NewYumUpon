<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="/js/geo.js"></script>
        <title>YumUpon</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
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


        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Manage my restos</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                  <img src="/img/logo_egg.png" alt="Logo" >
                </div>

                <!-- Geolocation if user does not share location -->
                <form action="/geo" method="POST" class="form-horizontal" id="hiddenForm" style="visibility: hidden">
                {{ csrf_field() }}
                <!-- Postal code -->
                    <div class="form-group">
                        <label for="postal" class="col-sm-3" style="color: red">Please enter a postal code:</label>
                        <div class="col-sm-6">
                            <input type="text" name="postal" id="postal" class="form-control" value="{{ old('postal') }}">
                        </div>
                    </div>
                    <!-- all the hidden fields -->
                    <input type="hidden" name="latitude"/>
                    <input type="hidden" name="longitude"/>
                    <input type="hidden" name="error"/>
                    <!-- submit Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-btn fa-plus"></i>Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
