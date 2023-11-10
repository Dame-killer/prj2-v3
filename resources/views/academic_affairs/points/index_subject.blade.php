@extends('layouts.app')

@section('content')
    <div class="row">
        @foreach($class_subjects as $class_subject)
            <div class="col-lg-2">
                <div class="card card-chart">
                    <div class="card-header">
                        <form action="{{ route('aa-point-point') }}" method="GET">
                            @csrf
                            <input name="cs_id" hidden value="{{ $class_subject->cs_id }}">
                            <button class="btn btn-primary">{{ $class_subject->subject_name }} - Lần {{ $class_subject->exam_times }}</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
