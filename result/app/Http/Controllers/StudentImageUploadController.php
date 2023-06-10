<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Studentpicture;
use App\Models\student;

class StudentImageUploadController extends Controller
{



    function __construct()
    {
         $this->middleware('permission:student-picture-upload', ['only' => ['index','store']]);
         $this->middleware('permission:student-picture-upload', ['only' => ['create','store']]);
         $this->middleware('permission:student-picture-upload', ['only' => ['edit','update']]);

    }



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


        $request->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);



        $imageName = time().'.'.$request->image->extension();



        $request->image->move(public_path('images/studentpics'), $imageName);
        $id = $request->post('id');


        /* Store $imageName name in DATABASE from HERE */

        Studentpicture::where("studentid", $id)->update(["picture" => $imageName]);

        return back() ->with('success','You have successfully uploaded Student image.');
                      //->with('image',$imageName);
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
        $picture = Studentpicture::find($id);

        return view('studentImageUpload.index')->with('picture',$picture);
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
    }
}
