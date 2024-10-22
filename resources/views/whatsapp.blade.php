@extends('layouts.app')
@section('title','Thank you')
@section('content')

<div class="container my-5">
   <div class="row justify-content-center">
       <div class="col-md-8">
        <div class="card bg-dark">
            <div class="card-header">
                شكراً لثقتك بنا وطلبك من متجرنا
            </div>
            <div class="card-body">
                سوف نقوم بالتواصل معك على الرقم  {{auth()->user()->phone}} قريبا.أو يمكنك الإتصال بنا على الرقم 00966593031810 وشكراً مرة أخرى
            </div>
        </div>
	   </div>
   </div>
</div>


@endsection
@section('javascript')
<script type="text/javascript">
$(document).ready(function() {

});
</script>

@endsection
