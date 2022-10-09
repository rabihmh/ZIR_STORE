<!--
{{--<x-guest-layout>--}}
{{--    <x-auth-card>--}}
{{--        <x-slot name="logo">--}}
{{--            <a href="/">--}}
{{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--            </a>--}}
{{--        </x-slot>--}}

{{--        <!-- Session Status -->--}}
{{--        <x-auth-session-status class="mb-4" :status="session('status')" />--}}

{{--        <!-- Validation Errors -->--}}
{{--        <x-auth-validation-errors class="mb-4" :errors="$errors" />--}}

{{--        <form method="POST" action="{{ route('login') }}">--}}
{{--            @csrf--}}

{{--            <!-- Email Address -->--}}
{{--            <div>--}}
{{--                <x-label for="email" :value="__('Email')" />--}}

{{--                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />--}}
{{--            </div>--}}

{{--            <!-- Password -->--}}
{{--            <div class="mt-4">--}}
{{--                <x-label for="password" :value="__('Password')" />--}}

{{--                <x-input id="password" class="block mt-1 w-full"--}}
{{--                                type="password"--}}
{{--                                name="password"--}}
{{--                                required autocomplete="current-password" />--}}
{{--            </div>--}}

{{--            <!-- Remember Me -->--}}
{{--            <div class="block mt-4">--}}
{{--                <label for="remember_me" class="inline-flex items-center">--}}
{{--                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">--}}
{{--                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--                </label>--}}
{{--            </div>--}}

{{--            <div class="flex items-center justify-end mt-4">--}}
{{--                @if (Route::has('password.request'))--}}
{{--                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">--}}
{{--                        {{ __('Forgot your password?') }}--}}
{{--                    </a>--}}
{{--                @endif--}}

{{--                <x-button class="ml-3">--}}
{{--                    {{ __('Log in') }}--}}
{{--                </x-button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </x-auth-card>--}}
{{--</x-guest-layout>--}}
-->
<x-front-layout title="Login">
    <x-slot:breadcrumbs>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Login</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{route('home')}}"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href=""><i class="lni lni-cart"></i>Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </x-slot:breadcrumbs>
    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="card-body">
                            <div class="title">
                                <h3>Login Now</h3>
                                <p>
                                    You can login using your social media account or email
                                    address.
                                </p>
                            </div>
                            <div class="social-login">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <a class="btn facebook-btn" href="{{route('auth.social.login.redirect','facebook')}}"
                                        ><i class="lni lni-facebook-filled"></i> Facebook
                                            login</a
                                        >
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <a class="btn twitter-btn" href="javascript:void(0)"
                                        ><i class="lni lni-twitter-original"></i> Twitter
                                            login</a
                                        >
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <a class="btn google-btn" href="{{route('auth.social.login.redirect','google')}}"
                                        ><i class="lni lni-google"></i> Google login</a
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="alt-option">
                                <span>Or</span>
                            </div>
                            <div class="form-group input-group">
                                <label for="reg-fn">Email</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="reg-email"
                                    required
                                    name="{{Config::get('fortify.username')}}"
                                />
                                @if($errors->has(Config::get('fortify.username')))
                                    <div class="alert alert-danger">
                                        {{$errors->first(Config::get('fortify.username'))}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group input-group">
                                <label for="reg-fn">Password</label>
                                <input
                                    class="form-control"
                                    type="password"
                                    id="reg-pass"
                                    required
                                    name="password"
                                />
                                @if($errors->has('password'))
                                    )
                                    <div class="alert alert-danger mx-auto">
                                        {{$errors->first('password')}}
                                    </div>
                                @endif
                            </div>
                            <div
                                class="d-flex flex-wrap justify-content-between bottom-content"
                            >
                                <div class="form-check">
                                    <input
                                        type="checkbox"
                                        class="form-check-input width-auto"
                                        id="exampleCheck1"
                                        name="remember" value="1"
                                    />
                                    <label class="form-check-label">Remember me</label>
                                </div>
                                @if(Route::has('password.request'))
                                    <a class="lost-pass" href="{{route('password.request')}}"
                                    >Forgot password?</a>
                                @endif
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">Login</button>
                            </div>
                            @if(Route::has('register'))
                                <p class="outer-link">
                                    Don't have an account?
                                    <a href="{{route('register')}}">Register here </a>
                                </p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Account Login Area -->
</x-front-layout>
