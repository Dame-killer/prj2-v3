<?php

namespace App\Http\Controllers\AA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    function index(){
        $classes = DB::table('classes')
        ->join('majors', 'classes.major_id', '=', 'majors.major_id')
        ->select('classes.*', 'majors.major_name as major_name')->paginate(5);
        $majors = DB::table('majors')->get();
        return view('academic_affairs.classes.index', ['classes' => $classes, 'majors' => $majors]);
    }

    function createClass(Request $request){
        $class_name = $request->input('class_name');
        $school_year = $request->input('school_year');
        $major_name = $request->input('major_name');
        $result = DB::table('classes')->join('majors', 'classes.major_id', '=', 'majors.major_id')
        ->select('classes.*', 'majors.major_name as major_name')->insert([
            'class_name' => $class_name,
            'school_year' => $school_year,
            'major_id' => $major_name
        ]);
        if($result){
            flash()->addSuccess('Thêm thành công!');
            return redirect()->route('aa-class');
        }else {
            flash()->addError('Thêm thất bại!');
            return redirect()->route('aa-class');
        }
    }

    function deleteClassById(Request $request){
        $class_id = $request->input('class_id');
        $result = DB::table('classes')->where('class_id', '=', $class_id)->delete();
        if($result){
            flash()->addSuccess('Xóa thành công!');
            return redirect()->route('aa-class');
        }else {
            flash()->addError('Xóa thất bại!');
            return redirect()->route('aa-class');
        }
    }

    function updateClassById(Request $request)
    {
        $class_id = $request->input('class_id');
        $class_name = $request->input('class_name');
        $school_year = $request->input('school_year');
        $major_name = $request->input('major_name');
        $result = DB::table('classes')->where('class_id', '=', $class_id)->update([
            'class_name' => $class_name,
            'school_year' => $school_year,
            'major_id' => $major_name
        ]);
        if($result){
            flash()->addSuccess('Cập nhật thành công!');
            return redirect()->route('aa-class');
        }else {
            flash()->addError('Cập nhật thất bại!');
            return redirect()->route('aa-class');
        }
    }

    function edit(Request $request){
        $class_id = $request->input('class_id');
        $classes = DB::table('classes')
        ->join('majors', 'classes.major_id', '=', 'majors.major_id')
        ->select('classes.*', 'majors.major_name as major_name')
        ->where('class_id', '=', $class_id)->get();
        $majors = DB::table('majors')->get();
        return view('academic_affairs.classes.edit', ['classes' => $classes, 'majors' => $majors]);
    }
}
