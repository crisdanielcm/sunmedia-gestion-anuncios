<?php

namespace App\Http\Controllers;

use App\Component;
use App\Multimedia;
use App\Text;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Component::all();
    }

    /**
     * Store a newly created resource in storage.
     * tipo 0 = imagen, tipo 1 = video, tipo 2 = texto
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = $request->input('type');
        $multimedia = "";
        $text = "";

        if ($type == 0){
            $multimedia = Multimedia::create([
                'link' => $request->input('link'),
                'format' => $request->input('format'),
                'weight' => $request->input('weight'),
                'type' => 0
            ]);
        }else if($type == 1){
            $multimedia = Multimedia::create([
                'link' => $request->input('link'),
                'format' => $request->input('format'),
                'weight' => $request->input('weight'),
                'type' => 1
            ]);
        }else{
            $text = Text::create(['text' => $request->input('text')]);
        }
        return $text;


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ad $ad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        //
    }
}
