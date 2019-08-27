<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Text;
use App\Http\Requests\TextRequest;

class TextController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $text=Text::get();
        return $text;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TextRequest $request)
    {
        $text=new Text;
        $text->text=>$request->text;
        $text->save();

        //add content to component table
       if(app('App\Http\Controllers\ComponentController')->store('text',$request->type_component,$text->id)){

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
    public function update(TextRequest $request, $id)
    {
        $text=Text::find($id);
        $text->text=>$request->text,
        $text->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Text::find($id)->delete())
        {
            if(app('App\Http\Controllers\ComponentController')->destroy('text',$id)){

        return json_encode(true);
       }
       else{
        return json_encode(false);
       }  
            
        }
    }
}
