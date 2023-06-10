<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


use App\Models\Broadsheet;
use App\Exports\RecordsheetExport;
use App\Imports\ScoresheetImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Promotionstatus;



class MyScoreSheetController extends Controller
{


    /**
     * Display a listing of the resource.s
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function subjectscoresheet($schoolclassid,$subjectclassid,$staffid,$termid,$sessionid){

        $current = "Current";

        // echo $schoolclassid;
        $Broadsheets = Broadsheet::where('subjectclassid',$subjectclassid)
        ->where('Broadsheet.staffid',$staffid)
        ->where('Broadsheet.termid',$termid)
        ->where('Broadsheet.session',$sessionid)
        ->leftJoin('subjectclass', 'subjectclass.id','=','Broadsheet.subjectclassid')
        ->leftJoin('schoolclass', 'schoolclass.id','=','subjectclass.schoolclassid')
        ->leftJoin('classcategories', 'classcategories.id','=','schoolclass.classcategoryid')
        ->leftJoin('subjectteacher','subjectteacher.id','=','subjectclass.subjectteacherid')
        ->leftJoin('subject', 'subject.id','=','subjectteacher.subjectid')
        ->leftJoin('schoolterm', 'schoolterm.id','=','subjectteacher.termid')
        ->leftJoin('schoolsession', 'schoolsession.id','=','subjectteacher.sessionid')
        ->where('schoolsession.status','=',$current)
        ->leftJoin('studentRegistration', 'studentRegistration.id','=','Broadsheet.studentId')
        ->leftJoin('studentpicture','studentpicture.studentid','=','studentRegistration.id')
        ->get(['Broadsheet.id as id','studentRegistration.admissionNO as admissionno','studentRegistration.firstname as fname','studentRegistration.lastname as lname',
              'subject.subject as subject','subject.subject_code as subjectcode','schoolclass.schoolclass as schoolclass','schoolclass.arm as arm',
              'schoolterm.term as term','schoolsession.session as session','subjectclass.id as subjectclid','Broadsheet.staffid as staffid',
              'Broadsheet.termid as termid','Broadsheet.session as sessionid','classcategories.ca2score as ca2',
              'classcategories.ca1score as ca1','classcategories.examscore as exam',
             'studentPicture.picture as picture','Broadsheet.ca1 as ca1','Broadsheet.ca2 as ca2','Broadsheet.exam as exam','Broadsheet.total  as total','Broadsheet.grade as grade',
            'Broadsheet.subjectpositionclass as position','Broadsheet.remark as remark'])->sortBy('admissionno');

            if($Broadsheets){
                    foreach($Broadsheets as $r){
                        $r->Broadsheetid;
                        $r->subjectclid;
                        $r->staffid;
                        $r->termid;
                        $r->sessionid;
                        }

                            //get minimun score....
                        $classmin = Broadsheet::where('subjectclassid',$subjectclassid)
                        ->where('Broadsheet.staffid',$staffid)
                        ->where('Broadsheet.termid',$termid)
                        ->where('Broadsheet.session',$sessionid)
                        ->min('total');

                       // echo (float)$classmin;


                        Broadsheet::where('subjectclassid',$subjectclassid)
                        ->where('Broadsheet.staffid',$staffid)
                        ->where('Broadsheet.termid',$termid)
                        ->where('Broadsheet.session',$sessionid)
                        ->update(array('cmin'=>$classmin));

                        //get maximun score....
                        $classmax = Broadsheet::where('subjectclassid',$subjectclassid)
                        ->where('Broadsheet.staffid',$staffid)
                        ->where('Broadsheet.termid',$termid)
                        ->where('Broadsheet.session',$sessionid)
                        ->max('total');
                        Broadsheet::where('subjectclassid',$subjectclassid)
                        ->where('Broadsheet.staffid',$staffid)
                        ->where('Broadsheet.termid',$termid)
                        ->where('Broadsheet.session',$sessionid)
                        ->update(array('cmax'=>$classmax));


                        //get average score...
                        $classavg = ($classmin + $classmax)/2;
                        Broadsheet::where('subjectclassid',$subjectclassid)
                        ->where('Broadsheet.staffid',$staffid)
                        ->where('Broadsheet.termid',$termid)
                        ->where('Broadsheet.session',$sessionid)
                        ->update(array('avg'=>round($classavg, 1)));




                        //calculating position in subject per class...
                        $rank = 0;
                        $last_score = false;
                        $rows = 0;
                        $position="";

                        $classpos = Broadsheet::select("*")
                        ->where('subjectclassid',$subjectclassid)
                        ->where('Broadsheet.staffid',$staffid)
                        ->where('Broadsheet.termid',$termid)
                        ->where('Broadsheet.session',$sessionid)
                       // ->orderBy('studentId','DESC')
                        ->orderBy('total','DESC')
                        ->get();

                            foreach ($classpos as $row){
                            $studentId =  $row->studentId;
                            $rows++;
                            if($last_score != $row->total){
                                $last_score = $row->total;
                                $rank = $rows;
                            }
                            if($rank == 1){
                                $position = "st";
                                }elseif ($rank == 2) {
                                $position = "nd";
                                }elseif ($rank== 3) {
                                $position = "rd";
                                }else{
                                $position = "th";
                                }

                                $rank_pos = $rank.$position;
                              //  echo "<br>";
                               // echo $row->studentId." "."$row->total"." ".gettype(strval($rank_pos))." "."<br>";

                            Broadsheet::where('subjectclassid',$subjectclassid)
                                ->where('Broadsheet.studentId',$studentId)
                                ->where('Broadsheet.staffid',$staffid)
                                ->where('Broadsheet.termid',$termid)
                                ->where('Broadsheet.session',$sessionid)
                                ->update(array('subjectpositionclass'=> $rank_pos));

                            }




                      //calculating position  per class...
                        $rank2 = 0;
                        $last_score2 = false;
                        $rows2 = 0;
                        $position2 ="";


                        $pos = Promotionstatus::where('schoolclassid',$schoolclassid)
                         ->leftJoin('schoolclass', 'schoolclass.id','=','promotionstatus.schoolclassid')
                         ->where('termid',$termid)
                         ->where('sessionid',$sessionid)
                         ->orderBy('subjectstotalscores','DESC')
                         ->get();


                           foreach ($pos as $row2){
                            $studentId2 =  $row2->studentId;
                            $rows2++;
                            if($last_score2 != $row2->subjectstotalscores){
                                $last_score2 = $row2->subjectstotalscores;
                                $rank2 = $rows2;
                            }
                            if($rank2 == 1){
                                $position2 = "st";
                                }elseif ($rank2 == 2) {
                                $position2 = "nd";
                                }elseif ($rank2== 3) {
                                $position2 = "rd";
                                }else{
                                $position2 = "th";
                                }

                                $rank_pos2 = $rank2.$position2;
                               // echo "<br>";
                               // echo $row2->studentId2." "."$row2->subjectstotalscores"." ".gettype(strval($rank_pos2))." "."<br>";

                              Promotionstatus::where('studentId',$studentId2)
                                ->leftJoin('schoolclass', 'schoolclass.id','=','promotionstatus.schoolclassid')
                                ->where('schoolclassid',$schoolclassid)
                                ->where('termid',$termid)
                                ->where('sessionid',$sessionid)
                                ->update(array('position'=> $rank_pos2));

                            }



                        Session::put('Broadsheetid',$r->Broadsheetid);
                        Session::put('schoolclassid',$schoolclassid);
                        Session::put('subjectclassid',$r->subjectclid);
                        Session::put('staffid', $r->staffid);
                        Session::put('termid', $r->termid);
                        Session::put('sessionid',$r->sessionid);


        }else{

            echo "ERROR 112O";
        }


          return view('subjectscoresheet.index')->with('broadsheets',$Broadsheets)
                ->with('s_Broadsheetid', Session::put('broadsheetid',$r->id))
                ->with('s_subjectclassid', Session::put('subjectclassid',$r->subjectclid))
                ->with('s_staffid', Session::put('staffid',$r->staffid))
                ->with('s_termid', Session::put('termid',$r->termid))
                ->with('s_sessionid', Session::put('sessionid',$r->sessionid));


    }


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
        echo "scoresheet here...";
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


       $current = "Current";
        $Broadsheets = Broadsheet::where('Broadsheet.id',$id)
        ->leftJoin('studentRegistration', 'studentRegistration.id','=','Broadsheet.studentId')
        ->leftJoin('studentpicture','studentpicture.studentid','=','studentRegistration.id')
        ->leftJoin('subjectclass', 'subjectclass.id','=','Broadsheet.subjectclassid')
        ->leftJoin('schoolclass', 'schoolclass.id','=','subjectclass.schoolclassid')
        ->leftJoin('classcategories', 'classcategories.id','=','schoolclass.classcategoryid')
        ->leftJoin('subjectteacher','subjectteacher.id','=','subjectclass.subjectteacherid')
        ->leftJoin('subject', 'subject.id','=','subjectteacher.subjectid')
        ->leftJoin('schoolterm', 'schoolterm.id','=','subjectteacher.termid')
        ->leftJoin('schoolsession', 'schoolsession.id','=','subjectteacher.sessionid')
        ->where('schoolsession.status','=',$current)
       ->get(['Broadsheet.id as bid','studentRegistration.admissionNO as admissionno','studentRegistration.tittle as title',
             'studentRegistration.firstname as fname','studentRegistration.lastname as lname',
             'studentPicture.picture as picture','Broadsheet.ca1 as ca1','Broadsheet.ca2 as ca2','Broadsheet.exam as exam',
             'Broadsheet.total  as total','Broadsheet.grade as grade', 'schoolterm.term as term','schoolsession.session as session',
             'subject.subject as subject','subject.subject_code as subjectcode','schoolclass.schoolclass as schoolclass',
             'schoolclass.arm as arm','Broadsheet.subjectpositionclass as position','Broadsheet.remark as remark','classcategories.ca2score as ca2',
             'classcategories.ca1score as ca1','classcategories.examscore as exam',])->sortBy('fname');


            if ($Broadsheets){
                $Broadsheet = Broadsheet::find($id);
                $studentid = $Broadsheet->studentId;
                $staffid = $Broadsheet->staffid;
                $subjectclassid = $Broadsheet->subjectclassid;
                $termid = $Broadsheet->termid;
                $sessionid = $Broadsheet->session;
                $ca1 = $Broadsheet->ca1;
                $ca2 = $Broadsheet->ca2;
                $exam = $Broadsheet->exam;
                $total = $Broadsheet->total;
                $remark = $Broadsheet->remark;
                $grade = $Broadsheet->grade;
               }else{
                echo "oppss..";
               }

            //get total score per subject per student and update...
            $all_subjects_total_score = Broadsheet::where('studentId',$studentid)
            ->where('staffid',$staffid)
            ->where('termid',$termid)
            ->where('session',$sessionid)->get();

            $search  = Broadsheet::where('studentId',$studentid)
             ->where('termid',$termid)
             ->where('session',$sessionid)->sum('total');

            Broadsheet::where('studentId',$studentid)
            ->where('termid',$termid)
            ->where('session',$sessionid)
            ->update(array('allsubjectstotalscores'=> $search));

           Promotionstatus::where('studentId',$studentid)
            ->leftJoin('schoolclass', 'schoolclass.id','=','promotionstatus.schoolclassid')
            ->join('subjectclass', function ($join) {$join->on('schoolclass.id', '=', 'subjectclass.schoolclassid');})
            ->where('termid',$termid)
            ->where('sessionid',$sessionid)
            ->update(array('subjectstotalscores'=> $search));



    return view('subjectscoresheet.edit')->with('broadsheets',$Broadsheets)
                                        ->with('session',Session::get('session'))
                                        ->with('studentid',$studentid)
                                        ->with('ca1', $ca1)
                                        ->with('ca2', $ca2)
                                        ->with('exam',$exam)
                                        ->with('total',$total)
                                        ->with('grade',$grade)
                                        ->with('remark',$remark);
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

        $Broadsheet = Broadsheet::find($id);
        $Broadsheet->update($request->all());
        $this->subjectscoresheet(Session::get('schoolclassid'),Session::get('subjectclassid'),Session::get('staffid'),Session::get('termid'),Session::get('sessionid'));

       return redirect()->back()->with('success', 'Score Editted  Successfully!!');

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
    }


    public function export(){
        $current = "Current";
        $subjectclassid =  Session::get('subjectclassid');
        $staffid = Session::get('staffid');
       $termid = Session::get('termid');
       $sessionid = Session::get('sessionid');


       $Broadsheets = Broadsheet::where('subjectclassid',$subjectclassid)
       ->where('Broadsheet.staffid',$staffid)
       ->where('Broadsheet.termid',$termid)
       ->where('Broadsheet.session',$sessionid)
       ->leftJoin('subjectclass', 'subjectclass.id','=','Broadsheet.subjectclassid')
       ->leftJoin('schoolclass', 'schoolclass.id','=','subjectclass.schoolclassid')
       ->leftJoin('subjectteacher','subjectteacher.id','=','subjectclass.subjectteacherid')
       ->leftJoin('users', 'users.id','=','subjectteacher.staffid')
       ->leftJoin('subject', 'subject.id','=','subjectteacher.subjectid')
       ->leftJoin('schoolterm', 'schoolterm.id','=','subjectteacher.termid')
       ->leftJoin('schoolsession', 'schoolsession.id','=','subjectteacher.sessionid')
       ->where('schoolsession.status','=',$current)
       ->leftJoin('studentRegistration', 'studentRegistration.id','=','Broadsheet.studentId')
       ->leftJoin('studentpicture','studentpicture.studentid','=','studentRegistration.id')



      ->get(['Broadsheet.id as bid','subject.subject as subject','subject.subject_code as subjectcode','schoolclass.schoolclass as schoolclass','schoolclass.arm as arm',
             'schoolterm.term as term','schoolsession.session as session','users.id as userid','users.name as staffname',

           ])->sortBy('fname');

           foreach($Broadsheets as $r){
               $r->schoolclass;
               $r->arm;
               $r->staffname;
               $r->term;
               $r->session;
               $r->subject;
               $r->subjecode;
           }
         $filename = $r->staffname."_".$r->subject.$r->subjeccode."_".$r->schoolclass.$r->arm."_".$r->term;

         return  Excel::download(new RecordsheetExport,$filename.'.xlsx' );
        // return redirect()->back()->with('success', 'Score Sheet downloaded successfully');

     }


     public function importform($schoolclassid,$subjectclassid,$staffid,$termid,$sessionid){

       // echo $subjectclassid. $staffid .$termid .$sessionid;
        return view('subjectscoresheet.importsheet')
                        //    ->with('Broadsheetid',$Broadsheetid)
                            ->with('schoolclassid',$schoolclassid)
                            ->with('subjectclassid',$subjectclassid)
                            ->with('staffid',$staffid)
                            ->with('termid',$termid)
                            ->with('sessionid',$sessionid);

     }

    public function importsheet(Request $request){
       // $Broadsheetid  = $request->Broadsheetid;
        $schoolclassid = $request->input('schoolclassid');
        $subjectclassid = $request->input('subjectclassid');
        $staffid = $request->input('staffid');
        $termid = $request->input('termid');
        $sessionid = $request->input('sessionid');
        $file =  $request->file('file');
        Excel::import(new ScoresheetImport(),$file );
        $this->subjectscoresheetpos($schoolclassid,$subjectclassid,$staffid,$termid,$sessionid);
        return redirect()->back()->with('success', 'Batch File Imported  Successfully');

    }

    public function subjectscoresheetpos($schoolclassid,$subjectclassid,$staffid,$termid,$sessionid){

        $current = "Current";

        // echo $schoolclassid;
        $Broadsheets = Broadsheet::where('subjectclassid',$subjectclassid)
        ->where('Broadsheet.staffid',$staffid)
        ->where('Broadsheet.termid',$termid)
        ->where('Broadsheet.session',$sessionid)
        ->leftJoin('subjectclass', 'subjectclass.id','=','Broadsheet.subjectclassid')
        ->leftJoin('schoolclass', 'schoolclass.id','=','subjectclass.schoolclassid')
        ->leftJoin('subjectteacher','subjectteacher.id','=','subjectclass.subjectteacherid')
        ->leftJoin('subject', 'subject.id','=','subjectteacher.subjectid')
        ->leftJoin('schoolterm', 'schoolterm.id','=','subjectteacher.termid')
        ->leftJoin('schoolsession', 'schoolsession.id','=','subjectteacher.sessionid')
        ->where('schoolsession.status','=',$current)
        ->leftJoin('studentRegistration', 'studentRegistration.id','=','Broadsheet.studentId')
        ->leftJoin('studentpicture','studentpicture.studentid','=','studentRegistration.id')



       ->get(['Broadsheet.id as id','studentRegistration.admissionNO as admissionno','studentRegistration.firstname as fname','studentRegistration.lastname as lname',
              'subject.subject as subject','subject.subject_code as subjectcode','schoolclass.schoolclass as schoolclass','schoolclass.arm as arm',
              'schoolterm.term as term','schoolsession.session as session','subjectclass.id as subjectclid','Broadsheet.staffid as staffid',
              'Broadsheet.termid as termid','Broadsheet.session as sessionid',
             'studentPicture.picture as picture','Broadsheet.ca1 as ca1','Broadsheet.ca2 as ca2','Broadsheet.exam as exam','Broadsheet.total  as total','Broadsheet.grade as grade',
            'Broadsheet.subjectpositionclass as position','Broadsheet.remark as remark'])->sortBy('admissionno');




        //calculating position in subject per class...
        $rank = 0;
        $last_score = false;
        $rows = 0;
        $position="";

        $classpos = Broadsheet::select("total")
        ->where('subjectclassid',$subjectclassid)
        ->where('Broadsheet.staffid',$staffid)
        ->where('Broadsheet.termid',$termid)
        ->where('Broadsheet.session',$sessionid)
        ->orderBy('total','DESC')->get();

        foreach ($classpos as $row){

            $studentId =  $row->studentId;
            $rows++;
            if($last_score != $row->total){

                $last_score = $row->total;
                $rank = $rows;

            }
            if($rank == 1){
                $position = "st";

                }elseif ($rank == 2) {
                  $position = "nd";

                }elseif ($rank== 3) {
                  $position = "rd";

                }else{
                  $position = "th";
                }

                $rank_pos = $rank.$position;

                //echo $studentId." "." ".$row->total.$rank_pos." "."<br>";
                Broadsheet::where('subjectclassid',$subjectclassid)
                ->where('Broadsheet.studentId',$studentId)
                ->where('Broadsheet.staffid',$staffid)
                ->where('Broadsheet.termid',$termid)
                ->where('Broadsheet.session',$sessionid)
                ->update(array('subjectpositionclass'=>$rank_pos));

        }


                      //calculating position  per class...
                      $rank2 = 0;
                      $last_score2 = false;
                      $rows2 = 0;
                      $position2 ="";


                      $pos = Promotionstatus::where('schoolclassid',$schoolclassid)
                       ->leftJoin('schoolclass', 'schoolclass.id','=','promotionstatus.schoolclassid')
                       ->where('termid',$termid)
                       ->where('sessionid',$sessionid)
                       ->orderBy('subjectstotalscores','DESC')
                       ->get();


                         foreach ($pos as $row2){
                          $studentId2 =  $row2->studentId;
                          $rows2++;
                          if($last_score2 != $row2->subjectstotalscores){
                              $last_score2 = $row2->subjectstotalscores;
                              $rank2 = $rows2;
                          }
                          if($rank2 == 1){
                              $position2 = "st";
                              }elseif ($rank2 == 2) {
                              $position2 = "nd";
                              }elseif ($rank2== 3) {
                              $position2 = "rd";
                              }else{
                              $position2 = "th";
                              }

                              $rank_pos2 = $rank2.$position2;
                             // echo "<br>";
                             // echo $row2->studentId2." "."$row2->subjectstotalscores"." ".gettype(strval($rank_pos2))." "."<br>";

                            Promotionstatus::where('studentId',$studentId2)
                              ->leftJoin('schoolclass', 'schoolclass.id','=','promotionstatus.schoolclassid')
                              ->where('schoolclassid',$schoolclassid)
                              ->where('termid',$termid)
                              ->where('sessionid',$sessionid)
                              ->update(array('position'=> $rank_pos2));

                          }



        }

}
