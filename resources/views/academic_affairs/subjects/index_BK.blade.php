@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <button class="btn btn-primary mb-3" data-coreui-toggle="modal" data-coreui-target="#staticBackdrop1">Thêm môn</button>
            <table class="table table-striped table-responsive table-bordered">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên môn</th>
                    <th>Lần thi</th>
                    <th>Chuyên ngành</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($subjects as $subject)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $subject->subject_name }}</td>
                        <td>{{ $subject->exam_times }}</td>
                        <td>{{ $subject->major_name }}</td>
                        <td>
                            <div class="row">
                                <div class="col-2">
                                    <form action="{{ route('aa-subject-deleteBK') }}" method="POST">
                                        @csrf
                                        <input name="subject_id" hidden value="{{ $subject->subject_id }}">
                                        <button class="btn btn-danger">Xóa</button>
                                    </form>
                                </div>
                                <div class="col-5">
                                    <form action="{{ route('aa-subject-editBK') }}" method="GET">
                                        @csrf
                                        <input name="subject_id" hidden value="{{ $subject->subject_id }}">
                                        <button class="btn btn-warning">Cập nhật</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Không có môn</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{ $subjects->links() }}
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop1" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Thêm môn</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('aa-subject-createBK') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input class="form-control" name="subject_name" placeholder="Tên môn" autocomplete="off" required>
                        <input type="number" min="1" max="2" class="form-control" name="exam_times" placeholder="Lần thi" autocomplete="off" style="margin-top: 20px" required>
                        <select name="major_name" style="margin-top: 20px" required>
                            <option>Chọn chuyên ngành</option>
                            @foreach($majors as $major)
                                <option value="{{ $major -> major_id }}">{{ $major -> major_name }}</option>
                            @endforeach
                        </select>
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
