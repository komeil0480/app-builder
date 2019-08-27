<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Component;

use App\Button;
use App\Link;
use App\Picture;
use App\Post;
use App\Slider;
use App\Text;
use App\Video;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $components=Component::with('content')->get();

        // foreach ($components as $component) {
        //     $type=$component['type'];
        //     switch ($type) {
        //          case 'button':
        //              $component=Component::find($component['id'])->with('button')->first();
        //              break;
                 
        //          default:
        //              # code...
        //              break;
        //      }
        // }




        // return $components;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($type_content,$type_component,$style,$id)
    {
        $component=new Component;
        $component->type_component=$type_component;
        $component->type_content=$type_content;
        $component->slider=$style;
        $component->content_id=$id;
        $component->save();
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //call from PageController to get component from db and add it to array and send it.
    public function show($type_content,$content_id)
    {
        switch ($type_content) {
                    case 'button':
                         $content=Button::find($content_id);
                        break;

                    case 'link':
                         $content=Link::find($content_id);
                         break;

                    case 'picture':
                         $content=Picture::find($content_id);
                         break;

                    case 'post':
                         $content=Post::find($content_id);
                        break;

                    case 'slider':
                         $content=Slider::find($content_id);
                        break;

                    case 'text':
                         $content=Text::find($content_id);
                        break;

                    case 'video':
                         $content=Video::find($content_id);
                        break;
                    
                    default:
                         $content=false;
                         break;
                 }
        return $content;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($type,$id)
    {
        if(component::where('type',$type)->where('content_id',$id)->delete())
        {
            return true;
        }
    }
}
