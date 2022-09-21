<x-front-layout title="Two Factor Authentication">
    <!-- Start 2FA Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" method="POST" action="{{ route('two-factor.enable') }}">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>Two Factor Authentication</h3>
                                <p>
                                    You can enable/disable 2FA.
                                </p>
                            </div>
                            @if(session('status')=='two-factor-authentication-enabled')
                                <div class="mb-4 font-medium text-sm">
                                    Please finish configuration two factor authentication below
                                </div>
                            @endif
                            <div class="button">
                                @if(!$user->two_factor_secret)
                                    <button class="btn" type="submit">Enable</button>
                                @else
                                    <div class="text-center">
                                        {!!$user->twoFactorQrCodeSvg()!!}
                                        <h3>Recovery code</h3>
                                        <ul>
                                            @foreach($user->recoveryCodes() as $code)
                                                <li>{{$code}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @method('delete')
                                    <button class="btn btn-danger mt-2" type="submit">Disable</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Start 2FA Area -->
</x-front-layout>
