<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectTeacher;
use App\Models\Subjectclass;

class AjaxsubteacherController extends Controller
{
    //

    public function delete($id)
    {
       // echo $id;
        Subjectteacher::find($id)->delete();
        Subjectclass::where('subjectteacherid',$id)->delete();

        return response()->json(['message' => $id]);
    }
}
