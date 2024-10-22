@component('mail::message')
<h1 class="heading-text">NEW CONTACT SUBMISSION FROM VIRALSNARE</h1>

 <span class="title-text">Name</span>
 <span class="value-text">{{$contact->name}}</span> <br>

 <span class="title-text">Email</span>
 <span class="value-text">{{$contact->email}}</span> <br>

 <span class="title-text">Website</span>
 <span class="value-text">{{$contact->website}}</span> <br>

 <span class="title-text">Subject</span>
 <span class="value-text">{{$contact->subject}}</span> <br>

 <span class="title-text">Message</span>
 <span class="value-text">{{$contact->message}}</span> <br>
@endcomponent