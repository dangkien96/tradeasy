<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8>
        <title> @yield('title') </title>
        @yield('meta')
        <link rel="icon" href="{{ url('Frontend/img/logo_title1.png') }}" type="image/gif" sizes="32x32">
        <script>
            var SiteUrl = '{{url("/")}}';
        </script>
        @includeif ('Frontend.Layouts._css_default')
        @includeif ('Frontend.Layouts._css')
        @yield('myCss')
        @includeif ('Frontend.Layouts._angular')
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body ng-app="ngApp" ng-cloak>
        <div class="preloader">
            <div class="preloader-wrapper">
                <div class="sk-cube-grid">
                    <div class="sk-cube sk-cube1"></div>
                    <div class="sk-cube sk-cube2"></div>
                    <div class="sk-cube sk-cube3"></div>
                    <div class="sk-cube sk-cube4"></div>
                    <div class="sk-cube sk-cube5"></div>
                    <div class="sk-cube sk-cube6"></div>
                    <div class="sk-cube sk-cube7"></div>
                    <div class="sk-cube sk-cube8"></div>
                    <div class="sk-cube sk-cube9"></div>
                </div>
            </div>
        </div>
        <div class="main-wrapper">
            <div class="main-content-wrapper">
                @includeif ('Frontend.Layouts._header')
                @yield('slide')
                @yield('content')

                @includeif ('Frontend.Layouts._menu')
                
                @includeif ('Frontend.Layouts._footer')
            </div>
            @includeif ('Frontend.Layouts._js_default')
            @includeif ('Frontend.Layouts._js')
            @yield('myJs')
           
        </div>
    </body>
</html>
