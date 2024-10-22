@extends('layouts.app')
@section('title', 'Subscription')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h1>الدفع</h1>

        @if (session()->has('success'))
          <p><strong>{{ session()->get('success') }}</strong></p>
        @endif

        <form method="POST" action="#" id="subscription-form" data-secret="{{ $intent->client_secret }}">
          @csrf

          <div id="card-element"></div>
          <div id="card-errors"></div>

          <button class="btn btn-primary btn-lg" id="card-button" type="submit">كامل الطلب</button>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('javascript')
  <script src="https://js.stripe.com/v3/"></script>

  <script>
    const stripe = Stripe('{{ config('cashier.key') }}');

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');

    const form = document.getElementById('subscription-form');
    const clientSecret = form.dataset.secret;

    form.addEventListener('submit', (e) => {
      event.preventDefault();

      createToken();
    });

    async function createToken() {
      const {
        setupIntent,
        error
      } = await stripe.confirmCardSetup(
        clientSecret, {
          payment_method: {
            card: cardElement,
          }
        }
      );

      if (error) {
        // Display "error.message" to the user...
      } else {
        stripeTokenHandler(setupIntent);
      }
    }

    function stripeTokenHandler(setupIntent) {
      const hiddenInput = document.createElement('input');
      hiddenInput.setAttribute('type', 'hidden');
      hiddenInput.setAttribute('name', 'paymentMethod');
      hiddenInput.setAttribute('value', setupIntent.payment_method);
      form.appendChild(hiddenInput);

      form.submit();
    }

  </script>
@endsection
