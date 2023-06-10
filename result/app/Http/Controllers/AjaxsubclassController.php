<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subjectclass;
USE App\Models\Broadsheet;
use App\Models\SubjectRegistrationStatus;

class AjaxsubclassController extends Controller
{


    public function index(){



    }

    public function delete($id)
    {
       // echo $id;
        Subjectclass::find($id)->delete();
        broadsheet::where('subjectclassid',$id)->delete();
        SubjectRegistrationStatus::where('subjectclassid',$id)->delete();
        return redirect()->route('subjectclass.index')
            ->with('success', 'Subject class deleted successfully.');
        return response()->json(['message' => $id]);
    }
}
