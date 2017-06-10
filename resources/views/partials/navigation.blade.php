<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" id="logo" href="{{route('index')}}">{{config('app.name')}}</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
    {{{menu('main', 'bootstrap')}}}

        <ul class="nav navbar-nav navbar-right">

          @if(Auth::check())
          @php
            switch (Auth::user()->role->name) {
              case 'volunteer':
                  $actions = [['name' => 'Cliënten zoeken', 'link' => route('app')]];
                break;
              case 'admin':
              case 'executive':
              case 'superuser':
                  $actions = [['name' => 'Dashboard', 'link'  => route('voyager.dashboard')]];
                break;            
              default:
                break;
            }
          @endphp

        @foreach($actions as $action)
          <li><a href="{{$action['link']}}">{{$action['name']}}</a></li>
        @endforeach


        <li><a href="{{ url(route('app.logout')) }}"
            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
            Logout
        </a></li>

      @else
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Vrijwilligers <span class="caret"></span></a>
            <ul class="dropdown-menu">
              @if (Route::has('voyager.login'))
                    @if (Auth::check())
                        
                    @else
                        <li><a href="{{ url(route('voyager.login')) }}">Login</a>
                        <li><a href="{{ url(route('register')) }}">Register</a></li>
                    @endif
              @endif
            </ul>

          </li>

      @endif

      </ul>
  </div>

  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
  </form>
</nav>