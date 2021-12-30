
<div class="section">
    @isset($lastpoets)
    <div class="section">
        <h2>new poets</h2>
        @foreach ($lastpoets as $poet)
            <a href="{{route('poet', $poet->id)}}">{{$poet->name}}</a>
        @endforeach
    </div>
    @endisset
    @isset($lastpoems)
    <div class="section">
        <h2>new poetry</h2>
        @foreach ($lastpoems as $poem)
    <a href="{{route('poem', $poem->id)}}">{{$poem->title}}</a>
        @endforeach
    </div>
    @endisset
    @isset($lastgenre)
    <div class="section">
        <h2>new genre</h2>
        @foreach ($lastgenre as $genre)
            <a href="{{route('genre', $genre->id)}}">{{$genre->genre}}</a>
        @endforeach
    </div>
    @endisset
</div>

