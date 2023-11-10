@extends('layouts.app')

@section('content')
    <div class="row">
        @foreach($class_subjects as $class_subject)
            <div class="col-lg-2">
                <div class="card card-chart">
                    <div class="card-header">
                        <form action="{{ route('aa-point-subject') }}" method="GET">
                            @csrf
                            <input name="class_id" hidden value="{{ $class_subject->class_id }}">
                            <button class="btn btn-primary">{{ $class_subject->class_name }}K{{ $class_subject->school_year }}</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
