@extends('header')
@section('content')
    <div class="form-signin">
        <h3 class="form-signin-heading">Please sign in</h3>
        <div class="response-msg"></div>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password">
        <div class="checkbox">
          <label>
            <!-- <input type="checkbox" value="remember-me"> Remember me -->
          </label>
        </div>
        <button id="login" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </div>
    <script src="{{ asset('assets/js/login.js') }}"></script>
@stop