@extends('layouts.guest')

@section('content')
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    {{-- <h4 class="text-center mb-4"></h4> --}}
                                    @include('_partial._flash-message')
                                    <h4 class="text-center mb-3">Connectez-vous</h4>
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label class="text-black" placeholder="example@gmail.com"><strong>Email</strong></label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="text-black" placeholder="password">Password</strong></label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                                <div class="form-check ml-2">
                                                    <input class="form-check-input" type="checkbox" id="basic_checkbox_1">
                                                    <label class="form-check-label" for="basic_checkbox_1"> Se souvenir de moi</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <a href="{{ route('password.request') }}">Mot de passe oublié?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                {{ __('se connecter') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
