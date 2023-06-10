<?php

namespace App\Http\Controllers;


use App\Models\Academicinfo1;
use App\Models\Academicinfo2;
use App\Models\Academicinfo3;
use Illuminate\Http\Request;

class AcademicinfoController extends Controller
{
    /**
     * Display a listing of the resource.
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


      $submit  = $request->only(['institution', 'discipline','qualification','year','yearteaching']);
      $submit2 = $request->only(['institution2', 'discipline2','qualification2','year2','yearteaching2']);
      $submit3 = $request->only(['institution3', 'discipline3','qualification3','year3','yearteaching3']);


       $acad1 = AcademicInfo1::find($id);
       $acad2 = AcademicInfo2::find($id);
       $acad3 = AcademicInfo3::find($id);
       $acad1->update($submit);
       $acad2->update($submit2);
       $acad3->update($submit3);

        return redirect()->route('staff.edit',[$id])
       ->with('success', 'Staff Academic Data has been updated successfully.');
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
}
