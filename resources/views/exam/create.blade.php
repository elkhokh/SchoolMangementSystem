@extends('layouts.master')
@section('title', 'إنشاء امتحان')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">إنشاء امتحان جديد</h5>

                <form action="{{ route('exams.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>عنوان الامتحان</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>المادة</label>
                        <select name="subject_id" class="form-control" required>
                            <option value="">اختر المادة</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>المدرس</label>
                        <select name="teacher_id" class="form-control" required>
                            <option value="">اختر المدرس</option>
                            @foreach($teachers as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>الحالة</label>
                        <select name="status" class="form-control" required>
                            <option value="1">مفعل</option>
                            <option value="0">غير مفعل</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>وقت البدء</label>
                        <input type="datetime-local" name="start_time" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>وقت الانتهاء</label>
                        <input type="datetime-local" name="end_time" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>مدة الامتحان بالدقائق</label>
                        <input type="number" name="time_of_exam" class="form-control" min="1" required>
                    </div>

                    <div class="form-group">
                        <label>ملاحظات</label>
                        <textarea name="note" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">إنشاء الامتحان</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
