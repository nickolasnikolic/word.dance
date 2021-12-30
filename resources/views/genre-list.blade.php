@extends('layout.layout')
@section('content')

<section class="wrapper style1"
id="three">
<div class="inner">
<div class="box cta">
<div class="content-broad-desktop content">

<div class="row">

<h2 class="row clear-fix">Poetry in Genre: <i class="i icon-link"></i>{{$genre}}</h2>
    @forelse ($poetry as $poem)

    <div class="col-4 col-12-small">
            <div class="column is-full is-one-third-fullhd">

<article class="column mobile-width">
<h2 class="title"><a href="{{route('poem-individual', $poem->id )}}"><i class="i icon-quill"></i> {{$poem->title}}</a></h2>
<p class="meaning"><strong>Meaning:</strong> {{$poem->meaning}}</p>
</article>
    @empty
<h2>no poems to display</h2>

            </div>
    </div>
    @endforelse
</div>

</div>
</div>

</section>
</div>


    @endsection
