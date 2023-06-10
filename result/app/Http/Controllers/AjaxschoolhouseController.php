<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schoolhouse;

class AjaxschoolhouseController extends Controller
{
    //

    public function delete($id)
    {
        //echo $id;
        Schoolhouse::find($id)->delete();


        return redirect()->route('schoolhouse.index')
            ->with('success', 'School house deleted successfully.');
        return response()->json(['message' => $id]);
    }
}
