<?php

namespace App\Http\Controllers;

use App\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{

    /**
     * Store a newly created resource in storage.
     * status 0 = published, status 1 = stopped, status 2 = publishing.
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
        $ad = Ad::create([
            'name' => $request->input('name'),
            'status' => $request->input('status')
        ]);

        //Una vez creado el anuncio, adiciona los componetes seleccionados y los agrega a la tabla intermedia ad_components.
        $ad->components()->attach($request->components);

        if (isset($ad)){
            return array([
                'message' => 'The ad has been created successfully.'
            ]);
        }else{
            return array([
                'message' => 'An error has occurred, try again.'
            ]);
        }

    }

    /**
     * @param Request $request
     * * status 0 = published, status 1 = stopped, status 2 = publishing.
     * @return array message
     */
    public function postAd(Request $request){

        $ad = Ad::find($request->ad_id);

        if (isset($ad)){
            if ($ad->status == 1){
                $ad->status = '2';
                $ad->save();
                return array([
                    'message' => 'The ad has been published successfully.'
                ]);
            }else{
                return array([
                    'message' => 'You can only post ads in a stopped state.'
                ]);
            }
        }else{
            return array([
                'message' => 'An error has occurred, try again.'
            ]);
        }
    }
    
}
