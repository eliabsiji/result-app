<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Schoolclass;
use App\Models\User;
use App\Models\Subject;
use App\Models\Student;
use App\Models\ParentRegistration;
use App\Models\Promotionstatus;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $schoolclass = Schoolclass::all()->count();
       // $staff = Staff::all()->count();
        $staff = User::whereHas('roles', function($q){ $q->where('name', '!=','Student');})->count();
        $student = Student::all()->count();
        $parent = ParentRegistration::all()->count();
        $subject = Subject::all()->count();

        //$toppers = Promotionstatus::
        return view('pages.dashboard')->with('schoolclass',$schoolclass)
                                      ->with('staff',$staff)
                                      ->with('student',$student)
                                      ->with('parent',$parent)
                                      ->with('subject',$subject);
    }
}
