<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subsection;
use App\Section;
use Illuminate\Support\Facades\Session;

class SubsectionController extends Controller
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
        return view('admin.subsections.index',['subsections'=>Subsection::orderBy('sequence_number')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Section::all()->count()>0) {
            $counts = Array();
            foreach (Section::all() as $section){
                $counts[$section->name] = $section->number_of_questions - Subsection::where('section_id',$section->id)->sum('number_of_questions');
            }
            return view('admin.subsections.create', ['sections' => Section::all(),'counts'=>$counts]);
        }
        else{
            Session::flash('info',"You've to add the section first");
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
            'section' => 'required',
            'number_of_questions' => 'required|max:10',
            'sequence_number' => 'required'
        ]);
        if(count(Subsection::all()->where('sequence_number',$request->sequence_number))>0){
            Session::flash('failure','The sequence number is reserved for another subsection');
            return redirect()->back();
        }
        $section = Section::find($request->section);
        $count = $section->number_of_questions - Subsection::where('section_id',$section->id)->sum('number_of_questions');
        if($count>=0){
            Subsection::create([
                'name' => $request->name,
                'section_id' => $request->section,
                'number_of_questions' => $request->number_of_questions,
                'sequence_number' => $request->sequence_number
            ]);
            Session::flash('success','Subsection created successfully');
            return redirect()->route('subsections.index');
        }
        else{
            Session::flash('failure','Failed! Question limit exceeds for this section');
            return redirect()->route('subsections.create');
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
        return view('admin.subsections.update',['subsection' => Subsection::find($id), 'sections' => Section::all()]);
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
        $this->validate($request, [
            'name' => 'required|max:255',
            'section' => 'required',
            'number_of_questions' => 'required|max:10',
            'sequence_number' => 'required'
        ]);
        $data = $request->all();
        $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        Subsection::find($id)->update($data);
        Session::flash('success','Subsection updated successfully');
        return redirect()->route('subsections.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subsection = Subsection::find($id);
        foreach($subsection->questions as $question){
            $question->delete();
        }
        $subsection->delete();
        Session::flash('success','Subsection deleted successfully');
        return redirect()->route('subsections.index');
    }
}
