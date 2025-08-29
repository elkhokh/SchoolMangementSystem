@extends('layouts.master')
@section('title','قائمة الامتحانات')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">

        <div class="d-flex justify-content-between mb-3">
          <h5 class="card-title mb-0">الامتحانات</h5>
          <a href="{{ route('exams.create') }}" class="btn btn-primary">+ إضافة امتحان</a>
        </div>

        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
          <table class="table table-bordered text-center">
            <thead>
              <tr>
                <th>#</th>
                <th>العنوان</th>
                <th>المادة</th>
                <th>المدرس</th>
                <th>الحالة</th>
                <th>من</th>
                <th>إلى</th>
                <th>المدة (دقيقة)</th>
                <th>إجراءات</th>
              </tr>
            </thead>
            <tbody>
              @forelse($exams as $exam)
                <tr>
                  <td>{{ $exam->id }}</td>
                  <td>{{ $exam->title }}</td>
                  <td>{{ optional($exam->subject)->name }}</td>
                  <td>{{ optional($exam->teacher)->name }}</td>
                  <td>
                    @if($exam->status)
                      <span class="badge bg-success">نشط</span>
                    @else
                      <span class="badge bg-secondary">غير نشط</span>
                    @endif
                  </td>
                  <td>{{ \Carbon\Carbon::parse($exam->start_time)->format('Y-m-d H:i') }}</td>
                  <td>{{ \Carbon\Carbon::parse($exam->end_time)->format('Y-m-d H:i') }}</td>
                  <td>{{ $exam->time_of_exam }}</td>
                  <td>
                    <a href="{{ route('exams.show',$exam) }}" class="btn btn-sm btn-info">عرض</a>
                    {{-- تقدر تضيف edit/destroy لاحقًا --}}
                  </td>
                </tr>
              @empty
                <tr><td colspan="9">لا توجد امتحانات بعد</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>

        {{ $exams->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
