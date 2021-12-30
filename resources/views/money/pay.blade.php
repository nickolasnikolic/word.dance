@extends('layout.layout')

@section('content')
<div class="wrapper"
id="banner">
<div class="inner">
<div class="content">
    <a class="button pay">Confirmation: are you sure?</a>

<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    $(document).ready(function(){
        $('.button').click(function(){
            var stripe = Stripe('pk_test_EgOVhA73kWneBSm545s5iCQe00IOMcJobz', {stripeAccount: '{{ $poem->user->stripe_uid }}' });
            stripe.redirectToCheckout({
            // Make the id field from the Checkout Session creation API response
            // available to this file, so you can provide it as parameter here
            // instead of the {{--CHECKOUT_SESSION_ID--}} placeholder.
            sessionId: "{{ $paymentsession->id }}"
            }).then(function (result) {
            // If `redirectToCheckout` fails due to a browser or network
            // error, display the localized error message to your customer
            // using `result.error.message`.
            console.log(result);
            //redirect with poem id to the success page in new wondow:
            });
        });
    });
    </script>
</div>
</div>
</div>
@endsection
