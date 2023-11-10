@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Cập nhật lớp</h1>
            @foreach($classes as $class)
                <form action="{{ route('aa-class-update') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input name="class_id" hidden value="{{ $class->class_id }}">
                        <input class="form-control" name="class_name" placeholder="Tên lớp" value="{{ $class->class_name }}" autocomplete="off" required>
                        <input type="number" min="1" class="form-control" name="school_year" placeholder="Niên khóa" value="{{ $class->school_year }}" autocomplete="off" style="margin-top: 20px" required>
                        <select name="major_name" style="margin-top: 20px" required>
                            <option value="{{ $class->major_id }}">{{ $class->major_name }}</option>
                            @foreach($majors as $major)
                                <option value="{{ $major->major_id }}">{{ $major->major_name }}</option>
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
