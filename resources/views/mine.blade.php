@extends('layout.layout')

@section('content')



<section class="wrapper style1"
id="three">
<div class="inner">
<div>
<div class="content">

<div class="row">

    <table class="table">
            <th class="th">poem authored</td>
            <th class="th hide-on-mobile th-meaning">meaning</td>
            <th class="th hide-on-mobile">total views </td>
            <th class="th hide-on-mobile">total likes </td>
            <th class="th">price </td>
   @forelse ($poetry as $poem)
        <tr class="tr">
            <td class="td">{{$poem->title}}</td>
            <td class="td hide-on-mobile">{{$poem->meaning}}</td>
            <td class="td hide-on-mobile">{{$poem->views}}</td>
            <td class="td hide-on-mobile">{{$poem->likes}}</td>
            <td class="td">${{$poem->price}}</td>
          @if($poem->published)
               <td class="td"><a href="{{route('poem-individual', $poem->id)}}">view</a></td>
               <td class="td"><a href="{{route('poem-edit', $poem->id)}}">edit</a></td>
          @else
               <td class="td"><a href="{{route('poem-edit', $poem->id)}}">invisible</a></td>
          @endif
          
          
        </tr>
   @empty
        <h2>there are no poems authored in your account</h2>
   @endforelse
        </table>
        <table class="table">
                <th class="th">poem licensed</td>
                <th class="th">price </td>
                <th class="TH">download</th>
       @forelse ($poetryLicensed as $poem)
            <tr class="tr">
                <td class="td">{{$poem->title}}</td>
                <td class="td">${{$poem->price_paid}}</td>
                <td class="td"><a target="_blank" href="{{ route('redownload', $poem->purchase_id) }}">download</a></td>
            </tr>
       @empty
            <h2>there are no licensed poems in your account</h2>
       @endforelse
     </table>
{{--
    <h2>Poets Sponsored</h2>
            <table class="table">
                <th class="th">poet sponsored</td>
                <th class="th">monthly cost </td>
                <th class="th">manage</th>
       @isset($poetsSponsored)
       @foreach ($poetsSponsored as $poetSponsorship)
            <tr class="tr">
                <td class="td">{{$poetSponsorship->stripe_plan}}</td>
                <td class="td">${{$poetSponsorship->pledge}}</td>
                <td class="td"><a href="{{ route('cancel', $poetSponsorship->id) }}">cancel</a></td>
            </tr>     
       @endforeach
       @endisset
       @empty($poetsSponsored)
            <h2>there are no sponsored poets in your account</h2>
       @endempty
            </table>
--}}

</div>


</div>
</div>
</div>
</div>
</section>

@endsection
