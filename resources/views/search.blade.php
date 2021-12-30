@extends('layout.layout')

@section('content')
<!-- Main -->
<div id="main" class="search wrapper style1">
<div class="inner">
    <header class="major">
        <h1>search</h1>
    </header>
    <form method="get" action="{{route('search-results')}}">
        <input class="input" type="text" name="search" placeholder="Search" />
        <button class="button btn">Search</button>
    </form>
</div>
</div>
</div>

@endsection
