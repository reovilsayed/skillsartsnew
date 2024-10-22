@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-dark">{{ __('تأكيد كلمة السر') }}</div>
                <div class="card-body">
                    {{ __('يرجى التأكد من كلمة السر قبل الإستمرار') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right text-dark">{{ __('كلمة السر') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror bg-white text-dark" name="password" required autocomplete="current-password">

                                @error('كلمة السر')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-inline">
                                    {{ __('تأكيد كلمة السر') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-outline" href="{{ route('password.request') }}">
                                        {{ __('هل نسيت كلمة السر؟') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
