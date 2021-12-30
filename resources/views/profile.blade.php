@extends('layout.layout')

@section('content')


<section class="wrapper style1" id="three">
<div class="inner">
<div class="box">
<div class="content">

<div class="row">


<div class="container push-down-desktop">

        <div class="push-down-6em">
            <form method="POST" action="{{ route('user.update', Auth::id()) }}">
                @csrf

                {{ method_field('PUT') }}

                    <div class="">
                        <span class="icon is-small is-left">
                            <figure class="i icon-users"></figure>
                        </span>
                        <label for="name" class="">{{ __('Name') }}</label>
                        <input id="name" type="text" class="input control @error('name') is-invalid @enderror" name="name" value="@isset(Auth::user()->name){{ Auth::user()->name}}@endisset">
                    </div>




                    <div class="">
                        <span class="i is-small is-left">
                            <i class="i icon-pencil2"></i>
                        </span>
                        <label for="email" class="">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="input is-static control @error('email') is-invalid @enderror" readonly name="email" value="@isset(Auth::user()->email){{ Auth::user()->email}}@endisset" required>
                    </div>

                    <div class="">
                        <span class="i is-small is-left">
                            <i class="i icon-lock"></i>
                        </span>
                        <label for="password" class="">{{ __('Password') }}</label>
                        <input id="password" type="password" class="input control @error('password') is-invalid @enderror" name="password" placeholder="new supersecret password" >
                    </div>

                    <div class="">
                        <label for="disabled">Deactivate your account?</label>
                        <input type="checkbox" name="disabled" @if(Auth::user()->disabled == true) checked="checked" @endif />
                    </div>

                    <div class="">
                            <span class="i is-small is-left">
                                <i class="i icon-play"></i>
                            </span>
                            <label for="bio" class="">{{ __('bio') }}</label>
                            <textarea class="textarea control @error('bio') is-invalid @enderror" name="bio" rows="4" placeholder="Enter your life story.">@isset(Auth::user()->bio){{ Auth::user()->bio}}@endisset</textarea>
                        </div>


                <div>
                        <span class="i is-small is-left">
                            <i class="i icon-map"></i>
                        </span>
                        <label for="zip" class="">{{ __('Postal Code') }}</label>
                        <input type="text" class="input control @error('password') is-invalid @enderror" name="zip" value="@isset(Auth::user()->zip){{ Auth::user()->zip }}@endisset" placeholder="enter zip to find local poets and poetry, be found" >
                    </div>

                    <div>
                        <a
                            class="input button btn control" href="{{ route('connect-stripe') }}">
                            @isset(Auth::user()->access_token)
                            {{ __('DONE! Connected to Stripe :-)') }}
                            @else
                            {{ __('Optional: Please use the SAME EMAIL you use for word.dance to Connect To Stripe To Collect Payments for licensing.') }}
                            @endisset
                        </a>
                    </div>

                    <div>

                            <button type="submit" class="button">
                                {{ __('Update Profile') }}
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
