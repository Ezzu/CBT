<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Section;
use Session;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.sections.index',['sections'=>Section::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Subject::all()->count()>0)
            return view('admin.sections.create',['subjects'=>Subject::all()]);
        else{
            Session::flash('info',"You've to add the subject first");
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'name' => 'required|max:255',
           'subject' => 'required',
            'number_of_questions' => 'required|max:50'
        ]);
        Section::create([
            'name' => $request->name,
            'subject_id' => $request->subject,
            'number_of_questions' => $request->number_of_questions
        ]);
        Session::flash('success','Section added successfully');
        return redirect()->route('sections.index');
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
        $section = Section::find($id);
        return view('admin.sections.update',['section'=>$section,'subjects'=>Subject::all()]);
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
        Section::destroy($id);
        Session::flash('success','Section deleted successfully');
        return redirect()->route('sections.index');
    }
}
