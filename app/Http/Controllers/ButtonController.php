<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Button;
use App\Http\Requests\ButtonRequest;

class ButtonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buttons=Button::get();
        return $buttons;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ButtonRequest $request)
    {
            $button=new Button;
            $button->text=>$request->text;
            $button->picture_address =>$request->picture_address;
            $button->page_id=>$request->page_id;
            $button->save();

        //add content to component table
       if(app('App\Http\Controllers\ComponentController')->store('button',$request->type_component,$button->id)){

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
    public function update(ButtonRequest $request, $id)
    {
        $button=Button::find($id);
        $button->text=>$request->text,
        $button->picture_address =>$request->picture_address,
        $button->page_id=>$request->page_id,
        $button->save();  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Button::find($id)->delete())
        {
            if(app('App\Http\Controllers\ComponentController')->destroy('button',$id)){

        return json_encode(true);
       }
       else{
        return json_encode(false);
       }  
            
        }
    }
}
