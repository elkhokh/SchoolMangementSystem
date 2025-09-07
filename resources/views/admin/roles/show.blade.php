@extends('layouts.master')
@section('title', 'عرض الصلاحية')
@section('css')
    <style>
        /* Styles خاصة بالصفحة */
        .permission-list {
            list-style: none;
            padding: 0;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
        }
        .permission-list li {
            background: linear-gradient(180deg, #ecfdf5, #d1fae5);
            border: 1px solid #34d399;
            color: #064e3b;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 1.05rem;
            transition: all 0.3s ease;
        }
        .permission-list li:hover {
            background: linear-gradient(180deg, #d1fae5, #a7f3d0);
            box-shadow: 0 4px 12px rgba(52, 211, 153, 0.3);
            transform: scale(1.02);
        }
        .no-permissions {
            font-size: 1.1rem;
            color: #64748b;
            text-align: center;
            padding: 20px;
            background-color: #f8fafc;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }
    </style>
@endsection

@section('page-header')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div class="d-flex align-items-center">
                <h4 class="mb-0 content-title">
                    <i class="la la-user-shield"></i> الصلاحيات
                </h4>
                <span class="text-muted mx-2">/ عرض الصلاحية</span>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <a href="{{ route('roles.index') }}" class="btn btn-secondary btn-md">
                    <i class="la la-arrow-right mr-1"></i> رجوع
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="la la-shield mr-2"></i> تفاصيل الصلاحية: {{ $role->name }}
                    </h5>
                    <div class="row">
                        <div class="col-lg-12">
                            @if (!empty($rolePermissions) && count($rolePermissions) > 0)
                                <ul class="permission-list">
                                    @foreach($rolePermissions as $v)
                                        <li>{{ $v->name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="no-permissions">لا توجد أذونات مرتبطة بهذه الصلاحية.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
