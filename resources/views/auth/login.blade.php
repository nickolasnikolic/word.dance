@extends('layout.layout')

@section('content')


<section class="wrapper style1"
id="three">
<div class="inner">
<div class="box cta">
<div class="content-broad-desktop content">

<div class="row">

<div class="container is-fluid push-down">

<h3 class="title">{{ __('Log In') }}</h3>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div>
        <span class="i is-small is-left">
                <i class="i icon-pencil2"></i>
            </span>
            <label for="email" class="">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="input control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">


        <div class="">
            <span class="i is-small is-left">
                <i class="i icon-lock"></i>
            </span>
            <label for="password" class="">{{ __('Password') }}</label>
            <input id="password" type="password" class="input control @error('password') is-invalid @enderror" name="password" required >
        </div>

        <button class="button" type="submit">Log in</button>
</form>
</div>


</div>
</div>
</div>
</div>
</section>

@endsection
