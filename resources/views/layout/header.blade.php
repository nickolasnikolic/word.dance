<header class="alt" id="header">
    <a class="logo" href="{{route('home')}}">word.dance <span class="version">v1.5.2 beta</span></a>

    <nav id="nav">
        <ul>
            <li class="is-size-3-fullhd @if(url()->current() == route('home')) current is-size-2-mobile  @endif"><a
                    href="{{route('home')}}">home</a></li>
            <li class="is-size-3-fullhd @if(url()->current() == route('search')) current is-size-2-mobile  @endif"><a
                    href="{{route('search')}}">search</a></li>
            <li class="is-size-3-fullhd @if(url()->current() == route('poets')) current is-size-2-mobile  @endif"><a
                    href="{{route('poets')}}">poets</a></li>
            <li class="is-size-3-fullhd @if(url()->current() == route('poetry')) current is-size-2-mobile  @endif"><a
                    href="{{route('poetry')}}">poetry</a>
                        <ul>
                                <li
                                class="is-size-3-fullhd @if(url()->current() == route('popular-poetry')) current  is-size-2-mobile  @endif">
                                <a href="{{route('popular-poetry')}}">by popularity</a></li>
                                <li
                                class="is-size-3-fullhd @if(url()->current() == route('controversial-poetry')) current is-size-2-mobile  @endif">
                                <a href="{{route('controversial-poetry')}}">controversial poetry</a></li>
                                <li class="is-size-3-fullhd @if(url()->current() == route('genre')) current is-size-2-mobile  @endif"><a
                                href="{{route('genre')}}">genre</a></li>
                        </ul>
                </li>
            @auth
            <li class="is-size-3-fullhd @if(url()->current() == route('write')) current is-size-2-mobile  @endif"><a
                    href="{{route('write')}}">write</a></li>
            <li class="is-size-3-fullhd @if(url()->current() == route('mine')) current is-size-2-mobile  @endif"><a
                    href="{{route('mine')}}">mine</a></li>
            <li
                class="is-size-3-fullhd @if(url()->current() == route('profile-edit')) current is-size-2-mobile  @endif">
                <a href="{{route('profile-edit')}}">profile</a></li>
            <li class="is-size-3-fullhd @if(url()->current() == route('logout')) current is-size-2-mobile  @endif"><a
                    href="{{route('logout')}}">log out</a></li>
            @endauth
            @guest
            <li class="is-size-3-fullhd is-size-2-mobile @if(url()->current() == route('login')) current  @endif"><a
                    href="{{route('login')}}">login</a></li>
            <li class="is-size-3-fullhd is-size-2-mobile @if(url()->current() == route('register')) current  @endif"><a
                    href="{{route('register')}}">register</a></li>
            @endguest
        </ul>
    </nav>
</header>

