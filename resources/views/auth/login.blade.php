@extends('layouts.master2')
@section('title', 'تسجيل الدخول')
{{-- @section('title')
Login - نظام إدارة المدرسة
@stop --}}

@section('css')
<!-- Sidemenu-responsive-tabs css -->
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The content half -->
            <div class="col-12 bg-white d-flex align-items-center justify-content-center">
                <div class="login p-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="mb-5">
                                    <a href="{{ url('/' . $page='Home') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="sign-favicon" alt="logo"></a>
                                    <h1 class="main-logo1 ml-2 my-auto">نظام إدارة المدرسة</h1>
                                </div>
                                <div class="main-signup-header">
                                    <h2 class="text-center">مرحبًا بك</h2>
                                    <h5 class="font-weight-semibold text-center mb-4">تسجيل الدخول</h5>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email">البريد الإلكتروني</label>
                                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="password">كلمة المرور</label>
                                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="remember">
                                                        {{ __('تذكرني') }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 text-right">
                                                <a href="{{ route('password.request') }}" class="text-primary">نسيت كلمة المرور؟</a>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-main-primary btn-block btn-lg py-3">
                                            {{ __('تسجيل الدخول') }}
                                        </button>
                                    </form>
                                    <p class="text-center mt-3 text-muted">ليس لديك حساب؟ <a href="{{ route('register') }}" class="text-primary">سجل الآن</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
