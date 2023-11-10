<?php

namespace App\Http\Controllers\AA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CSSController extends Controller{

    function index(){
        $class_subjects_students = DB::table('class_subjects_students')
        ->join('users', 'class_subjects_students.id', '=', 'users.id')
        ->join('class_subjects', 'class_subjects_students.cs_id', '=', 'class_subjects.cs_id')
        ->select('class_subjects_students.*', 'users.*','class_subjects.*')->paginate(5);
        $users = DB::table('classes')->get();
        $class_subjects = DB::table('subjects')->get();
        return view('academic_affairs.class-subject-student.index', ['class_subjects_students' => $class_subjects_students, 'users' => $users, 'subjects' => $class_subjects]);
    }

    function createCSS(Request $request){
        $class_name = $request->input('class_name');
        $subject_name = $request->input('subject_name');
        $result = DB::table('class_subjects')
        ->join('classes', 'class_subjects.class_id', '=', 'classes.class_id')
        ->join('subjects', 'class_subjects.subject_id', '=', 'subjects.subject_id')
        ->select('classes.*', 'subjects.*','class_subjects.*')->insert([
            'class_id' => $class_name,
            'subject_id' => $subject_name,
        ]);
        if($result){
            flash()->addSuccess('Thêm thành công!');
            return redirect()->route('aa-classes-subjects');
        }else {
            flash()->addError('Thêm thất bại!');
            return redirect()->route('aa-classes-subjects');
        }
    }

    function deleteCSSById(Request $request){
        $cs_id = $request->input('cs_id');
        $result = DB::table('class_subjects')->where('cs_id', '=', $cs_id)->delete();
        if($result){
            flash()->addSuccess('Xóa thành công!');
            return redirect()->route('aa-classes-subjects');
        }else {
            flash()->addError('Xóa thất bại!');
            return redirect()->route('aa-classes-subjects');
        }
    }

    function updateCSSById(Request $request)
    {
        $cs_id = $request->input('cs_id');
        $class_name = $request->input('class_name');
        $subject_name = $request->input('subject_name');
        $result = DB::table('class_subjects')->where('cs_id', '=', $cs_id)->update([
            'class_id' => $class_name,
            'subject_id' => $subject_name,
        ]);
        if($result){
            flash()->addSuccess('Cập nhật thành công!');
            return redirect()->route('aa-classes-subjects');
        }else {
            flash()->addError('Cập nhật thất bại!');
            return redirect()->route('aa-classes-subjects');
        }
    }

    function edit(Request $request){
        $cs_id = $request->input('cs_id');
        $class_subjects = DB::table('class_subjects')
        ->join('classes', 'class_subjects.class_id', '=', 'classes.class_id')
        ->join('subjects', 'class_subjects.subject_id', '=', 'subjects.subject_id')
        ->select('classes.*', 'class_subjects.*','subjects.*')
        ->where('cs_id', '=', $cs_id)->get();
        $subjects = DB::table('subjects')->get();
        $classes = DB::table('classes')->get();
        return view('academic_affairs.classes-subjects.edit', ['class_subjects' => $class_subjects, 'subjects' => $subjects,'classes' => $classes]);
    }
}
