<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schoolsession;

class AjaxsessionController extends Controller
{
    //
    public function delete($id)
    {
        //echo $id;
        Schoolsession::find($id)->delete();
        return response()->json(['message' => $id]);
    }
}
