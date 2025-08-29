@extends('layouts.master')
@section('title', 'أسئلة الامتحان')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">أسئلة الامتحان: {{ $exam->title }}</h5>

                <livewire:exam-questions :exam="$exam" />

            </div>
        </div>
    </div>
</div>
@endsection
