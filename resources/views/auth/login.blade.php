@extends('auth.layout')

@section('title', 'Login')

@section('content')

    <!-- Navbar -->
    <nav class="navbar navbar-light fixed-top bg-white shadow-sm justify-content-center">
      <a class="navbar-brand" href="{{ route('site.home') }}">
        <img src="{{ asset('assets/images/logo/'.setting('site.logo')) }}" class="img-fluid" width="200" alt="logo">
      </a>
    </nav>
    <!-- /Navbar -->

    <div class="main-wrapper mt-5 mt-lg-0">
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block">
                        <div class="d-flex align-items-center h-100">
                            <img class="img-fluid" src="{{asset('assets/images/ilustrasi/undraw_Login_re_4vu2.svg')}}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="wrapper">
                            <div class="card border-0 shadow-sm rounded-2">
                                <div class="card-header pt-4 bg-transparent text-left">
                                    <h5 class="h2">Selamat Datang Kembali :)</h5>
                                    <p class="m-0">Untuk tetap terhubung dengan kami, silakan login dengan informasi pribadi Anda melalui email dan kata sandi 🔔</p>
                                </div>
                                <div class="card-body">
                                    <form class="login-form" action="{{ route('auth.postlogin') }}" method="post">
                                        {{ csrf_field() }}
                                        @if(isset($message))
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                        @endif
                                        <div class="form-group ">
                                            <label class="control-label">Username / Email</label>
                                            <div class="input-group input-group-lg">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text {{ $errors->has('username') ? 'border-danger' : '' }}" id="basic-addon1"><i class="fa fa-user"></i></span>
                                                </div>
                                                <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username" type="text" placeholder="Username atau Email" autofocus>
                                            </div>
                                            @if($errors->has('username'))
                                            <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('username')) }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Password</label>
                                            <div class="input-group input-group-lg">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text {{ $errors->has('password') ? 'border-danger' : '' }}" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                                </div>
                                                <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'border-danger' : '' }}" placeholder="Password">
                                                <div class="input-group-append">
                                                    <a href="#" class="input-group-text text-dark btn btn-toggle-password {{ $errors->has('password') ? 'border-danger' : '' }}"><i class="fa fa-eye"></i></a>
                                                </div>
                                            </div>
                                            @if($errors->has('password'))
                                            <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('password')) }}</div>
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                          <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Ingat Saya</label>
                                          </div>
                                          <div class="form-group">
                                            <a href="#" class="text-body">Lupa Password?</a>
                                          </div>
                                        </div>
                                        <div class="form-group btn-container">
                                            <button type="submit" class="btn btn-theme-1 btn-lg rounded px-4 shadow-sm btn-block">Masuk</button>
                                            <a href="{{ route('auth.register') }}" class="btn btn-light btn-lg rounded px-4 shadow-sm btn-block">Daftar</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection