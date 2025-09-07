@extends('layouts.master')
@section('title', 'لوحة التحكم الرئيسية')
@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: #f5f5f5;
        }

        .profile-card {
            border-radius: 10px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            background: #03a9f4;
            color: #fff;
            padding: 10px 15px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .profile-header i {
            margin-left: 8px;
        }

        .profile-body {
            padding: 20px;
        }

        .profile-img {
            width: 100%;
            max-width: 200px;
            border-radius: 10px;
        }

        .info-box {
            background: #5f5f5f;
            color: #fff;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .info-box i {
            background: #03a9f4;
            color: #fff;
            border-radius: 5px;
            padding: 8px;
            font-size: 18px;
        }

        .info-text {
            text-align: right;
            flex-grow: 1;
            margin-right: 10px;
        }

        .info-text h6 {
            margin: 0;
            font-weight: bold;
        }

        .info-text p {
            margin: 0;
            font-size: 14px;
        }
    </style>
@endsection
@section('page-header')

@endsection
@section('content')

    <div class="container mt-5">
        <div class="profile-card">
            <div class="profile-header">
                <i class="la la-user"></i>
                بروفايل الطالب
            </div>
            <div class="profile-body">
                <div class="row">
                    <div class="col-md-3 text-center mb-3">
                        <img src="{{ asset('storage/student.png') }}" alt="طالب" class="profile-img">
                    </div>

                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-box">
                                    <div class="info-text">
                                        <h6>الكود</h6>
                                        <p>2021301</p>
                                    </div>
                                    <i class="fas fa-phone"></i>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-box">
                                    <div class="info-text">
                                        <h6>القسم</h6>
                                        <p>هندسة الاتصالات والحاسبات</p>
                                    </div>
                                    <i class="fas fa-home"></i>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-box">
                                    <div class="info-text">
                                        <h6>الايميل</h6>
                                        <p>{{ Auth::user()->email }}</p>
                                    </div>
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-box">
                                    <div class="info-text">
                                        <h6>المستوي</h6>
                                        <p>المستوي الرابع (400)</p>
                                    </div>
                                    <i class="fas fa-qrcode"></i>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-box">
                                    <div class="info-text">
                                        <h6>عدد الساعات المحققة</h6>
                                        <p>132</p>
                                    </div>
                                    <i class="fas fa-layer-group"></i>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-box">
                                    <div class="info-text">
                                        <h6>GPA</h6>
                                        <p>3.458</p>
                                    </div>
                                    <i class="fas fa-percent"></i>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-box">
                                    <div class="info-text">
                                        <h6>المرشد الأكاديمي</h6>
                                        <p>د/ ايريني مجدي عبد الملاك</p>
                                    </div>
                                    <i class="fas fa-user"></i>
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
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

@endsection
