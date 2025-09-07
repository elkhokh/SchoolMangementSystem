@extends('layouts.master2')
@section('title', 'تسجيل الدخول')
@section('css')
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        /* تظبيط الكارت بتاع تسجيل الدخول */
        .login-card {
            margin-top: 60px;
            margin-bottom: 60px;
        }

        .card-header {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .card-header img {
            max-height: 55px;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        /* البوتون */
        .btn-lg {
            padding-top: 0.8rem;
            padding-bottom: 0.8rem;
        }
    </style>
@endsection

@section('content')
    <section class="flexbox-container">

        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0 login-card">
                <div class="card border-grey border-lighten-3 m-0">
                    <div class="card-header border-0 text-center">
                        <div class="card-title">
                            <div class="p-1">
                                <img src="{{ asset('/') }}app-assets/images/logo/logo-dark.png" alt="branding logo">

                            </div>
                        </div>
                        <h6 class="card-subtitle line-on-side text-muted font-small-3 pt-2">
                            <h2> <span>تسجيل دخول    {{ $type == 'student' ? 'طالب' : ($type == 'teacher' ? 'مدرس' : 'مسؤول') }}</span></h2>
                        </h6>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form-horizontal form-simple" method="POST" action="{{ route('login') }}"
                                novalidate>
                                @csrf
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <input type="email"
                                        class="form-control form-control-lg input-lg @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}"
                                        placeholder="البريد الإلكتروني">
                                    <div class="form-control-position">
                                        <i class="ft-user"></i>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="password"
                                        class="form-control form-control-lg input-lg @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="كلمة المرور">
                                    <div class="form-control-position">
                                        {{-- <i class="la la-key"></i> --}}
                                        <i class="la la-eye" id="togglePassword"
                                            style="cursor: pointer; margin-left: 10px;"></i>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </fieldset>
                                <div class="form-group row">
                                    <div class="col-md-6 col-12 text-center text-md-left">
                                        <fieldset>
                                            <input type="checkbox" id="remember-me" name="remember" class="chk-remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <label for="remember-me">تذكرني</label>
                                        </fieldset>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> تسجيل
                                    الدخول</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this;
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('la-eye');
                icon.classList.add('la-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('la-eye-slash');
                icon.classList.add('la-eye');
            }
        });
    </script>
@endsection
