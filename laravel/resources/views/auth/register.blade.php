<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Boris-Register</title>
    <meta name="description" content="Buy Data || Buy Airtime $ ALl Bill Payment" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{url('https://app.borismobilemoney.com.ng/pk.png')}}">
    <link rel="icon" href="{{url('https://app.borismobilemoney.com.ng/pk.png')}}" type="image/x-icon">

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
                    <div class="auth-cover-img overlay-wrap" style="background-image:url(dist/img/bg1.jpg);">
                        <div class="auth-cover-info py-xl-0 pt-100 pb-50">
                            <div class="auth-cover-content w-xxl-75 w-sm-90 w-100">
                                <h1 class="display-3 text-white mb-20">Enjoy unlimited beautiful display content area</h1>
{{--                                <p class="text-white">The passage experienced a surge in popularity during the 1960s when Letraset used it on their dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their software.</p>--}}
                                <div class="play-wrap">
                                    <a class="play-btn" href="#"></a>
                                    <span>How it works ?</span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-overlay bg-trans-dark-50"></div>
                    </div>
                </div>
                <div class="col-xl-7 pa-0">
                    <div class="auth-form-wrap py-xl-0 py-50">
                        <div class="auth-form w-xxl-55 w-xl-75 w-sm-90 w-100">
                            <div class='alert alert-danger close'>
                                {{--                                <button type='button' class='close' data-dismiss='alert'>&times;</button>--}}
                                {{--                                <i class='fa fa-ban-circle'></i>--}}
                                <span class="text-danger"><x-jet-validation-errors class="mb-4" /></span>
                            </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h1 class="display-4 mb-10">Sign up for free</h1>
            <p class="mb-30">Create your account and start  today</p>
            <div class="form-row">
                <div class="col-md-6 form-group">
                <input id="name" class="form-control" type="text" name="name" placeholder="Fullname"    required autofocus autocomplete="name" />
                </div>
            <div class="col-md-6 form-group">
                <input id="username" class="form-control" type="text" name="username" placeholder="username"  required autofocus autocomplete="name" />
            </div>
            </div>

            <div class="form-group">
                <input id="email" class="form-control" type="email" name="email" placeholder="email"  required />
            </div>

            <div class="form-group">
                <input id="phone" class="form-control" type="number" name="phone" placeholder="phone-no"  required />
            </div>

            <div class="form-group">
                <input id="password" class="form-control" type="password" name="password" placeholder="password" required autocomplete="new-password" />
            </div>

            <div class="form-group">
                <input id="password_confirmation" class="form-control" type="password" placeholder="Confirmed-password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif


                <button class="btn btn-primary btn-block">
                    {{ __('Register') }}
                </button>
            <div class="option-sep">or</div>
            <div class="form-row">
                <div class="col-sm-6 mb-20">
                    <button class="btn btn-indigo btn-block btn-wth-icon"> <span class="icon-label"><i class="fa fa-facebook"></i> </span><span class="btn-text">Login with facebook</span></button>
                </div>
                <div class="col-sm-6 mb-20">
                    <button class="btn btn-sky btn-block btn-wth-icon"> <span class="icon-label"><i class="fa fa-twitter"></i> </span><span class="btn-text">Login with Twitter</span></button>
                </div>
            </div>
            <p class="text-center">Already have an account? <a href="{{route('login')}}">Sign In</a></p>
        </form>
{{--    </x-jet-authentication-card>--}}
{{--</x-guest-layout>--}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
