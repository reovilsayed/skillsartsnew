@extends('layouts.app')
@section('title','Thank you')
@section('content')

<div class="container my-5">
   <div class="row justify-content-center">
       <div class="col-md-8">
        <div class="card bg-dark">
            <div class="card-header" @if (App::getLocale() == 'en') style="text-align: left" @endif>
                {{ __('sentence.whatsapp_heading') }}
            </div>
            <div class="card-body" @if (App::getLocale() == 'en') style="text-align: left" @endif>
                {{ __('sentence.whatsapp_title') }} {{auth()->user()->phone}} {{ __('sentence.whatsapp_title_one') }}
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
