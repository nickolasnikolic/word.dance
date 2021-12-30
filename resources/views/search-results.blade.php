@extends('layout.layout')

@section('content')
<div id="main" class="wrapper style1">
        <div class="inner">
            <header class="major">
                <h1>search</h1>
            </header>
<div class="search">
    <form method="get" action="{{route('search-results')}}">
        <input class="input" type="text" name="search" placeholder="Search" value="{{$search}}" />
        <button class="button is-light"><i class="i icon-search is-left"></i> Search</button>
    </form>
</div>

<h2 class="title is-lowercase"><strong>{{$poemCount}} Results in Poetry for search:</strong> {{$search}}</h2>
<ul>
    @forelse ($poetry as $poem)
    <li>

<h3 class="title"><a href="{{route('poem-individual', $poem->id)}}"><i class="i icon-quill"></i> {{$poem->title}}</a></h3>
<p><strong>Meaning:</strong> {{$poem->meaning}}</p>
    <p><strong>Genre:</strong> @forelse ($poem->tagNames() as $tag) <a class="tag" href="{{route('genre-show', $tag)}}">  <i class="i icon-link"></i>  {{$tag}}</a> @empty no genre @endforelse </p>
    </li>
    @empty
<h2>no poems to display</h2>
    @endforelse
</ul>
<hr />
<h2 class="title is-lowercase"><strong>{{$poetCount}} Results in Poets for search:</strong> {{$search}}</h2>
    @forelse ($poets as $poet)
<article class="column is-one-fifth">
<p class="title"><a href="{{route('poet-individual', $poet->id)}}"> {{$poet->name}}</a></p>
<ul>
    <h3><strong>poems for this poet:</strong></h3>
    @forelse ($poet->poems as $poem)
<li class="search-poets-poetry"><a href="{{route('poem-individual', $poem->id)}}"><i class="i icon-quill"></i> {{$poem->title}}</a></li>
    @empty
        <p>No poetry in records for this poet.</p>
    @endforelse
</ul>
<hr />
</article>
    @empty
<h2>no poets to display</h2>
    @endforelse
<hr />
    <h2><strong>Genre: </strong> @forelse ($tags as $tag)<a class="tag" href="{{route('genre-show', $tag->name)}}"> <i class="i icon-link"></i>  {{$tag->name}}</a> @empty no genre matches your search @endforelse </h2>
</div>
</div>
</div>
    @endsection

