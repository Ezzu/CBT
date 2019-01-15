<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Section;
use App\Subsection;
use App\Question;
use App\User;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home')->with('users_count',count(User::all()->where('role','!=','super')))
                        ->with('students_count',count(User::all()->where('role','=','student')))
                        ->with('specialists_count',count(User::all()->where('role','=','specialist')))
                        ->with('supervisors_count',count(User::all()->where('role','=','supervisor')))
                        ->with('subjects_count',count(Subject::all()))
                        ->with('sections_count',count(Section::all()))
                        ->with('subsections_count',count(Subsection::all()))
                        ->with('questions_count',count(Question::all()));
    }
}
