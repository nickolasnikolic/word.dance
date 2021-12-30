@extends('layout.layout')

@section('content')

<div class="wrapper"
id="banner">
<div class="inner">
<div class="content">
 <h1>Thank you for your purchase frmom word.dance!</h1>
 <p>Be sure to read the EULA, which is short.</p>

<a target="_blank" class="button" href="{{route('paid', $id )}}">download</a>

</div>

</div>
</div>
</div><!-- Wrapper -->

@endsection
