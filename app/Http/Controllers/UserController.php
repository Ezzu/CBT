<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Session;
use Auth;
use Mail;
use App\Set;

class UserController extends Controller
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
        $set = ['a'=>0,'b'=>0,'c'=>0];
        if(count(User::all()->where('set','=','A'))>0)
            $set['a']=1;
        if(count(User::all()->where('set','=','B'))>0)
            $set['b']=1;
        if(count(User::all()->where('set','=','C'))>0)
            $set['c']=1;
        $set_count=0;
        foreach(User::all() as $user) {
            if ($user->test_grant) {
                $set_count++;
            }
        }
        return view('admin.users.index')->with('users',User::orderBy('role')->get()->where('role','!=','super'))->with('sets',$set)->with('set_count',$set_count);
    }


    public function getStudents(){
        $set = ['a'=>0,'b'=>0,'c'=>0];
        if(count(User::all()->where('set','=','A'))>0)
            $set['a']=1;
        if(count(User::all()->where('set','=','B'))>0)
            $set['b']=1;
        if(count(User::all()->where('set','=','C'))>0)
            $set['c']=1;
        $set_count=0;
        foreach(User::all() as $user) {
            if ($user->test_grant) {
                $set_count++;
            }
        }
        return view('admin.users.index')->with('users',User::all()->where('role','student'))->with('sets',$set)->with('set_count',$set_count);
    }

    public function getSpecialists(){
        $set = ['a'=>0,'b'=>0,'c'=>0];
        if(count(User::all()->where('set','=','A'))>0)
            $set['a']=1;
        if(count(User::all()->where('set','=','B'))>0)
            $set['b']=1;
        if(count(User::all()->where('set','=','C'))>0)
            $set['c']=1;
        $set_count=0;
        foreach(User::all() as $user) {
            if ($user->test_grant) {
                $set_count++;
            }
        }
        return view('admin.users.index')->with('users',User::all()->where('role','specialist'))->with('sets',$set)->with('set_count',$set_count);
    }

    public function getSupervisors(){
        $set = ['a'=>0,'b'=>0,'c'=>0];
        if(count(User::all()->where('set','=','A'))>0)
            $set['a']=1;
        if(count(User::all()->where('set','=','B'))>0)
            $set['b']=1;
        if(count(User::all()->where('set','=','C'))>0)
            $set['c']=1;
        $set_count=0;
        foreach(User::all() as $user) {
            if ($user->test_grant) {
                $set_count++;
            }
        }
        return view('admin.users.index')->with('users',User::all()->where('role','supervisor'))->with('sets',$set)->with('set_count',$set_count);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'email' => 'required|email',
            'role' => 'required'
        ]);
        $password = substr(md5(microtime()),0,8);
        Mail::send(['text'=>'admin.users.mail'],['name'=>$request->name,'password'=>$password],function($message) use ($request){
            $message->to($request->email,$request->name)->subject('Welcome to our administration');
            $message->from('admin@gcu.edu.pk','Admin');
        });
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($password),
            'role' => $request->role
        ]);
        Profile::create([
            'user_id' => $user->id
        ]);
        Session::flash('success','User added successfully');
        return redirect()->route('users');
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
        $user = User::destroy($id);
        $user->profile->delete();
        Session::flash('success','User successfully deleted');

        return redirect()->route('users');
    }
    
    public function grant($id,$set){
        $user = User::find($id);
        $user->test_grant = 1;
        $user->set=$set;
        $user->save();
        Session::flash('success','Priviliages updated successfully');
        return redirect()->route('users');
    }

    public function ungrant($id){

        foreach(User::all() as $temp_user){
            if($temp_user->activities()->find(14)){
                Session::flash('failure','Operation failed! Test started');
                return redirect()->back();
            }
        }
        foreach(User::all() as $temp_user){
            if($temp_user->activities()->find(12)){
                Session::flash('failure','Operation failed! Test already stored');
                return redirect()->back();
            }
        }
        $user = User::find($id);
        //removing all questions added by that user
        foreach(Question::all() as $question){
            foreach($question->sets as $set){
                if($set->name==$user->set)
                        $question->sets()->detach();
            }
        }
        $user->test_grant = 0;
        $user->set='0';
        $user->save();
        $activity_id = Activity::select('id')->where('name','=','Test Generated')->pluck('id')->first();
        $user->activities()->detach($activity_id);
        Session::flash('success','Priviliages updated successfully');
        return redirect()->route('users');
    }

    public function tokenize(Request $request){
        $users = User::all()->where('role','=','student');
        $activity_id = Activity::select('id')->where('name','=','Has Token')->pluck('id');
        foreach($users as $user){
            if(count($user->activities()->find($activity_id))==0){
                $user->activities()->save(Activity::find(14), ['expired_at' => $request->end_time]);
            }
        }
        Session::flash('success','Test Token Generated for Students');
        return redirect()->back();
    }
}
