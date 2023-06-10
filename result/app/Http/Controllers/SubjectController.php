<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Subject;


class SubjectController extends Controller
{


    function __construct()
    {
         $this->middleware('permission:subject-list|add-subject|edit-subject|delete-subject', ['only' => ['index','store']]);
         $this->middleware('permission:add-subject', ['only' => ['create','store']]);
         $this->middleware('permission:edit-subject', ['only' => ['edit','update']]);
         $this->middleware('permission:delete-subject', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all_subjects = Subject::all();

        return View('subject.index')->with('allSubjects',$all_subjects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View('subject.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $subject = new Subject();
         $validator = Validator::make($request->all(), [
             'subject' => 'required|unique:subject',
             'subject_code' => 'required||min:4|unique:subject',
             'remark'=>'required',
         ]

     );

         if ($validator->fails()) {
             //$errors = $validator->errors();
            // return $errors->toJson();
            return redirect()->back()->withErrors($validator)
                                     ->withInput();

         } else{
         $subject->subject = $request->subject;
         $subject->subject_code = $request->subject_code;
         $subject->remark = $request->remark;
         $subject->save();
         if($subject != null){
             return redirect()->back()->with('status', 'Subject Registered Successfully!');
             }else{
                echo "something went wrong...";
             }
         }

        // echo "welcome here";

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
        $subject = Subject::find($id);

        return view('subject.edit')->with('subject',$subject);
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
        $this->validate($request, [
            'subject' => 'required',
            'subject_code' => 'required|min:4|unique:subject',
             'remark'=>'required',
        ]);

        $input = $request->all();


        $subject = Subject::find($id);
        $subject->update($input);

       return redirect()->route('subject.index')
         ->with('success', 'Subject updated successfully.');

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
        Subject::find($id)->delete();

        return redirect()->route('subject.index')
            ->with('success', 'Subject deleted successfully.');
    }
}
