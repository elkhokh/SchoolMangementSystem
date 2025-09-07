<div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

    <li class="nav-item"><a href="{{ route('dashboard') }}"><i class="la la-tachometer"></i><span class="menu-title" data-i18n="nav.classes.main">الصفحة الرئيسة </span><span class="badge badge-success badge-pill float-right mr-2">.</span></a></li>
<hr>
    <li class="nav-item"><a href="{{ route('classes.index') }}"><i class="la la-university"></i><span class="menu-title" data-i18n="nav.classes.main">إدارة الفصول</span></a>
        <ul class="menu-content">
        <li><a class="menu-item" href="{{ route('classes.index') }}" data-i18n="nav.classes.list"><i class="la la-chalkboard"></i> الفصول</a></li>
    {{-- <li><a class="menu-item" href="{{ route('sessions.index') }}"><i class="la la-calendar"></i> الحصص</a></li> --}}
            </ul>
        </li>

<hr>
        <li class="nav-item"><a href="#"><i class="la la-calendar-check-o"></i><span class="menu-title" data-i18n="nav.attendance.main">إدارة الغياب</span></a>
            <ul class="menu-content">
        <li><a class="menu-item" href="{{ route('attandances.index') }}" data-i18n="nav.attendance.list"><i class="la la-user-times"></i> الغياب</a></li>
            </ul>
        </li>

<hr>
        <li class="nav-item"><a href="#"><i class="la la-book"></i><span class="menu-title" data-i18n="nav.subjects.main">إدارة المواد</span></a>
            <ul class="menu-content">
        <li><a class="menu-item" href="{{ route('subjects.index') }}" data-i18n="nav.subjects.list"><i class="la la-book-open"></i> المواد الدراسية</a></li>
            </ul>
        </li>
<hr>
        <li class="nav-item"><a href="#"><i class="la la-file-text"></i><span class="menu-title" data-i18n="nav.exams.main"> الامتحانات</span></a>
            <ul class="menu-content">
        <li><a class="menu-item" href="{{ route('exams.index') }}" data-i18n="nav.exams.list"><i class="la la-list"></i>قائمة الامتحانات  </a></li>
        <li><a class="menu-item" href="{{ route('exams.create') }}" data-i18n="nav.exams.list"><i class="la la-plus-circle"></i>  اضافة امتحان</a></li>
        <li><a class="menu-item" href="{{ route('student_exams.index') }}" data-i18n="nav.exams.list"><i class="la la-eye"></i> عرض امتحان </a></li>
        {{-- <li><a class="menu-item" href="{{ route('student_exams.show') }}" data-i18n="nav.exams.list"><i class="la la-eye"></i> عرض امتحان </a></li> --}}
            </ul>
        </li>
<hr>
        <li class="nav-item"><a href="#"><i class="la la-credit-card"></i><span class="menu-title" data-i18n="nav.payments.main"> دفع مصاريف</span></a>
            <ul class="menu-content">
        <li><a class="menu-item" href="{{ route('payments.index') }}" data-i18n="nav.payments.list"><i class="la la-money"></i>قائمة المدفوعات  </a></li>
            </ul>
        </li>
<hr>
        <li class="nav-item"><a href="#"><i class="la la-users"></i><span class="menu-title" data-i18n="nav.teachers.main">المستخدمين</span></a>
            <ul class="menu-content">


        <li><a class="menu-item" href="#" data-i18n="nav.teachers.main"><i class="la la-user-plus"></i> قائمة المعلمون</a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{ route('teachers.index') }}" data-i18n="nav.teachers.list"><i class="la la-users"></i> المعلمون</a></li>
                    </ul>
                </li>
                <hr>
        <li><a class="menu-item" href="#" data-i18n="nav.students.main"><i class="la la-graduation-cap"></i> قائمة الطلاب</a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{ route('students.index') }}" data-i18n="nav.students.list"><i class="la la-users"></i> الطلاب</a></li>
                        <li><a class="menu-item" href="{{ route('students.create') }}" data-i18n="nav.students.add"><i class="la la-user-plus"></i> إضافة طالب</a></li>
                    </ul>
                </li>
   <hr>
        <li><a class="menu-item" href="#" data-i18n="nav.users.main"><i class="la la-shield"></i> قائمة الادمن</a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{ route('users.index') }}" data-i18n="nav.users.list"><i class="la la-cog"></i>الادمن </a></li>
                        {{-- <li><a class="menu-item" href="{{ route('users.create') }}" data-i18n="nav.users.add"><i class="la la-user-plus"></i> اضافة ادمن </a></li> --}}
                    </ul>
                </li>
   <hr>
        <li><a class="menu-item" href="#" data-i18n="nav.roles.main"><i class="la la-key"></i> قائمة الصلاحيات</a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{ route('roles.index') }}" data-i18n="nav.roles.list"><i class="la la-lock"></i> الصلاحيات</a></li>
                        <li><a class="menu-item" href="{{ route('roles.create') }}" data-i18n="nav.roles.add"><i class="la la-edit"></i> تعديل الصلاحيات </a></li>
                        {{-- <li><a class="menu-item" href="{{ route('roles.show') }}" data-i18n="nav.roles.add"><i class="la la-edit"></i> عرض الصلاحيات </a></li> --}}
                    </ul>
                </li>

            </ul>
        </li>

        <hr>
    </ul>
</div>
