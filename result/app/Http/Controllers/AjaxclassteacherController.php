<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassTeacher;
;

class AjaxclassteacherController extends Controller
{


    public function index(){



    }

    public function delete($id)
    {
        //echo $id;
        ClassTeacher::find($id)->delete();
        return response()->json(['message' => $id]);
    }
}
