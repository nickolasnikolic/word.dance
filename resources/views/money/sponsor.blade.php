@extends('layout.layout')

@section('content')
<div class="wrapper"
id="banner">
<div class="inner">
<div class="row">
    <a class="button pay col-12">Confirmation: are you sure?</a>
<a href="{{url()->previous()}}" class="button pay col-12">Cancel</a>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    $(document).ready(function(){
        $('.button').click(function(){
            var stripe = Stripe('{{env('STRIPE_KEY')}}', { stripeAccount: '{{ $poet->stripe_uid }}' });
            stripe.redirectToCheckout({
            // Make the id field from the Checkout Session creation API response
            // available to this file, so you can provide it as parameter here
            // instead of the {{--CHECKOUT_SESSION_ID--}} placeholder.
            sessionId: "{{ $paymentsession->id }}"
            }).then(function (result) {
            // If `redirectToCheckout` fails due to a browser or network
            // error, display the localized error message to your customer
            // using `result.error.message`.
        });
    });
});
    </script>
</div>
</div>
</div>
@endsection
