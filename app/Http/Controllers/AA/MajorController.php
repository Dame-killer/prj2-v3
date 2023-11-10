<?php

namespace App\Http\Controllers\AA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MajorController extends Controller
{
    function index(){
        $majors = DB::table('majors')->get();
        return view('academic_affairs.majors.index', ['majors' => $majors]);
    }

    function createMajor(Request $request){
        $major_name = $request->input('major_name');
        $result = DB::table('majors')->insert([
            'major_name' => $major_name
        ]);
        if($result){
            flash()->addSuccess('Thêm thành công!');
            return redirect()->route('aa-major');
        }else {
            flash()->addError('Thêm thất bại!');
            return redirect()->route('aa-major');
        }
    }

    function deleteMajorById(Request $request){
        $major_id = $request->input('major_id');
        $result = DB::table('majors')->where('major_id', '=', $major_id)->delete();
        if($result){
            flash()->addSuccess('Xóa thành công!');
            return redirect()->route('aa-major');
        }else {
            flash()->addError('Xóa thất bại!');
            return redirect()->route('aa-major');
        }
    }

    function updateMajorById(Request $request){
        $major_id = $request->input('major_id');
        $major_name = $request->input('major_name');
        $result = DB::table('majors')->where('major_id', '=', $major_id)->update([
            'major_name' => $major_name
        ]);
        if($result){
            flash()->addSuccess('Cập nhật thành công!');
            return redirect()->route('aa-major');
        }else {
            flash()->addError('Cập nhật thất bại!');
            return redirect()->route('aa-major');
        }
    }

    function edit(Request $request){
        $major_id = $request->input('major_id');
        $majors = DB::table('majors')->where('major_id', '=', $major_id)->get();
        return view('academic_affairs.majors.edit', ['majors' => $majors]);
    }
}
