<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Page;
use App\Button;
use App\Layout;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages=Page::get();
        return $pages;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page=new Page;
        $page->title=$request->title;
        $page->save();
        //add layouts to page
        $i=1;
        foreach ($request->layouts as $layout) {
            $page->layout()->attach($layout,['priority'=>$i]);
            $i=$i+1;
            //if layout is type post create permission
            if(Layout::find($layout)->type=='post'){

            app('App\Http\Controllers\PermissionController')->store($page->title,'پست گزاری','post',$layout,$page->id);

               
            }
        }

        //create permission for page
       if(app('App\Http\Controllers\PermissionController')->store($page->title,'ویرایش ظاهر','page builder',null,$page->id)){

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

        $page=Page::with('layout')->find($id);

        //add content to components
        foreach($page['layout'] as $layout){
            foreach ($layout['component'] as $component) {
                //get content from component
                $content=app('App\Http\Controllers\ComponentController')->show($component['type_content'],$component['content_id']);
                    $component['content']=$content;
            }
        }

        return $page;
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
        $page=Page::find($id);
        $page->title=$request->title;
        $page->save();
        //add page to component
        $page->layout()->detach();
        $i=1;
        foreach ($request->layouts as $layout) {
            $page->layout()->attach($layout,['priority'=>$i]);
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
        $page=Page::find($id);
        $page->layout()->detach();
        $page->delete();
        return json_encode(true);
    }
}
