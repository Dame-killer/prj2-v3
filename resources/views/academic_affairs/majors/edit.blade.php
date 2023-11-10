@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Cập nhật chuyên ngành</h1>
            @foreach($majors as $major)
                <form action="{{ route('aa-major-update') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input name="major_id" hidden value="{{ $major->major_id }}">
                        <input class="form-control" name="major_name" placeholder="Tên chuyên ngành" value="{{ $major->major_name }}" autocomplete="off" style="margin-top: 20px" required>
                    </div>
                    <div class="modal-footer" style="margin-top: 20px">
                        <button class="btn btn-secondary"><a href="{{ route('aa-major') }}" style="text-decoration: none">Đóng</a></button>
                        <button type="submit" class="btn btn-primary" style="margin-left: 20px">Xác nhận</button>
                    </div>
                </form>
            @endforeach
        </div>
    </div>
@endsection
