@extends('layout.layout')

@section('content')

<!-- About -->
<div class="wrapper"
id="banner">
<div class="inner">
<div class="content">
        <h1>What is word.dance?</h1>
<p>Word.dance is a poetry publishing platform where you can earn money licensing your work in poetry.</p>
<p><a href="{{route('register')}}">Register</a> to add your own poetry then connect your accounts in your profile and earn!</p>
<p>More on the way!</p>
<div>
    {{--section for advertising--}}
</div>
</div>
</div>
</div>

<section class="wrapper random-poem style1">
<div class="inner">
    @isset($lastpoems)
    <div class="features">
            @isset($randompoem->id)
            <article class="featured-poet column is-3-fifths">
                <h2 class="title is-lowercase is-size-4">from our collection:</h2>
                    <h3><a href="{{route('poem-individual', $randompoem->id)}}"> <i class="i icon-quill"></i> {{$randompoem->title}}</a></h3>
                    <p class=""><strong>by: </strong> {{$randompoem->name}}</p>
                    <pre class="is-flex-touch is-size-5">{{$randompoem->poem}}</pre>
                    <p> <strong>Meaning: </strong> {{$randompoem->meaning}}</p>
            </article>
            @endisset
@endisset
</div>
</div>
</section>

<section class="wrapper new-poetry style2">
<div class="inner">
    @isset($lastpoems)
    <h1>new poetry:</h1>
    <hr />
    <div class="features">
@foreach ($lastpoems as $poem)
    <div class="feature">
        <h2><a href="{{route('poem-individual', $poem->id)}}"> <i class="i icon-quill"></i>  {{$poem->title}}</a></h2>
        <p class=""><strong>by: </strong> {{$poem->name}}</p>
        <p class="li is-small new-poetry">{{$poem->meaning}}</p>
    </div>
@endforeach
@endisset
</div>
</div>
</section>

<section class="wrapper new-poets style1"
id="two">
<div class="inner">
    @isset($lastpoets)
    <h1>new poets:</h1>
    <hr />
    <div class="features">
@foreach ($lastpoets as $poet)
    <div class="feature">
        <h2><a href="{{route('poet-individual', $poet->id)}}"> <i class="i icon-user"></i>  {{$poet->name}}</a></h2>
        <p class="li is-small new-poetry">{{$poet->bio}}</p>
    </div>
@endforeach
@endisset
</div>
</div>
</section>


<section class="wrapper new-poets style1"
id="two">
<div class="inner">
        @isset($lastgenre)
        <div class="section">
            <h2>new genre</h2>
            @foreach ($lastgenre as $genre)
            <a class="tag" href="{{route('genre-show', $genre->name)}}"> <i class="i icon-link"></i>  {{$genre->name}}</a>
            @endforeach
        </div>
        @endisset
    </div>
</div>
</section>
</section>
@endsection
