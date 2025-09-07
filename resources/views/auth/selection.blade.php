@extends('layouts.master2')
@section('title', 'حدد نوع الدخول')
@section('css')
    <style>
        body {
            font-family: 'Cairo', sans-serif;

            background-size: : cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }

        .login-title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .login-buttons a {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 15px;
            background: #f8f9fa;
            border: 2px solid transparent;
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
        }

        .login-buttons a:hover {
            background: #e2e6ea;
            border-color: #007bff;
        }

        .login-buttons img {
            width: 80px;
            margin-bottom: 8px;
        }

        .login-buttons span {
            font-weight: bold;
            color: #333;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="login-box">
                    <h3 class="login-title text-primary ">حدد طريقة الدخول</h3>
                    <div class="row text-center login-buttons">
                        <div class="col-12 col-md-4 mb-3">
                            <a wire:navigate href="{{ route('login.type', 'student') }}" title="طالب">
                                <img src="{{ asset('storage/student.png') }}" alt="طالب">
                                <span>طالب</span>
                            </a>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <a href="{{ route('login.type', 'teacher') }}" title="مدرس">
                                <img src="{{ asset('storage/teacher.png') }}" alt="مدرس">
                                <span>مدرس</span>
                            </a>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <a href="{{ route('login.type', 'admin') }}" title="مسؤول">
                                <img src="{{ asset('storage/admin.png') }}" alt="مسؤول">
                                <span>مسؤول</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
