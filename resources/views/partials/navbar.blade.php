<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="#">{{ config('app.name', 'MyNotes') }}</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/about') }}">About</a>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Categories</a>
              <div class="dropdown-menu">
                @foreach($categories as $category)
                    <a class="dropdown-item"
                        href="/categories/{{$category->name}}">{{ $category->name }}</a>
                @endforeach
              </div>
          </li>
          @if(Auth::check())
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/tickets/create') }}">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/tickets') }}">Tickets</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/posts') }}">Posts</a>
          </li>
          @endif
        </ul>
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            <li>
                <form action="/search" class="form-inline" method="GET">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                    <button class="btn btn-outline-primary btn-sm my-2 my-sm-0" type="submit">Search</button>
                </form>
            </li>
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
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @if(Auth::check())
                          @if(Auth::user()->hasRole('moderator'))
                          <a class="dropdown-item" href="/admin">
                              Dashboard
                          </a>
                          @endif
                        @endif
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
