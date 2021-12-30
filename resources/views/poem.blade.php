@extends('layout.layout')

@section('content')

<section class="wrapper style1"
id="three">
<div class="inner">
<div class="box">
<div class="">

<div class="row">

<article class="">
<h2> <i class="i icon-quill"></i> {{$poem->title}}</h2>
<p class=""><strong>by: </strong> {{$poem->name}}</p>
<pre class="is-size-5">
{{$poem->poem}}
</pre>
<p class="genre"><strong>Genre: </strong> @forelse ($poem->tagNames() as $tag) <i class="i icon-link"></i> {{$tag}} @empty no genre @endforelse </p>
<p class="meaning"><strong>Meaning: </strong> {{$poem->meaning}}</p>
@auth

<div class="section pull-left">
    <a class="vote like button is-outline" id-of-record="{{$poem->id}}"><i class="i icon-heart"></i>kinda like</a>
    <a class="vote meh button is-outline" id-of-record="{{$poem->id}}"><i class="i icon-heart-broken"></i>kinda meh</a>
    <a class="vote hate button is-outline" id-of-record="{{$poem->id}}">This Poem is Hate Speech.</a>
</div>
</article>
@endauth

@isset($poem->suid)
    <form action="{{route('buy', $poem->id)}}">
    <button class="button pay">License this poem for <strong>${{$poem->price}}</strong></button>
@endisset



</div>
</div>
</div>
</div>
</section>

@endsection
