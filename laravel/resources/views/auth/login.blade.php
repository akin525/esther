<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Boris-LOgin</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('pk.png')}}">
    <link rel="icon" href="{{asset('pk.png')}}" type="image/x-icon">

    <!-- Custom CSS -->
    <link href="{{asset('dist/css/style.css')}}" rel="stylesheet" type="text/css">
</head>

<body>
<!-- Preloader -->
<div class="preloader-it">
    <div class="loader-pendulums"></div>
</div>
<!-- /Preloader -->

<!-- HK Wrapper -->
<div class="hk-wrapper">

    <!-- Main Content -->
    <div class="hk-pg-wrapper hk-auth-wrapper">
        <header class="d-flex justify-content-between align-items-center">
            <a class="d-flex auth-brand" href="#">
                <img class="brand-img" src="{{asset('pk.png')}}" alt="brand" />
            </a>
            <div class="btn-group btn-group-sm">
                <a href="#" class="btn btn-outline-secondary">Help</a>
                <a href="#" class="btn btn-outline-secondary">About Us</a>
            </div>
        </header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-5 pa-0">
                    <div id="owl_demo_1" class="owl-carousel dots-on-item owl-theme">
                        <div class="fadeOut item auth-cover-img overlay-wrap" style="background-image:url(dist/img/bg2.jpg);">
                            <div class="auth-cover-info py-xl-0 pt-100 pb-50">
                                <div class="auth-cover-content text-center w-xxl-75 w-sm-90 w-xs-100">
                                    <h1 class="display-3 text-white mb-20">Boris Mobile Money</h1>
                                    <p class="text-white">The purpose of lorem ipsum is to create a natural looking block of text (sentence, paragraph, page, etc.) that doesn't distract from the layout. Again during the 90s as desktop publishers bundled the text with their software.</p>
                                </div>
                            </div>
                            <div class="bg-overlay bg-trans-dark-50"></div>
                        </div>
                        <div class="fadeOut item auth-cover-img overlay-wrap" style="background-image:url(dist/img/bg1.jpg);">
                            <div class="auth-cover-info py-xl-0 pt-100 pb-50">
                                <div class="auth-cover-content text-center w-xxl-75 w-sm-90 w-xs-100">
                                    <h1 class="display-3 text-white mb-20">Boris Mobile Money</h1>
                                    <p class="text-white">The passage experienced a surge in popularity during the 1960s when Letraset used it on their dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their software.</p>
                                </div>
                            </div>
                            <div class="bg-overlay bg-trans-dark-50"></div>
                        </div>
                    </div>
                </div>
{{--        <x-slot name="logo">--}}
{{--            <x-jet-authentication-card-logo />--}}
{{--        </x-slot>--}}
                <div class="col-xl-7 pa-0">
                    <div class="auth-form-wrap py-xl-0 py-50">
                        <div class="auth-form w-xxl-55 w-xl-75 w-sm-90 w-xs-100">

                            <div class='alert alert-danger close'>
{{--                                <button type='button' class='close' data-dismiss='alert'>&times;</button>--}}
{{--                                <i class='fa fa-ban-circle'></i>--}}
                                <x-jet-validation-errors class="alert-danger" />
                            </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <h1 class="display-4 mb-10">Welcome Back</h1>
            <p class="mb-30">Sign in to your account and enjoy unlimited perks.</p>
            <div class="form-group">
                <input id="email" class="form-control" type="email" name="email" placeholder="Email-Address" :value="old('email')" required autofocus />
            </div>

            <div class="form-group">
                <div class="input-group">
                <input id="password" class="form-control" type="password" name="password" placeholder="Password" required autocomplete="current-password" />
                    <div class="input-group-append">
                        <span class="input-group-text"><span class="feather-icon"><i data-feather="eye-off"></i></span></span>
                    </div>
                </div>

                <div class="custom-control custom-checkbox mb-25">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

                <x-jet-button class="btn btn-primary btn-block">
                    {{ __('Log in') }}
                </x-jet-button>
                @if (Route::has('password.request'))
                    <p class="font-14 text-center mt-15" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </p>
                @endif
                <div class="option-sep">or</div>
                <div class="form-row">
                    <div class="col-sm-6 mb-20">
                        <button class="btn btn-indigo btn-block btn-wth-icon"> <span class="icon-label"><i class="fa fa-facebook"></i> </span><span class="btn-text">Login with facebook</span></button>
                    </div>
                    <div class="col-sm-6 mb-20">
                        <button class="btn btn-sky btn-block btn-wth-icon"> <span class="icon-label"><i class="fa fa-twitter"></i> </span><span class="btn-text">Login with Twitter</span></button>
                    </div>
                </div>
                <p class="text-center">Do have an account yet? <a href="{{route('register')}}">Sign Up</a></p>
        </form>
{{--    </x-jet-authentication-card>--}}
{{--</x-guest-layout>--}}

                        <!-- jQuery -->
                            <script src="{{asset('vendors4/jquery/dist/jquery.min.js')}}"></script>

                            <!-- Bootstrap Core JavaScript -->
                            <script src="{{asset('vendors4/popper.js/dist/umd/popper.min.js')}}"></script>
                            <script src="{{asset('vendors4/bootstrap/dist/js/bootstrap.min.js')}}"></script>

                            <!-- Slimscroll JavaScript -->
                            <script src="{{asset('dist/js/jquery.slimscroll.js')}}"></script>

                            <!-- Fancy Dropdown JS -->
                            <script src="{{asset('dist/js/dropdown-bootstrap-extended.js')}}"></script>

                            <!-- Owl JavaScript -->
                            <script src="{{asset('vendors4/owl.carousel/dist/owl.carousel.min.js')}}"></script>

                            <!-- FeatherIcons JavaScript -->
                            <script src="{{asset('dist/js/feather.min.js')}}"></script>

                            <!-- Init JavaScript -->
                            <script src="{{asset('dist/js/init.js')}}"></script>
                            <script src="{{asset('dist/js/login-data.js')}}"></script>
</body>


<!-- Mirrored from hencework.com/theme/mintos/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 28 Mar 2022 16:17:18 GMT -->
</html>
