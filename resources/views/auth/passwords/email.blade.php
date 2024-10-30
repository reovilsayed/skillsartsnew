@extends('layouts.app')
@section('css')
    @if (App::getLocale() == 'en')
        <style>
            .recover_password {
                text-align: left
            }
        </style>
    @endif
@endsection
@section('content')
<div @if (App::getLocale() == 'en') dir="ltr" @else dir="rtl" @endif class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark" style="">
                <div class="card-header recover_password">{{ __('sentence.recover_password') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('sentence.email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 recover_password">
                                <button type="submit" class="btn btn-red">
                                    {{ __('sentence.send_password_recovery_link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
