@extends('layouts.app')

@section('content')
    <div class="card">
        <h3>Bảng điểm của học sinh</h3>
        <div class="card-body">
            <table class="table table-striped table-responsive table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên Môn</th>
                        <th>Lần thi</th>
                        <th>Lý thuyết</th>
                        <th>Thực hành</th>
                        <th>ASM</th>
                        <th>Kết quả</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($points as $point)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $point->subject_name }}</td>
                            <td>{{ $point->exam_times }}</td>
                            <td contenteditable="true" class="editable" data-field="theory" oninput="checkMinMax(this, 0, 10)">
                                {{ $point->theory }}</td>
                            <td contenteditable="true" class="editable" data-field="practice"
                                oninput="checkMinMax(this, 0, 10)">{{ $point->practice }}</td>
                            <td contenteditable="true" class="editable" data-field="asm" oninput="checkMinMax(this, 0, 10)">
                                @php
                                $asmGrade = '';
                                $asm = $point->asm;
                                if ($asm === null) {
                                    $asmGrade = '';
                                } else {
                                    $asm = (int) $asm;

                                    switch ($asm) {
                                        case $asm < 5:
                                            $asmGrade = 'F';
                                            break;
                                        case $asm < 7:
                                            $asmGrade = 'P';
                                            break;
                                        case $asm < 9:
                                            $asmGrade = 'M';
                                            break;
                                        case $asm === 10:
                                            $asmGrade = 'D';
                                            break;
                                        default:
                                            flash()->addError('Thêm thất bại!');
                                            break;
                                    }
                                }
                            @endphp
                                {{ $asmGrade }}
                            </td>

                            @php
                                $result = '';
                                if (($point->theory >= 5 && $point->practice == null && $point->asm == null) || ($point->practice >= 5 && $point->theory == null && $point->asm == null) || ($point->asm >= 5 && $point->theory == null && $point->practice == null) || ($point->theory >= 5 && $point->practice >= 5 && $point->asm == null)) {
                                    $result = 0;
                                } elseif ($point->theory < 5 || $point->practice < 5 || $point->asm < 5) {
                                    $result = 1;
                                }
                                $point->result = $result;
                            @endphp
                            <td>{{ $point->result == 0 ? 'Qua môn' : 'Trượt' }}</td>

                            <td>
                                {{--                            <form action="{{ route('aa-point-edit') }}" method="GET"> --}}
                                {{--                                @csrf --}}
                                {{--                                <input name="point_id" hidden value="{{ $point->point_id }}"> --}}
                                {{--                                <button class="btn btn-warning">Nhập điểm</button> --}}
                                {{--                            </form> --}}
                                <button class="btn btn-primary" onclick="saveData(this)"
                                    data-point-id="{{ $point->point_id }}">Lưu</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function checkMinMax(element, min, max) {
            var value = parseFloat(element.textContent);
            if (isNaN(value) || value < min || value > max) {
                element.textContent = '';
                alert('Giá trị phải nằm trong khoảng từ ' + min + ' đến ' + max + '!');
            }
        }

        function saveData(button) {
            var row = button.closest('tr');
            var pointId = button.getAttribute('data-point-id');
            var fields = row.querySelectorAll('.editable');
            var data = {
                pointId: pointId,
            };

            fields.forEach(function(field) {
                var fieldName = field.getAttribute('data-field');
                var fieldValue = field.innerText.trim();
                data[fieldName] = fieldValue;
            });

            // Gửi dữ liệu đến phía server
            fetch('/save-point-data', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                })
                .then(function(response) {
                    location.reload();
                })
                .catch(function(error) {

                });
        }
    </script>
@endsection
