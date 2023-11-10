@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Nhập điểm</h1>
            @foreach($points as $point)
                <form action="{{ route('aa-point-insert') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input name="point_id" hidden value="{{ $point->point_id }}">
                        <input type="number" min="0" max="10" class="form-control" name="theory" placeholder="Lý thuyết" value="{{ $point->theory }}" autocomplete="off" style="margin-top: 20px">
                        <input type="number" min="0" max="10" class="form-control" name="practice" placeholder="Thực hành" value="{{ $point->practice }}" autocomplete="off" style="margin-top: 20px">
                        <input type="number" min="0" max="10" class="form-control" name="asm" placeholder="Assignment" value="{{ $point->asm }}" autocomplete="off" style="margin-top: 20px">
                    </div>
                    <div class="modal-footer" style="margin-top: 20px">
                        <button class="btn btn-secondary"><a href="{{ redirect()->back()->getTargetUrl() }}" style="text-decoration: none">Đóng</a></button>
                        <button type="submit" class="btn btn-primary" style="margin-left: 20px">Xác nhận</button>
                    </div>
                </form>
            @endforeach
        </div>
    </div>
@endsection
