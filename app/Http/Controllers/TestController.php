<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Question;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Subsection;
use App\Set;
use App\OptionQuestionUser;
use App\User;
use App\SetQuestions;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($mode)
    {
        $selected_set = 0;
        $paper_questions = Array();
        if($mode){
            foreach (Set::all() as $set){
                if($set->name==Auth::user()->set)
                    $selected_set = $set->id;
            }
        }
        else {
            foreach (Set::all() as $set) {
                if ($set->selected == 1) {
                    $selected_set = $set->id;
                }
            }
        }
        foreach(Question::all() as $question){
            foreach($question->sets as $set){
                if($set->pivot->set_id==$selected_set){
                    $paper_questions[$question->id] = $question;
                }
            }
        }
        //dd(Auth::user()->activities()->find(14)->created_at->toW3cString());
        return view('admin.tests.index',['subsections'=>Subsection::orderBy('sequence_number')->get(),'option_question_user'=>OptionQuestionUser::all()->where('user_id','=',Auth::user()->id),'paper_questions'=>$paper_questions]);
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

    public function generated(){
        $set_id = Set::select('id')->where('name','=',Auth::user()->set)->pluck('id')->first();
        if(count(SetQuestions::all()->where('set_id','=',$set_id))!=Subsection::sum('number_of_questions')){
            Session::flash('failure','Question shortage in test found');
            return redirect()->back();
        }
        $activity_id = Activity::select('id')->where('name','=','Test Generated')->pluck('id')->first();
        if(count(Auth::user()->activities()->find($activity_id))==0){
            Auth::user()->activities()->attach($activity_id);
        }
        Session::flash('success','Test stored successfully');
        return redirect()->route('home');
    }

    public function mark(){
        $input = request()->all();
        OptionQuestionUser::create([
            'user_id'=>Auth::user()->id,
            'question_id'=>$input['q_id'],
            'option_id'=>$input['o_id']
        ]);
    }

    public function result(){
        $rough_result = OptionQuestionUser::all()->where('user_id','=',Auth::user()->id);
        $attempted = count($rough_result);
        $corrected=0;
        foreach($rough_result as $oqu){
            foreach(Question::all() as $question){
                if($oqu->question_id == $question->id){
                    foreach ($question->options as $option){
                        if($oqu->option_id==$option->id && $option->key==1){
                           $oqu->remarks= 'correct';
                           $oqu->save();
                           $corrected++;
                        }
                    }
                }
            }
        }
        return view('admin.tests.result',['attempted'=>$attempted,'corrected'=>$corrected]);
    }

    public function end(){
        $activity_id = Activity::select('id')->where('name','=','Test Ended')->pluck('id');
        $token_id = Activity::select('id')->where('name','=','Has Token')->pluck('id');
        if(count(Auth::user()->activities()->find($activity_id))==0){
            Auth::user()->activities()->attach($activity_id);
            Auth::user()->activities()->detach($token_id);
        }
        return redirect()->route('home');
    }

    public function settings(){
        $set_count=0;
        foreach(User::all() as $user){
            if($user->test_grant){
                $set_count++;
            }
        }
        $granted_users = User::select('id')->where('test_grant','=','1')->get();
        $all_set = true;
        $activity_id = Activity::select('id')->where('name','=','Test Generated')->pluck('id')->first();
        foreach ($granted_users as $user){
            if(count($user->activities()->find($activity_id))==0){
                $all_set = false;
            }
        }
        return view('admin.tests.settings',['set_count'=>$set_count,'selected'=>Set::select('id')->where('selected','=',true)->get()->pluck('id')->first(),'all_set'=>$all_set,'users'=>User::all()]);
    }

    public function set($set_id){
        foreach(Set::all() as $set){
            $set->selected = 0;
            $set->save();
        }
        $set = Set::find($set_id);
        $set->selected = 1;
        $set->save();
        $activity_id = Activity::select('id')->where('name','=','Test Selected')->pluck('id');
        Auth::user()->activities()->attach($activity_id);
        Session::flash('success','Set selected for test');
        return redirect()->back();
    }

}
