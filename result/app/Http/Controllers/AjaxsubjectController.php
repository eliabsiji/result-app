<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class AjaxsubjectController extends Controller
{
    //

    public function delete($id)
    {
       // echo $id;
        Subject::find($id)->delete();
        return response()->json(['message' => $id]);
    }
}
