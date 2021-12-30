@extends('layout.layout')

@section('content')

<section class="wrapper style1"
id="three">
<div class="inner">
<div class="box">

<div class="tags push-down-desktop">
    <ul class="actions features">
    @forelse ($genres as $genre)
<li class="col-2 col-12-small"><a class="button" href="{{route('genre-show', $genre->name)}}" ><i class="i icon-link"></i> {{$genre->name}} </a></li>
    @empty
<h2>no genre to display</h2>
    </ul>
    @endforelse
</div>


</div>
</div>
</section>
@endsection
