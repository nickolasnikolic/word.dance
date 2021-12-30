@extends('layout.layout')

@section('content')
<div class="wrapper"
id="banner">
<div class="inner">
<div class="row">

<h3>You are now a sponsor! Thank you on behalf of the poet!!!</h3>
<p>Your money travels through Stripe Payment Servece and then on to the poet directly. 
    If in the future you would like to cancel your sponsorhip, please contact the poet at:</p>
<h3>{{ $poet->email }}</h3>
<p>You will want to print this page for your records: <br />
${{$sponsorship->pledge}} Monthly Sponsorship to {{$poet->name}} <br />
The sponsorship has the Unique Stripe Plan ID# {{$sponsorship->stripe_plan}}</p>

</div>
</div>
</div>
@endsection
