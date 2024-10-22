@extends('layouts.app')
@section('title','Verify')
@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-white">
                <div class="card-header">التحقق من عنوان البريد الإلكتروني</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            تم إرسال رابط تحقق جديد إلى عنوان بريدك الإلكتروني
                        </div>
                    @endif

                   قبل المتابعة ، يرجى الإطلاع على بريد الإلكتروني للضغط على رابط التفعيل
                    إذا لم تستلم البريد الإلكتروني
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">انقر هنا لإرسال رابط تفعيل جديد</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
