@component('mail::message')
<h1>السلام عليكم</h1>
<p>{!! $data->body !!}</p>

@component('mail::button', ['url' => $data->button_link])
{{$data->button_text}}
@endcomponent

شكراً لإستخدام موقع سكيلز آرتس<br>
{{ config('app.name') }}
@endcomponent
