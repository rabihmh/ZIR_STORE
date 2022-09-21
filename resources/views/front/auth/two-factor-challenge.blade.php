<x-front-layout title="2FA challenge">
    <!-- Start 2FA challenge Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" method="POST" action="{{ route('two-factor.login') }}">
                        @csrf

                        <div class="card-body">
                            <div class="title">
                                <h3>2FA Challenge</h3>
                                <p>
                                    You can must enter 2FA code
                                </p>
                            </div>
                            <div class="form-group input-group">
                                <label for="reg-fn">2FA code</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="reg-pass"
                                    name="code"
                                />
                                @if($errors->has('code')))
                                <div class="alert alert-danger mx-auto">
                                    {{$errors->first('code')}}
                                </div>
                                @endif

                            </div>
                            <div class="form-group input-group">
                                <label for="reg-fn">2FA code</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="reg-pass"
                                    name="recovery_code"
                                />
                                @if($errors->has('recovery_code')))
                                <div class="alert alert-danger mx-auto">
                                    {{$errors->first('recovery_code')}}
                                </div>
                                @endif

                            </div>

                            <div class="button">
                                <button class="btn" type="submit">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Start  2FA challenge Area -->
</x-front-layout>
