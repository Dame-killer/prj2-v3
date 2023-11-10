<?php

namespace App\Http\Controllers\AA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;

class SubjectBTECController extends Controller
{
    function indexBTEC(){
        $subjects = DB::table('subjects')
        ->where('subjects.ep_id', '=', 1)
        ->join('education_programs', 'subjects.ep_id', '=', 'education_programs.ep_id')
        ->join('majors', 'subjects.major_id', '=', 'majors.major_id')
        ->select('subjects.*', 'education_programs.ep_name as ep_name', 'majors.major_name as major_name')
        ->paginate(5);
        $education_programs = DB::table('education_programs')->get();
        $majors = DB::table('majors')->get();
        return view('academic_affairs.subjects.index_BTEC', ['subjects' => $subjects, 'education_programs' => $education_programs, 'majors' => $majors]);
    }

    function createBTEC(Request $request){
        $subject_name = $request->input('subject_name');
        $exam_times = $request->input('exam_times');
        $major_name = $request->input('major_name');
        $result = DB::table('subjects')
            ->join('education_programs', 'subjects.ep_id', '=', 'education_programs.ep_id')
            ->join('majors', 'education_programs.major_id', '=', 'majors.major_id')
            ->select('subjects.*', 'education_programs.ep_name as ep_name', 'majors.major_name as major_name')
            ->insert([
                'subject_name' => $subject_name,
                'exam_times' => $exam_times,
                'ep_id' => 1,
                'major_id' => $major_name
            ]);
        if($result){
            flash()->addSuccess('Thêm thành công!');
            return redirect()->route('aa-subject-BTEC');
        }else {
            flash()->addError('Thêm thất bại!');
            return redirect()->route('aa-subject-BTEC');
        }
    }

    function deleteBTECById(Request $request){
        $subject_id = $request->input('subject_id');
        $result = DB::table('subjects')->where('subject_id', '=', $subject_id)->delete();
        if($result){
            flash()->addSuccess('Xóa thành công!');
            return redirect()->route('aa-subject-BTEC');
        }else {
            flash()->addError('Xóa thất bại!');
            return redirect()->route('aa-subject-BTEC');
        }
    }

    function updateBTECById(Request $request){
        $subject_id = $request->input('subject_id');
        $subject_name = $request->input('subject_name');
        $exam_times = $request->input('exam_times');
        $major_name = $request->input('major_name');
        $result = DB::table('subjects')->where('subject_id', '=', $subject_id)->update([
            'subject_name' => $subject_name,
            'exam_times' => $exam_times,
            'major_id' => $major_name
        ]);
        if($result){
            flash()->addSuccess('Cập nhật thành công!');
            return redirect()->route('aa-subject-BTEC');
        }else {
            flash()->addError('Cập nhật thất bại!');
            return redirect()->route('aa-subject-BTEC');
        }
    }

    function editBTEC(Request $request){
        $subject_id = $request->input('subject_id');
        $subjects = DB::table('subjects')
        ->join('education_programs', 'subjects.ep_id', '=', 'education_programs.ep_id')
        ->join('majors', 'subjects.major_id', '=', 'majors.major_id')
        ->select('subjects.*', 'education_programs.ep_name as ep_name', 'majors.major_name as major_name')
        ->where('subject_id', '=', $subject_id)->get();
        $education_programs = DB::table('education_programs')->get();
        $majors = DB::table('majors')->get();
        return view('academic_affairs.subjects.edit_BTEC', ['subjects' => $subjects, 'education_programs' => $education_programs, 'majors' => $majors]);
    }
}
