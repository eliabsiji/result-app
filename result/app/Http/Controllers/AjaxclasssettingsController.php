<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassTeacher;
use App\Models\Staffclasssetting;

;

class AjaxclasssettingsController extends Controller
{


    public function index(){



    }

    public function delete($id)
    {
        //echo $id;
        Staffclasssetting::find($id)->delete();
        return response()->json(['message' => $id]);
    }
}
