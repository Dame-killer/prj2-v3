@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <button class="btn btn-primary mb-3" data-coreui-toggle="modal" data-coreui-target="#staticBackdrop1">Thêm
                lớp</button>
            <table class="table table-striped table-responsive table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên lớp</th>
                        <th>Tên môn</th>
                        <th>Lần thi</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($class_subjects as $class_subject)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $class_subject->class_name }}K{{ $class_subject->school_year  }}</td>
                            <td>{{ $class_subject->subject_name }}</td>
                            <td>{{ $class_subject->exam_times }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-2">
                                        <form action="{{ route('aa-classes-subjects-del') }}" method="POST">
                                            @csrf
                                            <input name="cs_id" hidden value="{{ $class_subject->cs_id }}">
                                            <button class="btn btn-danger">Xóa</button>
                                        </form>
                                    </div>
                                    <div class="col-5">
                                        <form action="{{ route('aa-classes-subjects-edit') }}" method="GET">
                                            @csrf
                                            <input name="cs_id" hidden value="{{ $class_subject->cs_id }}">
                                            <button class="btn btn-warning">Cập nhật</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Không có lớp môn học</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $class_subjects->links() }}
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop1" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Thêm lớp môn học</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('aa-classes-subjects-create') }}" method="POST">
                    @csrf
                    <div class="row">
                    <div class="modal-body">
                        <select name="class_name" style="margin-top: 20px" required>
                            <option>Chọn lớp</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class-> class_id }}">{{ $class-> class_name }}K{{ $class-> school_year  }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-body">
                        <select name="subject_name" style="margin-top: 20px" required>
                            <option>Chọn môn</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject-> subject_id }}">{{ $subject-> subject_name }} Lần {{ $subject-> exam_times }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
