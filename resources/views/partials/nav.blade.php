<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm fixed-top">
    <div class="container">
        <p>Labas</p>
        <a class="navbar-brand" href="{{ url('/orders') }}">
            <img src="{{ asset('images/logo.png') }}" class="brand-logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @auth()
                    <li class="nav-item">
                        <a class="btn btn-outline-success"
                           href="{{ route('orders.create') }}">{{ __('Sukurti užsakymą') }}</a>
                    </li>
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @auth()
                    <a class="nav-link" href="{{ route('orders.index') }}">
                        {{ __('Užsakymai') }}
                    </a>
                    <a class="nav-link" href="{{ route('products.index') }}">
                        {{ __('Patiekalai') }}
                    </a>
                    <a class="nav-link" href="{{ route('home') }}">
                        {{ __('Statistika') }}
                    </a>
                    <a class="nav-link" href="{{ url('/') }}">
                        {{ __('Pagrindinis') }}
                    </a>
                @endauth

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
                    <li class="nav-item dropdown">


                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Atsijungti') }}
                            </a>


                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </div>
                    </li>

                @endguest
            </ul>
        </div>
    </div>
</nav>
