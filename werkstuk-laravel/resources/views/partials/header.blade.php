<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('home') }}">Trainingen RSC Tienen</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto ">
            <li class="nav-item @yield('hcurrent')">
                <a class="nav-link " href="{{ route('home') }}">Home </a>
            </li>
            <li class="nav-item @yield('vcurrent')">
                <a class="nav-link" href="{{ route('voorbijetrainingen') }}">Voorbije Trainingen </a>
            </li>
            <li class="nav-item @yield('gcurrent')">
                <a class="nav-link" href="{{ route('lists.groepenentrainers') }}">Groepen en trainers </a>
            </li>
            <li class="nav-item @yield('ocurrent')">
                <a class="nav-link" href="{{ route('about') }}">Over </a>
            </li>
            <!-- checkt of de gebruiker admin is -->
            @if(\Illuminate\Support\Facades\Auth::check())
                @if( \Illuminate\Support\Facades\Auth::user()->id == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.index') }}">Admin </a>
                    </li>
                @endif
            @endif
        </ul>

        <ul class="navbar-nav ml-auto ">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item">
                    <p class="nav-link dropdown-toggle">
                        {{ Auth::user()->name }}
                    </p>
                </li>
                <li class="nav-item">

                    <a class="btn" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endguest
        </ul>
    </div>
</nav>