<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Picture;
use App\Http\Requests\PictureRequest;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pictures=Picture::get();
        return $pictures;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PictureRequest $request)
    {
        $picture=new Picture;
        $picture->picture_address=>$request->picture_address;
        $picture->save();

        //add content to component table
       if(app('App\Http\Controllers\ComponentController')->store('picture',$request->type_component,$request->$style,$picture->id)){

        return json_encode(true);
       }
       else{
        return json_encode(false);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PictureRequest $request, $id)
    {
        $picture=Picture::find($id);
        $picture->picture_address=>$request->picture_address,
        $picture->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Picture::find($id)->delete())
        {
            if(app('App\Http\Controllers\ComponentController')->destroy('picture',$id)){

        return json_encode(true);
       }
       else{
        return json_encode(false);
       }  
            
        }
    }
}
