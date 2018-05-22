<nav class="navbar navbar-expand-lg fixed-top  bg-primary  navbar-light">
    <a class="navbar-brand d-none d-md-block" href="{{ url('/') }}">
        <img src="{{ asset( 'img/brand.png') }}" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
        
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto navbar-right">
            <!-- Authentication Links -->
            @guest
                <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <img class="header-avatar" src="{{ Auth::user()->getProfilePicture()}}" />{{ Auth::user()->firstname }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('myprofile') }}">{{ __('My Profile') }}</a>
                        <a class="dropdown-item" href="{{ route('create-trip') }}">{{ __('New Trip') }}</a>
                        <a class="dropdown-item" href="{{ route('mytrips') }}">{{ __('My Trips') }}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>

