<?php

namespace App\Http\Controllers;

use App\Models\Schoolterm;
use Illuminate\Http\Request;

class AjaxtermController extends Controller
{
    //


    public function delete($id)
    {
       // echo $id;
        Schoolterm::find($id)->delete();
        return response()->json(['message' => $id]);
    }
}
