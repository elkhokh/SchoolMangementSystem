@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3>الامتحانات المتاحة</h3>
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم الامتحان</th>
                        <th>المادة</th>
                        <th>المدرس</th>
                        <th>الحالة</th>
                        <th>الإجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($studentExams as $exam)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $exam->title }}</td>
                            <td>{{ $exam->subject->name ?? '-' }}</td>
                            <td>{{ $exam->teacher->user->name ?? '-' }}</td>
                            <td>{{ $exam->status ? 'مفعل' : 'غير مفعل' }}</td>
                            <td>
                                <a href="{{ route('student_exams.show', $exam->id) }}" class="btn btn-success btn-sm">أداء الامتحان</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $studentExams->links() }}
        </div>
    </div>
</div>
@endsection
