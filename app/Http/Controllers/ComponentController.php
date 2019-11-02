<?php

namespace App\Http\Controllers;

use App\Component;
use App\Multimedia;
use App\Text;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ComponentController extends Controller
{

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validatorMultimedia(Request $request)
    {
        return Validator::make($request->all(), [
            'link' => ['regex:~^https?://(?:[a-z0-9\-]+\.)+[a-z]{2,6}(?:/[^/#?]+)+\.(?:jpg|png|MP4|WEBM)$~', 'required']
        ],[
            'link.regex' => 'The link format is invalid. The formats allowed for video are MP4 and WEBM, and for JPG and PNG images.'
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validatorText(Request $request)
    {
        return Validator::make($request->all(), [
            'text' => ['required', 'max:140']
        ]);
    }


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
     * type 0 = image, type 1 = video, type 2 = text
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function store(Request $request)
    {
        $type = $request->input('type');
        $type_component = "";

        //Creación de las generalidades del componente
        $component = Component::create([
            'name' => $request->input('name'),
            'position_x' => $request->input('position_x'),
            'position_y' => $request->input('position_y'),
            'position_z' => $request->input('position_z'),
            'height' => $request->input('height'),
            'width' => $request->input('width'),
            'multimedia_id' => 1,
            'text_id' => 1,
        ]);

        //Creación del componente multimedia(imagen o video) o texto
        if ($type == 0 || $type == 1){

            //Validación de campos ingresados en la creación del componente si el tipo es imagen o video,
            //si la validación falla, retorna un JSON con los mensajes de error.
            $validator = $this->validatorMultimedia($request);
            if ($validator->fails()){
                return response()->json($validator->errors(), 422);
            }

            $link = $request->input('link');
            $path = parse_url($link, PHP_URL_PATH);
            $format = pathinfo($path, PATHINFO_EXTENSION);

            $type_component = Multimedia::create([
                'link' => $link,
                'format' => $format,
                'weight' => $request->input('weight'),
                'type' => $type
            ]);

            $component->multimedia()->associate($type_component);
            $component->save();

        }else{

            //Validación de campos ingresados en la creación del componente si el tipo es texto,
            //si la validación falla, retorna un JSON con los mensajes de error.
            $validator = $this->validatorText($request);
            if ($validator->fails()){
                return response()->json($validator->errors(), 422);
            }

            $type_component = Text::create([
                'text' => $request->input('text'),
                'type' => $type
            ]);
            $component->text()->associate($type_component);
            $component->save();
        }

       if (isset($type_component) && isset($component)){
            return array([
                'message' => 'The component has been created successfully.',
                'component' => $component
            ]);
        }else{
           return array([
               'message' => 'An error has occurred, try again later.'
           ]);
       }

    }

}
