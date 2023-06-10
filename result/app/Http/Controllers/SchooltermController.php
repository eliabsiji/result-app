<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schoolterm;

class SchooltermController extends Controller
{


    function __construct()
    {
         $this->middleware('permission:term-list|add-term|edit-term|delete-term', ['only' => ['index','store']]);
         $this->middleware('permission:add-term', ['only' => ['create','store']]);
         $this->middleware('permission:edit-term', ['only' => ['edit','update']]);
         $this->middleware('permission:delete-term', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $terms = Schoolterm::all();
        return view('term.index')->with('terms',$terms);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('term.create');
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
        $input = $request->all();
        $checkterm = Schoolterm::where('term',$request->input('term'))->exists();
        if($checkterm){
            return redirect()->route('term.index')
            ->with('danger', 'Ooops, Term is already taken');

        }else{
            Schoolterm::create($input);
            return redirect()->route('term.index')
            ->with('success', 'Term has been Created Successfuly');
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
        $term = Schoolterm::find($id);

        return view('term.edit')->with('term',$term);
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

        $checkterm = Schoolterm::where('term',$request->input('term'))->exists();
        if($checkterm){
            return redirect()->route('create.index')
            ->with('danger', 'Ooops, Term is already taken');

        }else{

            $term = Schoolterm::find($id);
            $input= $request->all();
            $term->update($input);
            return redirect()->route('create.index')
            ->with('success', 'Term has been Edited Successfuly');
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
        Schoolterm::find($id)->delete();

        return redirect()->route('term.index')
            ->with('success', 'School Term deleted successfully.');
    }
}
