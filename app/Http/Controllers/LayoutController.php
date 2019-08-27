<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Layout;

class LayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layout=Layout::with('component')->get();
        return $layout;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $layout=new Layout;
        $layout->type=$request->type;
        $layout->direction=$request->direction;
        $layout->save();
        //add permissions to role
        $i=1;
        foreach ($request->components as $component) {
            $layout->component()->attach($component,['priority'=>$i]);
            $i=$i+1;
        }
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
    public function update(Request $request, $id)
    {
        $layout=Layout::find($id);
        $layout->type=$request->type;
        $layout->direction=$request->direction;
        $layout->save();
        //add layout to component
        $layout->component()->detach();
        $i=1;
        foreach ($request->components as $component) {
            $layout->component()->attach($component,['priority'=>$i]);
            $i=$i+1;
        }
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
        $layout=Layout::find($id);
        $layout->component()->detach();
        $layout->delete();
        return json_encode(true);
    }

        
}
