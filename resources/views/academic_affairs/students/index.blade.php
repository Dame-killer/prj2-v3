@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <button class="btn btn-primary mb-3" data-coreui-toggle="modal" data-coreui-target="#staticBackdrop1">Thêm sinh viên</button>
            <table class="table table-striped table-responsive table-bordered">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sinh viên</th>
                    <th>Mã SV</th>
                    <th>Email</th>
                    <th>Lớp</th>
                    <th>Hành động</th>
                    <th>Điểm</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->student_code }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->class_name }}K{{ $user->school_year }}</td>
                        <td>
                            <div class="row">
                                <div class="col-3">
                                    <form action="{{ route('aa-student-delete') }}" method="POST">
                                        @csrf
                                        <input name="id" hidden value="{{ $user->id }}">
                                        <button class="btn btn-danger">Xóa</button>
                                    </form>
                                </div>
                                <div class="col-6">
                                    <form action="{{ route('aa-student-edit') }}" method="GET">
                                        @csrf
                                        <input name="id" hidden value="{{ $user->id }}">
                                        <button class="btn btn-warning">Cập nhật</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('aa-student-point') }}" method="GET">
                                @csrf
                                <input name="id" hidden value="{{ $user->id }}">
                                <button class="btn btn-primary">Xem điểm</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Không có sinh viên</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop1" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Thêm sinh viên</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('aa-student-create') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input class="form-control" name="name" placeholder="Tên sinh viên" autocomplete="off" required>
                        <input class="form-control" name="student_code" placeholder="Mã sinh viên" autocomplete="off" style="margin-top: 20px" required>
                        <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off" style="margin-top: 20px" required>
                        <input type="password" class="form-control" name="password" placeholder="Mật khẩu" autocomplete="off" style="margin-top: 20px" required>
                        <select name="class_name" style="margin-top: 20px" required>
                            <option>Chọn lớp</option>
                            @foreach($classes as $class)
                                <option value="{{ $class -> class_id }}">{{ $class -> class_name }}K{{ $class->school_year }}</option>
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
