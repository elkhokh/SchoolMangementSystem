<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/faces/6.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{Auth::user()->name}}</h4>
                    <span class="mb-0 text-muted">{{Auth::user()->email}}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category" style="font-weight: bold;">نظام إدارة المدرسة</li>


            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . $page='dashboard') }}"><svg class="side-menu__icon" viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg><span class="side-menu__label" style="font-weight: bold;">الرئيسية</span></a>
            </li>

            <li class="side-item side-item-category" style="font-weight: bold;">إدارة المستخدمين</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='users') }}"><svg class="side-menu__icon" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg><span class="side-menu__label" style="font-weight: bold;">المستخدمين</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('users.index') }}" style="font-weight: bold;">قائمة المستخدمين</a></li>
                    <li><a class="slide-item" href="{{ route('users.create') }}" style="font-weight: bold;">تسجيل ادمن جديد</a></li>
                    {{-- <li><a class="slide-item" href="{{ route('users.student') }}" style="font-weight: bold;">تسجيل طالب جديد</a></li> --}}
                    {{-- <li><a class="slide-item" href="{{ route('users.teacher') }}" style="font-weight: bold;">تسجيل مدرس جديد</a></li> --}}
                    <li><a class="slide-item" href="{{ route('roles.index') }}" style="font-weight: bold;">تعديل الصلاحيات</a></li>
                </ul>
            </li>


            <li class="side-item side-item-category" style="font-weight: bold;">إدارة الطلاب</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ route('students.index') }}"><svg class="side-menu__icon" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/></svg><span class="side-menu__label" style="font-weight: bold;">الطلاب</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{  route('students.index') }}" style="font-weight: bold;">قائمة الطلاب</a></li>
                    {{-- <li><a class="slide-item" href="{{ route('students.create') }}" style="font-weight: bold;">إضافة طالب</a></li> --}}
                    {{-- <li><a class="slide-item" href="{{ route('students.index')}}" style="font-weight: bold;">تفاصيل الطالب</a></li> --}}
                    <li><a class="slide-item" href="{{ route('students.index') }}" style="font-weight: bold;">تسجيل الحضور اليومي</a></li>
                </ul>
            </li>


            <li class="side-item side-item-category" style="font-weight: bold;">إدارة المعلمين</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg class="side-menu__icon" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg><span class="side-menu__label" style="font-weight: bold;">المعلمين</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{  route('teachers.index') }}" style="font-weight: bold;">قائمة المعلمين</a></li>
                    {{-- <li><a class="slide-item" href="{{ url('/' . $page='draggablecards') }}" style="font-weight: bold;">إضافة معلم</a></li> --}}
                    <li><a class="slide-item" href="{{  route('teachers.index') }}" style="font-weight: bold;">جدول المعلم</a></li>
                    {{-- <li><a class="slide-item" href="{{ url('/' . $page='teacher-certificates') }}" style="font-weight: bold;">شهادات المعلم</a></li> --}}
                </ul>
            </li>

            <li class="side-item side-item-category" style="font-weight: bold;">إدارة الفصول</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='classes.index') }}"><svg class="side-menu__icon" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/></svg><span class="side-menu__label" style="font-weight: bold;">الفصول</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
            <li><a class="slide-item" href="{{ route('classes.index') }}" style="font-weight: bold;">قائمة الفصول</a></li>
            <li><a class="slide-item" href="{{ route('classes.create') }}" style="font-weight: bold;">إضافة فصل</a></li>
            <li><a class="slide-item" href="{{ route('sessions.index') }}" style="font-weight: bold;">جدول الفصول</a></li> {{-- لو عندك صفحة جدول مختلفة غير index، عدلها --}}

                </ul>
            </li>


            <li class="side-item side-item-category" style="font-weight: bold;">إدارة المواد</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='subjects.index') }}"><svg class="side-menu__icon" viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg><span class="side-menu__label" style="font-weight: bold;">المواد الدراسية</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('subjects.index') }}" style="font-weight: bold;">قائمة المواد</a></li>
                    {{-- <li><a class="slide-item" href="{{ route('subjects.create') }}" style="font-weight: bold;">إضافة مادة</a></li> --}}
                    <li><a class="slide-item" href="{{ route('subjects.index') }}" style="font-weight: bold;">إدارة الدرجات</a></li>
                </ul>
            </li>


<li class="side-item side-item-category" style="font-weight: bold;">إدارة الامتحانات</li>
<li class="slide">
    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='exams.index') }}"><svg class="side-menu__icon" viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19 2H9c-1.1 0-2 .9-2 2v14l4-4h8c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg><span class="side-menu__label" style="font-weight: bold;">إدارة الامتحانات</span><i class="angle fe fe-chevron-down"></i> </a>
    <ul class="slide-menu">
        <li><a class="slide-item" href="{{ route('exams.index') }}" style="font-weight: bold;">قائمة الامتحانات</a></li>
        <li><a class="slide-item" href="{{ route('exams.create') }}" style="font-weight: bold;">إضافة امتحان</a></li>
        <li><a class="slide-item" href="{{ route('student_exams.index') }}" style="font-weight: bold;">عرض امتحان</a></li>
    </ul>
</li>

            <li class="side-item side-item-category" style="font-weight: bold;">إدارة الحضور والغياب</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ route('attandances.index') }}"><svg class="side-menu__icon" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg><span class="side-menu__label" style="font-weight: bold;">الحضور والغياب</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('attandances.index') }}" style="font-weight: bold;">إدارة الحضور</a></li>
                    {{-- <li><a class="slide-item" href="{{ route('attandances.show') }}" style="font-weight: bold;">سجل الحضور</a></li> --}}
                </ul>
            </li>

            <li class="side-item side-item-category" style="font-weight: bold;">التقارير</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='reports') }}"><svg class="side-menu__icon" viewBox="0 0 24 24"><path d="M14 6h3v7.88l-2-2V6zM4 4v12l4-4h6l-4-4H4zm10 7v3.88l2 2V11h-2z" opacity=".3"/><path d="M20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/></svg><span class="side-menu__label" style="font-weight: bold;">التقارير</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ url('/' . $page='reports-attendance') }}" style="font-weight: bold;">تقرير الحضور</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='reports-grades') }}" style="font-weight: bold;">تقرير الدرجات</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='reports-stats') }}" style="font-weight: bold;">الإحصائيات العامة</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='reports-subjects') }}" style="font-weight: bold;">تقرير المواد</a></li>
                </ul>
            </li>

            <li class="side-item side-item-category" style="font-weight: bold;">الارشيف</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='reports') }}"><svg class="side-menu__icon" viewBox="0 0 24 24"><path d="M14 6h3v7.88l-2-2V6zM4 4v12l4-4h6l-4-4H4zm10 7v3.88l2 2V11h-2z" opacity=".3"/><path d="M20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/></svg><span class="side-menu__label" style="font-weight: bold;">الارشيف</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ url('/' . $page='reports-attendance') }}" style="font-weight: bold;">ارشيف الحضور</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='reports-grades') }}" style="font-weight: bold;">ارشيف الطلاب </a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='reports-stats') }}" style="font-weight: bold;">ارشيف المدرسين </a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='reports-subjects') }}" style="font-weight: bold;"> ارشيف المدفوعات</a></li>
                </ul>
            </li>

            <li class="side-item side-item-category" style="font-weight: bold;">ادارة عمليات الدفع</li>
            <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='reports') }}">

        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg><span class="side-menu__label" style="font-weight: bold;">المدفوعات</span><i class="angle fe fe-chevron-down"></i> </a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('payments.index') }}" style="font-weight: bold;"> قائمة المدفوعات</a></li>
                    <li><a class="slide-item" href="{{ route('payments.create') }}" style="font-weight: bold;"> اضافة عملية دفع</a></li>
                </ul>
            </li>

            <li class="side-item side-item-category" style="font-weight: bold;">الإعدادات</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='sections') }}"><svg class="side-menu__icon" viewBox="0 0 24 24"><path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.61l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22l-1.92 3.32c-.12.2-.07.47.12.61l2.03 1.58c-.05.3-.09.63-.09.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.04-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/></svg><span class="side-menu__label" style="font-weight: bold;">الإعدادات</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ url('/' . $page='settings-permissions') }}" style="font-weight: bold;">إدارة الصلاحيات</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='settings-config') }}" style="font-weight: bold;">إعدادات النظام</a></li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
<!-- main-sidebar -->
