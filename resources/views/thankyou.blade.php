@extends('layouts.app')
@section('title','Thank you')
@section('content')

<div class="container my-5">
   <div class="row">
       <div class="col-md-12 text-center">
			<div class="thanks">
				<i class="fa fa-check-circle fa-5x" style="color:#ff3131"></i>
				<h2 class="text-light">{{ __('sentence.thank_you') }}<br>{{ __('sentence.thenk_you_title') }}</h2>
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
