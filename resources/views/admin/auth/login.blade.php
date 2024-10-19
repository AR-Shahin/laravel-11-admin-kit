@extends("admin.layouts.app")
@section("title", "Login")
@section("app_content")
<div class="login-page">
    <div class="login-box">
       <div class="login-logo">
          <a href="../../index2.html">{{$website->name}}</a>
       </div>
       <!-- /.login-logo -->
       <div class="card">
          <div class="card-body login-card-body">
             <p class="login-box-msg">Sign in to start your session</p>
             @error("email")
             <span class="text-danger">{{ $message }}</span>
          @enderror
          @if (session("status"))
          <span class="text-success">{{ session("status") }}</span>
      @endif
             <form action="{{ route("admin.authenticate") }}" method="post">
                @csrf
                <div class="input-group mb-3">
                   <input type="email" class="form-control" placeholder="Email" name="email" value="admin@mail.com">

                   <div class="input-group-append">
                      <div class="input-group-text">
                         <span class="fas fa-envelope"></span>
                      </div>
                   </div>
                </div>
                <div class="input-group mb-3">
                   <input type="password" class="form-control" placeholder="Password" name="password" value="password">
                   <div class="input-group-append">
                      <div class="input-group-text">
                         <span class="fas fa-lock"></span>
                      </div>
                   </div>
                </div>
                <div class="row">
                   <div class="col-8">
                      <div class="icheck-primary">
                         <input type="checkbox" id="remember" value="1">
                         <label for="remember">
                         Remember Me
                         </label>
                      </div>
                   </div>
                   <!-- /.col -->
                   <div class="col-4">
                      <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                   </div>
                   <!-- /.col -->
                </div>
             </form>
             {{-- <div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-primary">
                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
             </div> --}}
             <!-- /.social-auth-links -->
             <p class="mb-1">
                <a href="{{ route("admin.password.request") }}">I forgot my password</a>
             </p>
             {{-- <p class="mb-0">
                <a href="register.html" class="text-center">Register a new membership</a>
             </p> --}}
          </div>
          <!-- /.login-card-body -->
       </div>
    </div>
</div>
@stop
