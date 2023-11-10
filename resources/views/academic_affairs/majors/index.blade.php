@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <button class="btn btn-primary mb-3" data-coreui-toggle="modal" data-coreui-target="#staticBackdrop1">Thêm chuyên ngành</button>
            <table class="table table-striped table-responsive table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên chuyên ngành</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($majors as $major)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $major->major_name }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-2">
                                        <form action="{{ route('aa-major-delete') }}" method="POST">
                                            @csrf
                                            <input name="class_id" hidden value="{{ $major->major_id }}">
                                            <button class="btn btn-danger">Xóa</button>
                                        </form>
                                    </div>
                                    <div class="col-3">
                                        <form action="{{ route('aa-major-edit') }}" method="GET">
                                            @csrf
                                            <input name="major_id" hidden value="{{ $major->major_id }}">
                                            <button class="btn btn-warning">Cập nhật</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Không có chuyên ngành</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop1" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Thêm chuyên ngành</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('aa-major-create') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input class="form-control" name="major_name" placeholder="Tên chuyên ngành" autocomplete="off" required>
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
