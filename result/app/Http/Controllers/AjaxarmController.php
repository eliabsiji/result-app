<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schoolarm;

class AjaxarmController extends Controller
{
    //
    public function delete($id)
    {
        //echo $id;
        Schoolarm::find($id)->delete();
        return response()->json(['message' => $id]);
    }
}
