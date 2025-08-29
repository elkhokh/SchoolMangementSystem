@extends('layouts.master') {{-- أو أي ماستر تستخدمه --}}

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3>أداء امتحان: {{ $exam->title }}</h3>
        @livewire('take-exam', ['exam' => $exam])
    </div>
</div>
@endsection
