@extends('auth.content')

@section('login')
<div class="form-title">
    <p style="font-size:65px;">iinspection</p>
</div>
<!-- Login Form-->
<div class="login-form text-center">
    <div class="">
    </div>
    <div class="form formLogin">
        <h2>Login to your account</h2>
        <form class="form-horizontal was-validated" method="POST" action="{{route('login')}}">
          @csrf
          <div class="form-group mb-3{{$errors->has('user' ? 'is-invalid' : '')}}">
            <input type="text" value="{{old('user')}}" name="user" id="user" placeholder="Username">
            {!!$errors->first('user','<span >:message</span>')!!}
          </div>
          <div class="form-group mb-4{{$errors->has('password' ? 'is-invalid' : '')}}">
            <input type="password" name="password" id="password" placeholder="Password">
            {!!$errors->first('password','<span >:message</span>')!!}
          </div>
            <button type="submit">Login</button>
        </form>
    </div>
</div>
@endsection
