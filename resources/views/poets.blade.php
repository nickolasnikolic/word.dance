@extends('layout.layout')

@section('content')

<div id="main" class="wrapper style1">
    <div class="inner">
        <header class="major">
            <h1>Poets on word.dance</h1>
        </header>

<div class="container push-down-desktop push-down-mobile">
    <hr />
    <table class="table is-striped is-hoverable">
            <th class="th">poet name</td>
            <th class="th">total views</td>
            <th class="th">total likes</td>
            <th class="th"></td>
   @forelse ($poets as $poet)
        <tr class="tr">
            <td class="td">{{$poet->name}}</td>
            <td class="td">{{$poet->totalviews}}</td>
            <td class="td">{{$poet->totallikes}}</td>
            <td class="td"><a class="button" href="{{route('poet-individual', $poet->id)}}">view</a></td>
        </tr>
   @empty
        <h2>there are no poets in the system.
   @endforelse
        </table>
        @isset($poets)
        <div class="section pagination">
            {{$poets->links()}}
            </div>
        @endisset
</div>

</div>
</div>

@endsection
