<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="canonical" href="{{route('home')}}" />

        <title>Laravel</title>

        

        <meta name="theme-color" content="#e9646c">
        <link rel="manifest" href="{{secure_asset('manifest.json')}}">

        <link href="{{secure_asset('/css/app.css')}}" rel="stylesheet" type="text/css">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
    </head>
    <body>
        <div id="app">

        @include('partials/navigation')

            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="content col-sm-6 col-sm-offset-3 col-md-5 col-md-offset-4">
                            <picker list="{{$clients}}"></picker>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('partials/footer')

        <script src="{{secure_asset('/js/app.js')}}"></script>
    </body>
</html>
