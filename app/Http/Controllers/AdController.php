<?php

namespace App\Http\Controllers;

use App\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{

    /**
     * Método que permite crear un anuncio.
     * Estados de un anuncio: status 0 = published, status 1 = stopped, status 2 = publishing.
     * @param Request $request
     * @return array
     */
    public function createAd(Request $request)
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
     * Método que permite publicar un anuncio si su estado es 1 = stopped
     * Estados de un anuncio: status 0 = published, status 1 = stopped, status 2 = publishing.
     * @param Request $request
     * @return array
     */
    public function postAd(Request $request){

        $ad = Ad::find($request->ad_id);

        if (isset($ad)){
            if ($ad->status == 1){
                $ad->status = 0;
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
