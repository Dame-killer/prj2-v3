<?php

namespace App\Http\Controllers\AA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AaStudentController extends Controller
{
    function index(){
        $users = DB::table('users')
        ->where('role', '=', 0)
        ->join('classes', 'users.class_id', '=', 'classes.class_id')
        ->select('users.*', 'classes.*')->paginate(5);
        $classes = DB::table('classes')->get();
        return view('academic_affairs.students.index', ['users' => $users, 'classes' => $classes]);
    }

    function createStudent(Request $request){
        $name = $request->input('name');
        $student_code = $request->input('student_code');
        $email = $request->input('email');
        $password = $request->input('password');
        $hashedPassword = Hash::make($password);
        $class_name = $request->input('class_name');
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                Rule::unique('users')
            ],
            'student_code' => [
                'required',
                Rule::unique('users')
            ],
        ]);
        if ($validator->fails()) {
            flash()->addError('Thêm thất bại!');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $result = DB::table('users')->join('classes', 'users.class_id', '=', 'classes.class_id')
            ->select('users.*', 'classes.*')->insert([
                'name' => $name,
                'student_code' => $student_code,
                'email' => $email,
                'password' => $hashedPassword,
                'class_id' => $class_name
            ]);
        if($result){
            flash()->addSuccess('Thêm thành công!');
            return redirect()->route('aa-student');
        }
    }

    function deleteStudentById(Request $request){
        $id = $request->input('id');
        $result = DB::table('users')->where('id', '=', $id)->delete();
        if($result){
            flash()->addSuccess('Xóa thành công!');
            return redirect()->route('aa-student');
        }else {
            flash()->addError('Xóa thất bại!');
            return redirect()->route('aa-student');
        }
    }

    function updateStudentById(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $student_code = $request->input('student_code');
        $email = $request->input('email');
        $class_name = $request->input('class_name');
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                Rule::unique('users')
            ],
            'student_code' => [
                'required',
                Rule::unique('users')
            ],
        ]);
        if ($validator->fails()) {
            flash()->addError('Cập nhật thất bại!');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $result = DB::table('users')->where('id', '=', $id)->update([
            'name' => $name,
            'student_code' => $student_code,
            'email' => $email,
            'class_id' => $class_name
        ]);
        if($result){
            flash()->addSuccess('Cập nhật thành công!');
            return redirect()->route('aa-student');
        }else{
            flash()->addError('Cập nhật thất bại!');
            return redirect()->route('aa-student');
        }
    }

    function edit(Request $request){
        $id = $request->input('id');
        $users = DB::table('users')
            ->join('classes', 'users.class_id', '=', 'classes.class_id')
            ->select('users.*', 'classes.class_name as class_name')->where('id', '=', $id)->get();
        $classes = DB::table('classes')->get();
        return view('academic_affairs.students.edit', ['users' => $users, 'classes' => $classes]);
    }

    function showPoint(Request $request){
        $id = $request->input('id');
        $points = DB::table('points')
        ->join('class_subject_students', 'points.css_id', '=', 'class_subject_students.css_id')
        ->join('users', 'class_subject_students.id', '=', 'users.id')
        ->join('class_subjects', 'class_subject_students.cs_id', '=', 'class_subjects.cs_id')
        ->join('classes', 'class_subjects.class_id', '=', 'classes.class_id')
        ->join('subjects', 'class_subjects.subject_id', '=', 'subjects.subject_id')
        ->where('class_subject_students.id', '=', $id)
        ->select('points.*', 'class_subject_students.*', 'classes.*', 'class_subjects.*',  'subjects.*', 'users.*')->get();
        $classes = DB::table('classes')->get();
        $users = DB::table('users')->get();
        $class_subject_students = DB::table('class_subject_students')->get();
        $class_subjects = DB::table('class_subjects')->get();
        $subjects = DB::table('subjects')->get();
        // dd($id);
        return view('academic_affairs.students.point',['points' => $points, 'classes' => $classes,'users' => $users,'class_subject_students' => $class_subject_students,'class_subjects' => $class_subjects,'subjects' => $subjects ]);
    }
}
