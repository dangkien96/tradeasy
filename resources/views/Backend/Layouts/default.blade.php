<!DOCTYPE html>
<html>
    <head>
        <title> 頂手,頂讓,生意轉讓,生意買賣,轉讓,業務轉讓,創業顧問,創業商機,旺鋪頂手 </title>
        <link rel="icon" href="{{ url('Frontend/img/logo_title1.png') }}" type="image/gif" sizes="32x32">
        <script>
            var SiteUrl = '{{url("/")}}';
        </script>
        @includeif ('Backend.Layouts._css_default')
        @includeif ('Backend.Layouts._css')
        @yield('myCss')
        @includeif ('Backend.Layouts._angular')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
    </head>
    <body ng-app="ngApp" ng-cloak class="nifty-ready pace-done">
        <div id="container" class="effect mainnav-lg">
            <div class="boxed">
                @includeif ('Backend.Layouts._header')

                @yield('content')

                @includeif ('Backend.Layouts._menu')
             </div>
            @includeif ('Backend.Layouts._js_default')
            @includeif ('Backend.Layouts._js')
            @yield('myJs')
            @includeif ('Backend.Layouts._footer')
        </div>
    </body>
</html>
