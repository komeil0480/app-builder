<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Link;
use App\Http\Requests\LinkRequest;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links=Link::get();
        return $links;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinkRequest $request)
    {
            $link=new Link;
            $link->text=>$request->text;
            $link->picture_address =>$request->picture_address;
            $link->link=>$request->link;
            $link->save();

        //add content to component table
       if(app('App\Http\Controllers\ComponentController')->store('link',$request->type_component,$request->style,$link->id)){

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
    public function update(LinkRequest $request, $id)
    {
        $link=Link::find($id);
        $link->text=>$request->text,
        $link->picture_address =>$request->picture_address,
        $link->page_id=>$request->page_id,
        $link->save();  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Link::find($id)->delete())
        {
            if(app('App\Http\Controllers\ComponentController')->destroy('link',$id)){

        return json_encode(true);
       }
       else{
        return json_encode(false);
       }  
            
        }
    }
}
