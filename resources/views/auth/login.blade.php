@extends('layout.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">

                    @if(config('app.env') !== 'production')
                    <div class="alert-container">
                        <div class="alert alert-warning small">
                            <h4>Demo Melding</h4>
                            <p>
                                Dit is een demo voor {{config('app.name')}}. Er zijn meedere rollen, waaronder elk een account beschikbaar is. Deze hebben de volgende kenmerkende rol-namen:
                            </p>
                            <br/>
                            <ul>
                                <li>Client ( rolnaam : client )</li>
                                <li>Vrijwilliger ( rolnaam : volunteer )</li>
                                <li>Eindverantwoordelijke (rolnaam : executive )</li>
                                <li>Administrator / Begeleider ( rolnaam : admin )</li>
                            </ul>
                            <br/>
                            <p>Inloggen kan met : <br/>
                                E-mailadres : {rolnaam}@example.com <br/>
                                Wachtwoord : {rolnaam}

                            </p>
                        </div>
                    </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-block btn-primary btn-block">
                                    Login
                                </button>

                                <a class="btn btn-link forgot-password text-center" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
