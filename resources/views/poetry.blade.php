@extends('layout.layout')

@section('content')

<section class="wrapper style2"
id="three">
<div class="inner">
<div class="content">

<div class="row">
    @foreach ($poetry as $poem)
    <div class="poem col-12-medium col-6-large">
        <h2 class=""><a href="{{route('poem-individual', $poem->record_number )}}"><i class="i icon-quill"></i>poem#: {{$poem->id}} {{$poem->title}}</a></h2>
        <p class=""><strong>by: </strong> {{$poem->name}}</p>
        <p class="meaning"><strong>Meaning:</strong> {{$poem->meaning}}</p>
    </div>
@endforeach
</div>

</div>
<div class="section pagination">
{{$poetry->links()}}
</div>

</div>
</section>
 @endsection
