<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schoolsession;


class SchoolsessionController extends Controller
{


    function __construct()
    {
         $this->middleware('permission:session-list|add-session|edit-session|delete-session', ['only' => ['index','store']]);
         $this->middleware('permission:add-session', ['only' => ['create','store']]);
         $this->middleware('permission:edit-session', ['only' => ['edit','update']]);
         $this->middleware('permission:delete-session', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $session = SchoolSession::all();
        return view('session.index')->with('sessions',$session);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('session.create');
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
        //$session = schoolSession::all();
        $checkCurrent = "Current";

        $sess = Schoolsession::where('status',$checkCurrent)->exists();
        if ($sess) {
          // User does not exist
           // echo "current exits";

            return redirect()->route('session.index')
            ->with('danger', 'Hello. A session already has CURRENT  as status.If you want to create a new session, change the rest  status to be PAST');


        } else {

         $s = Schoolsession::where('session',$request->input('session'))->exists();

         if($s){
            return redirect()->route('session.index')
            ->with('danger', 'Ooops. This Session  is Already taken...');
         }else{

            $input = $request->all();
            SchoolSession::create($input);
         return redirect()->route('session.index')
         ->with('success', 'School Session added successfully.');
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
        $session = Schoolsession::find($id);
        return view('session.edit')->with('session',$session);
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

        $checkCurrent = "Current";
        $cid = "";
        $session = Schoolsession::find($id);
        $input= $request->all();

        $sessionchk = Schoolsession::where('status',$checkCurrent)->get();

            foreach($sessionchk as $s){
          $cid =  $s-> id;
            }
        if ($id == $cid){
            $session = Schoolsession::find($id);
            $input= $request->all();
             $session->update($input);

            return redirect()->route('session.index')
             ->with('success', 'School Session has been updated successfully.');


        }else{
            $schk = Schoolsession::where('status',$checkCurrent)->exists();
            if ($schk){
                return redirect()->route('session.index')
                ->with('danger', 'School Session with CURRENT status already exists.');
            }else{
                $session = Schoolsession::find($id);
                $input= $request->all();
                 $session->update($input);
                return redirect()->route('session.index')
                ->with('success', 'School Session has been updated successfully.');
            }


        }




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
        Schoolsession::find($id)->delete();

        return redirect()->route('session.index')
            ->with('success', 'School Session deleted successfully.');
    }
}
