<?php

namespace App\Http\Controllers;

use App\Option;
use Illuminate\Http\Request;
use App\Subsection;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Array_;
use Session;
use App\Question;
use App\Set;
use App\Options;

class QuestionController extends Controller
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
        $questions = Question::orderBy('priority','desc')->get()->where('status','=','1');
        if(Auth::user()->id != '1')
            $questions->where('user_id', Auth::user()->id);
        return view('admin.questions.index',['questions'=> $questions,'status'=>'1','subsections'=>Subsection::orderBy('sequence_number')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Subsection::all()->count()>0)
            return view('admin.questions.create',['subsections'=>Subsection::all()]);
        else{
            Session::flash('info',"You've to add subsection first");
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
            'statement' => 'required',
            'optiona' => 'required',
            'optionb' => 'required',
            'optionc' => 'required',
            'optiond' => 'required',
            'subsection_id' => 'required',
            'difficulty_level' => 'required',
            'priority' => 'required',
            'maximum_age' => 'required'
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['user_time'] = \Carbon\Carbon::now()->toDateTimeString();

        if($request->hasFile('pre_image')){
            $file = $request->pre_image;
            $file_new_name = time().$file->getClientOriginalName();
            $file->move('uploads/pre_images/',$file_new_name);
            $data['pre_image'] = 'uploads/pre_images/'.$file_new_name;
        }
        if($request->hasFile('post_image')){
            $file = $request->post_image;
            $file_new_name = time().$file->getClientOriginalName();
            $file->move('uploads/post_images/',$file_new_name);
            $data['post_image'] = 'uploads/post_images/'.$file_new_name;
        }
        $question = Question::create($data);
        $question->users()->attach(Auth::user()->id);
        $option = Array();
        $option['a'] = Option::create(['option'=>$request->optiona]);
        $option['b'] = Option::create(['option'=>$request->optionb]);
        $option['c'] = Option::create(['option'=>$request->optionc]);
        $option['d'] = Option::create(['option'=>$request->optiond]);
        foreach($option as $opt){
            $opt->question_id = $question->id;
            $opt->save();
        }
        Session::flash('success','Question is sent for approval');
        return redirect()->route('questions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        return view('admin.questions.single',['question'=>$question]);
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

    public function toApprove(){
        return view('admin.questions.index',['questions'=>Question::orderBy('priority','desc')->get()->where('status','=','0'),'status'=>'0','subsections'=>Subsection::all()]);
    }

    public function approve($id){
        $question = Question::find($id);
        $question->status=1;
        $question->supervisor_id = Auth::user()->id;
        $question->supervisor_time = \Carbon\Carbon::now()->toDateTimeString();
        $question->save();
        $question->users()->attach(Auth::user()->id);
        Session::flash('success','Question approved successfully');
        return redirect()->route('questions.toApprove');
    }

    public function filter(Request $request){
        $this->validate($request,[
            'filter' => 'required'
        ]);
        return view('admin.questions.index',['questions'=>Question::orderBy('priority','desc')->get()->where('subsection_id','=',$request->filter)->where('status','=','1'),'status'=>'1','subsections'=>Subsection::all()]);
    }

    public function organizeFilter(Request $request){
        //finding count of every subsection whose question is added by the user in specific set
        $count = Array();
        foreach(Subsection::all() as $subsection){
            $count[$subsection->name] = 0;
            foreach($subsection->questions as $question){
                foreach ($question->sets as $set){
                    if($set->name==Auth::user()->set)
                        $count[$subsection->name] ++;
                }
            }
        }
        //the functionality end here
        $this->validate($request,[
            'filter' => 'required'
        ]);
        return view('admin.questions.organize',['questions'=>Question::orderBy('priority','desc')->get()->where('subsection_id','=',$request->filter)->where('status','=','1'),'status'=>'1','subsections'=>Subsection::all(),'counts'=>$count]);
    }

    public function toOrganize()
    {
        //finding count of every subsection whose question is added by the user in specific set
        $count = Array();
        foreach(Subsection::all() as $subsection){
            $count[$subsection->name] = 0;
            foreach($subsection->questions as $question){
                foreach ($question->sets as $set){
                    if($set->name==Auth::user()->set)
                        $count[$subsection->name] ++;
                }
            }
        }
        //the functionality end here
        return view('admin.questions.organize',['questions'=>Question::orderBy('priority','desc')->get()->where('status','=','1'),'status'=>'1','subsections'=>Subsection::orderBy('sequence_number')->get(),'counts'=>$count,'subsections'=>Subsection::orderBy('sequence_number')->get()]);
    }

    public function organize($id){
        $question = Question::find($id);
        $count=0;
        foreach($question->subsection->questions as $temp_question){
            foreach ($temp_question->sets as $set){
                if($set->name==Auth::user()->set)
                    $count++;
            }
        }
        if($question->subsection->number_of_questions <= $count){
            Session::flash('failure','Subsection exceeds the question limit');
            return redirect()->back();
        }
        $set_id = Set::select('id')->where('name','=',Auth::user()->set)->pluck('id');
        $question->sets()->attach($set_id);
        Session::flash('success','Question included in Test Set '.Auth::user()->set);
        return redirect()->back();
    }

    public function undo($id){
        Question::find($id)->sets()->detach();
        Session::flash('success','Question excluded from Test Set '.Auth::user()->set);
        return redirect()->back();
    }

    public function assignKey($qid,$oid){
        foreach(Option::all()->where('question_id','=',$qid) as $option){
            if($option->id==$oid)
                $option->key = 1;
            else
                $option->key = 0;
            $option->save();
        }
        return redirect()->back();
    }

}
