<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel - ReactJS - Nifty 2.*</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link href="{{ url('Nifty') }}/css/nifty.min.css" rel="stylesheet">
        <!-- Nifty front awesome -->
        <link href="{{ url('Nifty/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <!-- Nifty datepicker -->
        <link href="{{ url('Nifty/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
        <script type="text/javascript">
            baseUrl = '{{ url("") }}';
            window.Laravel = {!! json_encode([
                'baseUrl' => url('/'),
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </head>
    <body>
        <div id="container" class="cls-container">
            <div id="bg-overlay"></div>
            <div class="cls-content">
                <div class="cls-content-sm panel">
                    <div class="panel-body" style="background-color: #fff">
                        <div class="mar-ver pad-btm">
                            <h1 class="h3">Account Login</h1>
                            <p>Sign In to your account</p>
                        </div>
                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            @csrf
                            <div class="form-group">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button class="btn btn-primary btn-lg btn-block" type="submit">{{ __('Login') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--jQuery [ REQUIRED ]-->
        <script src="{{ url('') }}/Nifty/js/jquery.min.js"></script>

        <!--BootstrapJS [ RECOMMENDED ]-->
        <script src="{{ url('') }}/Nifty/js/bootstrap.min.js"></script>
        <script src="{{ url('') }}/Nifty/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="{{ url('') }}/Nifty/plugins/momentjs/moment.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script src="{{ url('Nifty') }}/js/nifty.min.js"></script>
    </body>
</html>
