<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" id="logo" href="#">{{config('app.name')}}</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
          </ul>
          @if (Route::has('login'))
                @if (Auth::check())
                    <li><a href="{{ url('/home') }}">Home</a></li>
                @else
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @endif
          @endif
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          @if (Route::has('login'))
              @if (Auth::check())
                  <li><a href="{{ url('/home') }}">Home</a></li>
              @else
                  <li><a href="{{ url('/login') }}">Login</a></li>
                  <li><a href="{{ url('/register') }}">Register</a></li>
              @endif
          @endif
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>