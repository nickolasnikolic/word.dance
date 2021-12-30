@extends('layout.layout')

@section('content')

<div id="main" class="wrapper style1">
    <div class="inner">
        <header class="major">
            <h1>Poet Profile</h1>
        </header>

<div class="content push-down">
<p><strong>Name:</strong> {{$poet->name}}@empty($poet->name) This poet has elected to remain anonymous. @endempty</p>
<p><strong>Bio:</strong>  {{$poet->bio}}  @empty($poet->bio) This poet has elected to submit no bio. @endempty</p>
<hr />

{{--
@isset($poet->stripe_uid)
<div class="sponsorship row">
    <a class="button col-4" href="{{route('sponsor', ['poet'=> $poet->id, 'amount'=> 10])}}">Sponsor @ <strong>$10 per month</strong></a><br />
    <a class="button col-4" href="{{route('sponsor', ['poet'=> $poet->id, 'amount'=> 20])}}">Sponsor @ <strong>$20 per month</strong></a><br />
    <a class="button col-4" href="{{route('sponsor', ['poet'=> $poet->id, 'amount'=> 50])}}">Sponsor @ <strong>$50 per month</strong></a><br />
    <a class="button col-4" href="{{route('sponsor', ['poet'=> $poet->id, 'amount'=> 100])}}">Sponsor @ <strong>$100 per month</strong></a><br />
    <a class="button col-4" href="{{route('sponsor', ['poet'=> $poet->id, 'amount'=> 250])}}">Sponsor @ <strong>$250 per month</strong></a><br />
    <a class="button col-4" href="{{route('sponsor', ['poet'=> $poet->id, 'amount'=> 1000])}}">Sponsor @ <strong>$1000 per month</strong></a>
 </div>
 <hr />
 @endisset
--}}

<h3>This poet's work on word.dance:</h3>
@foreach ($poems as $poem)

<p><a href="{{route('poem-individual', $poem->id) }}"><strong>{{$loop->index + 1}}.</strong> {{$poem->title}}</a></p>
@endforeach
@empty($poems)
<p>This poet has yet to submit work.</p>
@endempty
</div>

</div>
</div>

@endsection
