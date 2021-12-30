@extends('layout.layout')

@section('content')
<div class="container push-down">


        <section class="wrapper style1"
        id="three">
        <div class="inner">
        <div class="box">
        <div class="content-broad-desktop content">

        <div class="row">

        <div class="container is-fluid push-down">


        <h3 class="title">{{ __('Register') }}</h3>

        <div>
            <form method="POST" action="{{ route('register') }}">
                @csrf



                    <div class="">
                        <span class="icon is-small is-left">
                            <figure class="i icon-users"></figure>
                        </span>
                        <label for="name" class="">{{ __('Name') }}</label>
                        <input id="name" type="text" class="input control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                       {{--
                         @error('name')
                            <span class="invalid-feedback help" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror --}} 
                    </div>




                    <div class="">
                        <span class="i is-small is-left">
                            <i class="icon icon-pencil2"></i>
                        </span>
                        <label for="email" class="">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="input control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        {{--  
                        @error('email')
                            <span class="invalid-feedback help" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror--}}
                    </div>




                    <div class="">
                        <span class="i is-small is-left">
                            <i class="icon icon-lock"></i>
                        </span>
                        <label for="password" class="">{{ __('Password') }}</label>
                        <input id="password" type="password" class="input control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
{{-- 
@error('password')
<spanclass="invalid-feedback"role="alert">
<strong>$message</strong>
</span>
@enderror --}}
                    </div>



                    <div class="">
                        <span class="i is-small is-left">
                            <i class="icon icon-lock"></i>
                        </span>
                        <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="input control" name="password_confirmation" required autocomplete="new-password">
                    </div>


                <div class="">

                        <button type="submit" class="button">
                            {{ __('Register') }}
                        </button>

                </div>
            </form>
        </div>



    </div>


</div>
</div>
</div>
</div>
</section>
@endsection
