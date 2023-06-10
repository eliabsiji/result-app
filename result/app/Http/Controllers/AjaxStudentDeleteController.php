<?php

namespace App\Http\Controllers;


use App\Models\Broadsheet;
use App\Models\ParentRegistration;
use App\Models\Student;
use App\Models\studentclass;
USE App\Models\Promotionstatus;
use App\Models\Studentpicture;
use App\Models\SubjectRegistrationStatus;
use App\Models\Studentpersonalityprofile;
use App\Models\Studenthouse;

class AjaxStudentDeleteController extends Controller
{
    //

    public function index(){



    }


    public function delete($id)
    {
        //

        Student::find($id)->delete();
        Studentclass::where('studentId',$id)->delete();
        Promotionstatus::where('studentId',$id)->delete();
        ParentRegistration::where('studentId',$id)->delete();
        Studentpicture::where('studentid',$id)->delete();
        Broadsheet::where('studentId',$id)->delete();
        SubjectRegistrationStatus::where('studentid',$id)->delete();
        Studentpersonalityprofile::where('studentid',$id)->delete();
        Studenthouse::where('studentid',$id)->delete();


        return redirect()->back()->with('success', 'Student data deleted Successfully!!');


    }
}
