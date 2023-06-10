<?php

namespace App\Http\Controllers;

use App\Models\Broadsheet;
use App\Models\ParentRegistration;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Schoolclass;
use App\Models\Schoolterm;
use App\Models\Schoolsession;
use App\Models\Studentclass;
USE App\Models\Promotionstatus;
use App\Models\Studentpicture;
use App\Models\Studenthouse;
use App\Models\studentpersonalityprofile;
use App\Models\SubjectRegistrationStatus;


class StudentController extends Controller
{



    function __construct()
    {
         $this->middleware('permission:student-list|add-student|edit-student|delete-student', ['only' => ['index','store']]);
         $this->middleware('permission:add-student', ['only' => ['create','store']]);
         $this->middleware('permission:edit-student', ['only' => ['edit','update']]);
         $this->middleware('permission:delete-student', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        $student = Student::leftJoin('parentRegistration', 'parentRegistration.id','=','studentRegistration.id')
                         ->leftJoin('studentpicture','studentpicture.studentid','=','studentRegistration.id')
                         ->leftJoin('studenthouses','studenthouses.studentid','=','studentRegistration.id')
                         ->leftJoin('schoolhouses','schoolhouses.id','=','studenthouses.schoolhouse')
                        ->get(['studentRegistration.id as id','studentRegistration.admissionNo as admissionNo',
                               'studentRegistration.firstname as firstname','schoolhouses.house as house',
                              'studentRegistration.lastname as lastname','studentRegistration.dateofbirth as dateofbirth','studentRegistration.gender as gender',
                              'studentRegistration.updated_at as updated_at','studentpicture.picture as picture']);

        $schoolclass = Schoolclass::all();
        $schoolterm = Schoolterm::all();
        $schoolsession = Schoolsession::all();

        return view('student.index')->with('student',$student)
                                    ->with('schoolclass',$schoolclass)
                                    ->with('schoolterm',$schoolterm)
                                    ->with('schoolsession', $schoolsession);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $studentbiodata = new Student();
        $studentclass = new Studentclass();
        $promotion = new Promotionstatus();
        $parent = new ParentRegistration();
        $picture = new Studentpicture();
        $studenthouse = new Studenthouse();
        $studentpersonalityprofile = new Studentpersonalityprofile();
        $broadsheet = new Broadsheet();

        $studentcheck = Student::where('admissionNo',$request->admissionNo)
                                ->exists();


        if ($studentcheck){

            return redirect()->back()->with('danger', 'Ooops! Record already exist! OR Adminssion Number Registered already.');
            }else{

               //for student biodata...
               $studentbiodata->admissionNo = $request->admissionNo;
               $studentbiodata->tittle = $request->title;
               $studentbiodata->firstname = $request->firstname;
               $studentbiodata->lastname = $request->lastname;
               $studentbiodata->othername = $request->othername;
               $studentbiodata->gender = $request->gender;
               $studentbiodata->home_address = $request->home_address;
               $studentbiodata->home_address2 = $request->home_address;
               $studentbiodata->dateofbirth = $request->dateofbirth;
               $studentbiodata->placeofbirth = $request->placeofbirth;
               $studentbiodata->religion = $request->religion;
               $studentbiodata->nationlity = $request->nationality;
               $studentbiodata->state = $request->state;
               $studentbiodata->local = $request->local;
               $studentbiodata->last_school = $request->last_school;
               $studentbiodata->last_class = $request->last_class;
               $studentbiodata->save();
               $studentId = $studentbiodata->id;

               // for parent....
               $parent->studentId = $studentId;
               $parent->father_title ="";
               $parent->mother_title ="";
               $parent->father  ="";
               $parent->mother ="";
               $parent->father_phone ="";
               $parent->mother_phone ="";
               $parent->parent_address ="";
               $parent->office_address ="";
               $parent->father_occupation ="";
               $parent->religion ="";
               $parent->save();

               //for student class

               $studentclass->studentId = $studentId;
               $studentclass->schoolclassid = $request->schoolclassid;
               $studentclass->termid = $request->termid;
               $studentclass->sessionid = $request->sessionid;


               $studentclass->save();

               //for class history...
               $promotion->studentId = $studentId;
               $promotion->schoolclassid = $request->schoolclassid;
               $promotion->termid = $request->termid;
               $promotion->sessionid = $request->sessionid;
               $promotion->promotionStatus = "PROMOTED";
               $promotion->classstatus = "CURRENT";

               $promotion->save();


               //for student picture...
               $picture->studentid = $studentId;
               $picture->save();

                //for student house...
                $studenthouse->studentid = $studentId;
                $studenthouse->termid = $request->termid;
                $studenthouse->sessionid = $request->sessionid;
                $studenthouse->save();

                //for student personality profile...
                $studentpersonalityprofile->studentid = $studentId;
                $studentpersonalityprofile->schoolclassid = $request->schoolclassid;
                $studentpersonalityprofile->termid = $request->termid;
                $studentpersonalityprofile->sessionid = $request->sessionid;
                $studentpersonalityprofile->save();





           if($studentbiodata != null){

            return redirect()->back()->with('success', 'Student Details captured  Successfully!!');

            }else{

            return redirect()->back()->with('status', 'Something went wrong!');
            }

         }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $student = student::where('studentRegistration.id', $id)
                         ->leftJoin('parentRegistration', 'parentRegistration.studentId','=','studentRegistration.id')
                         ->leftJoin('studentpicture','studentpicture.studentid','=','studentRegistration.id')
                         ->leftJoin('studentclass','studentclass.studentId','=','studentRegistration.id')
                         ->leftJoin('schoolclass','schoolclass.id','=','studentclass.schoolclassid')
                         ->leftJoin('schoolterm','schoolterm.id','=','studentclass.termid')
                         ->leftJoin('schoolsession','schoolsession.id','=','studentclass.sessionid')
        ->get(['studentRegistration.id as sid','studentRegistration.admissionNo as admissionNo','studentRegistration.tittle as title','studentRegistration.firstname as firstname',
        'studentRegistration.lastname as lastname','studentRegistration.othername as othername','studentRegistration.dateofbirth as dob',
        'studentRegistration.gender as gender','studentRegistration.placeofbirth as pob','studentRegistration.home_address as homeadd',
        'studentRegistration.home_address2 as homeadd2','studentRegistration.religion as religion','studentRegistration.nationlity as nation',
        'studentRegistration.state as state','studentRegistration.local as local','studentRegistration.last_school as lastsch','studentRegistration.last_class as lastclass',
        'studentRegistration.updated_at as updated_at','studentRegistration.tittle as title','studentpicture.picture as picture',
      'studentclass.schoolclassid as sclassid', 'schoolclass.schoolclass as schoolclass','schoolclass.arm as arm','schoolterm.term as term','studentclass.termid as termid','studentclass.sessionid as sessionid','schoolsession.session as session']);


        $schoolclass = Schoolclass::all();
        $schoolterm = Schoolterm::all();
        $schoolsession = Schoolsession::all();


        return view('student.edit')->with('student',$student)
                                   ->with('schoolclass',$schoolclass)
                                  ->with('schoolterm',$schoolterm)
                                 ->with('schoolsession', $schoolsession);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $studentbiodata = student::find($id);
        $studentclass =   studentclass::find($id);
        $promotion = promotionstatus::find($id);


        //for student biodata...
        $input = $request->only(['admissionNo', 'tittle','firstname','lastname','other','gneder','home_address','home_address2',
                                 'dateofbirth','placeofbirth','religion','nationality','state','local','last_school','last_class']);
         $studentbiodata->update($input);

        //for student class...
        $input2 = $request->only(['schoolclassid', 'termid','sessionid']);
         $studentclass->update($input2);
       // print_r($input2);


       //for  class promotion...
         $input3 = $request->only(['schoolclassid', 'termid','sessionid','PROMOTED','CURRENT']);
        // print_r($input3);
         $promotion->update($input3);



      // for broadsheet...
      if(broadsheet::Where('studentId',$id)->exists())
        broadsheet::Where('studentId',$id)->delete();

      // for subject registratio status...
      if(subjectRegistrationStatus::Where('studentId',$id)->exists())
        subjectRegistrationStatus::Where('studentId',$id)->delete();







      return redirect()->back()->with('success', 'Student updated  Successfully!!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        Student::find($id)->delete();
        Studentclass::where('studentId',$id)->delete();
        Promotionstatus::where('studentId',$id)->delete();
        ParentRegistration::where('studentId',$id)->delete();
        Studentpicture::where('studentid',$id)->delete();
        Broadsheet::where('studentId',$id)->delete();
        SubjectRegistrationStatus::where('studentId',$id)->delete();

        return redirect()->back()->with('success', 'Student data deleted Successfully!!');


    }
}
