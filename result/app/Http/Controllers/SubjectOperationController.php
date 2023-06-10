<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Broadsheet;
use App\Models\Student;
use App\Models\Schoolclass;
use App\Models\Schoolterm;
use App\Models\Schoolsession;
USE App\Models\Subjectclass;
use App\Models\SubjectRegistrationStatus;


class SubjectOperationController extends Controller
{



    function __construct()
    {
         $this->middleware('permission:subject-operation-list|add-subject-operation|edit-subject-operation|delete-subject-operation', ['only' => ['index','store']]);
         $this->middleware('permission:add-subject-operation', ['only' => ['create','store']]);
         $this->middleware('permission:edit-subject-operation', ['only' => ['edit','update']]);
         $this->middleware('permission:delete-subject-operation', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::leftJoin('parentRegistration', 'parentRegistration.id','=','studentRegistration.id')
                         ->leftJoin('studentpicture','studentpicture.studentid','=','studentRegistration.id')
                         ->leftJoin('promotionStatus','promotionStatus.studentId','=','studentRegistration.id')
        ->get(['studentRegistration.id as id','studentRegistration.admissionNo as admissionNo','studentRegistration.firstname as firstname',
        'studentRegistration.lastname as lastname','studentRegistration.dateofbirth as dateofbirth','studentRegistration.gender as gender',
    'studentRegistration.updated_at as updated_at','studentpicture.picture as picture','promotionStatus.studentId as studentID',
    'promotionStatus.schoolclassid as schoolclassid','promotionStatus.termid as termid','promotionStatus.sessionid as sessionid',
    'promotionStatus.promotionStatus as pstatus','promotionStatus.classstatus as cstatus']);



        $schoolclass = Schoolclass::all();
        $schoolterm = Schoolterm::all();
        $schoolsession = Schoolsession::all();

        return view('subjectoperation.index')->with('student',$student)
                                    ->with('schoolclass',$schoolclass)
                                    ->with('schoolterm',$schoolterm)
                                    ->with('schoolsession', $schoolsession);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function subjectinfo($id,$schoolclassid,$sessionid,$termid){
        $staffid="";
        $subjectclassid="";
        $current = "Current";
        $subjectclass = Subjectclass::where('schoolclassid',$schoolclassid )
        ->leftJoin('subjectteacher','subjectteacher.id','=','subjectclass.subjectteacherid')
        ->leftJoin('subject','subject.id','=','subjectteacher.subjectid')
        ->leftJoin('schoolsession','schoolsession.id','=','subjectteacher.sessionid')
        ->where('schoolsession.status','=',$current)
        ->leftJoin('schoolterm','schoolterm.id','=','subjectteacher.termid')
        ->leftJoin('users','users.id','=','subjectteacher.staffid')
        ->leftJoin('staffbioinfo', 'staffbioinfo.userid','=','users.id')
        ->leftJoin('staffpicture', 'staffpicture.staffid','=','users.id')
        ->get(['users.id as userid','staffbioinfo.title as title','users.name as name','staffpicture.picture as picture',
        'subject.id as subjectid','subject.subject as subject','users.id as staffid',
        'subject.subject_code as subjectcode','schoolterm.term as term','subjectclass.id as subjectclassid',
        'schoolsession.session as session', 'schoolsession.id as sessionid','schoolterm.id as termid']);

        $totalreg = subjectclass::where('schoolclassid',$schoolclassid)
        ->leftJoin('subjectteacher','subjectteacher.id','=','subjectclass.subjectteacherid')
        ->leftJoin('subject','subject.id','=','subjectteacher.subjectid')
        ->leftJoin('schoolsession','schoolsession.id','=','subjectteacher.sessionid')
        ->leftJoin('schoolterm','schoolterm.id','=','subjectteacher.termid')
        ->where('schoolsession.status','=',$current)->count();

        $reg = broadsheet::where('studentId',$id)
        ->leftJoin('subjectteacher','subjectteacher.id','=','broadsheet.staffid')
        ->leftJoin('subjectclass','subjectclass.id','=','broadsheet.subjectclassid')
        ->leftJoin('schoolsession','schoolsession.id','=','broadsheet.session')
        ->where('schoolsession.status','=',$current)
        ->leftJoin('schoolterm','schoolterm.id','=','broadsheet.termid')->count();
        $noreg = $totalreg - $reg;



        $studentdata = Student::where('id',$id)->get();
        $classname = Schoolclass::where('id',$schoolclassid)->get();
        //$schoolsession = schoolsession::where('id',$sessionid)->get();


        return view('subjectoperation.subjectinfo')
                     ->with('classname',$classname)
                     ->with('subjectclass',$subjectclass)
                    ->with('schoolterm',$termid)
                    ->with('schoolsession', $sessionid)
                    ->with('student', $id)
                    ->with('studentdata', $studentdata)
                    ->with('totalreg', $totalreg)
                    ->with('reg', $reg)
                    ->with('noreg', $noreg);


    }


    public function create(Request $request)
    {
        //
       echo  $request->input('sessionid');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $broadsheet = new Broadsheet();
        $subjectregstatus = new SubjectRegistrationStatus();
        $broadsheetchk = Broadsheet::where('studentId',$request->input('studentid'))
                                    ->where('staffid',$request->input('staffid'))
                                    ->where('subjectclassid',$request->input('subjectclassid'))
                                    ->where('termid',$request->input('termid'))
                                    ->where('session',$request->input('sessionid'))
                                    ->exists();
        if($broadsheetchk){

            return redirect()->back()->with('success', 'Subject already registered.');
        }
        else{
            $broadsheet->studentId = $request->input('studentid');
            $broadsheet->staffid = $request->input('staffid');
            $broadsheet->subjectclassid = $request->input('subjectclassid');
            $broadsheet->termid = $request->input('termid');
            $broadsheet->session = $request->input('sessionid');
            $broadsheet->save();

            $subjectregstatus->broadsheetid = $broadsheet->id;
            $subjectregstatus->studentId = $request->input('studentid');
            $subjectregstatus->staffid = $request->input('staffid');
            $subjectregstatus->subjectclassid = $request->input('subjectclassid');
            $subjectregstatus->termid = $request->input('termid');
            $subjectregstatus->sessionid = $request->input('sessionid');
            $subjectregstatus->Status = 1;
            $subjectregstatus->save();
            return redirect()->back()->with('success', 'Subject has been registered.');

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
        subjectRegistrationStatus::where('broadsheetid',$id)->delete();
        broadsheet::find($id)->delete();

        return redirect()->back()->with('success', 'Subject has been uregistered successfully!.');
    }
}
