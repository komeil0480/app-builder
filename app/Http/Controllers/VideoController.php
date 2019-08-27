<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Video;
use App\Http\Requests\VideoRequest;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos=Video::get();
        return $videos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoRequest $request)
    {
        $video=new Video;
        $Video->video_address=>$request->video_address;
        $Video->save();

        //add content to component table
       if(app('App\Http\Controllers\ComponentController')->store('video',$request->type_component,$video->id)){

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
    public function update(VideoRequest $request, $id)
    {
        $video=Video::find($id);
        $video->video_address=>$request->video_address,
        $video->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Video::find($id)->delete())
        {
            if(app('App\Http\Controllers\ComponentController')->destroy('video',$id)){

        return json_encode(true);
       }
       else{
        return json_encode(false);
       }  
            
        }
    }
}
