@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4>Cập nhật lớp môn học</h4>
            @foreach($class_subjects as $class_subject)
                <form action="{{ route('aa-classes-subjects-update') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input name="cs_id" hidden value="{{ $class_subject->cs_id }}">
                        <div class="modal-body">
                        <select name="major_name" style="margin-top: 20px" >
                            <option value="{{ $class_subject->class_id }}">{{ $class_subject->class_name }}K{{ $class_subject->school_year }}</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->class_id }}">{{ $class->class_name }}K{{ $class->school_year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-body">
                        <select name="major_name" style="margin-top: 20px" >
                            <option value="{{ $class_subject->subject_id }}">{{ $class_subject->subject_name }}Lần{{ $class_subject->exam_times }}</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->subject_id }}">{{ $subject->subject_name }}Lần{{ $subject->exam_times }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer" style="margin-top: 20px">
                        <button class="btn btn-secondary"><a href="{{ route('aa-class') }}" style="text-decoration: none">Đóng</a></button>
                        <button type="submit" class="btn btn-primary" style="margin-left: 20px">Xác nhận</button>
                    </div>
                </form>
            @endforeach
        </div>
    </div>
@endsection
