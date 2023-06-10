<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subjectteacher;

class AjaxsubController extends Controller
{


    public function index(){



    }

    public function delete($id)
    {
       // echo $id;
        Subjectteacher::find($id)->delete();
        return response()->json(['message' => $id]);
    }
}
