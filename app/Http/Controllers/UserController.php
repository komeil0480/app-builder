<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::with('role')->get();
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user=new User([
            'name'=>$request->name,
            'family'=>$request->family,
            'email' =>$request->email,
            'phone'=>$request->phone,
            'title_job'=>$request->title_job,
            'role_id'=>$request->role_id,
            'password'=> Hash::make($request->password),
        ]
        );
        $user->save();

        return json_encode(true);

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user=User::find($id);
        $user->update([
            'name'=>$request->name,
            'family'=>$request->family,
            'email' =>$request->email,
            'phone'=>$request->phone,
            'title_job'=>$request->title_job,
            'role_id'=>$request->role_id,
        ]);

        if($request->password){
        $user->password=Hash::make($request->password);
    }
        $user->save();
        return json_encode(true);
       
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(User::find($id)->delete())
        {
            return json_encode(true);
        }
        return json_encode(false);
    }
}
