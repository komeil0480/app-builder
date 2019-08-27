<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Slider;
use App\Http\Requests\SliderRequest;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders=Slider::get();
        return $sliders;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        $slider=new Slider;
        $slider->picturs=>$request->picturs;
        $slider->save();

        //add content to component table
       if(app('App\Http\Controllers\ComponentController')->store('slider',$request->type_component,$slider->id)){

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
    public function update(SliderRequest $request, $id)
    {
        $slider=Slider::find($id);
        $slider->picturs=>$request->picturs,
        $slider->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Slider::find($id)->delete())
        {
            if(app('App\Http\Controllers\ComponentController')->destroy('slider',$id)){

        return json_encode(true);
       }
       else{
        return json_encode(false);
       }  
            
        }
    }
}
