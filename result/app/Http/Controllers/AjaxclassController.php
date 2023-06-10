<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schoolclass;
use App\Models\ClassTeacher;

class AjaxclassController extends Controller
{
    //

    public function delete($id)
    {
        //
        Schoolclass::find($id)->delete();
        //classteacher::where('schoolclassid',$id)->delete();


        return response()->json(['message' => $id]);
    }
}
