<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Profile;
use Illuminate\Support\Facades\Session;
use App\Activity;

class ProfileController extends Controller
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
    public function edit()
    {
        return view('admin.users.edit',['user'=>Profile::find(Auth::user()->id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|max:255',
        ]);
        $user = Auth::user();
        if($request->hasFile('avatar')){
            $avatar = $request->avatar;
            $avatar_new_name = time().$avatar->getClientOriginalName();
            $avatar->move('uploads/avatars/',$avatar_new_name);
            $user->profile->avatar = 'uploads/avatars/'.$avatar_new_name;
        }
        if(!empty($request->password)){
            $user->password = bcrypt($request->password);
        }
        if(!empty($request->about)){
            $user->profile->about = $request->about;
        }
        if(!empty($request->facebook)) {
            $user->profile->facebook = $request->facebook;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->profile->save();
        $user->save();
        $activity_id = Activity::select('id')->where('name','=','Password Changed')->pluck('id');
        $user = Auth::user();
        $user->activities()->attach($activity_id);
        Session::flash('success','Account settings updated');
        return redirect()->route('home');
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
