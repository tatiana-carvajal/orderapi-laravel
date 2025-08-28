<?php

namespace App\Http\Controllers;

use App\Models\Causal;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CausalController extends Controller
{

      private $rules = [
        'description'=> 'required|string|min:3|max:100'
    ];
    private $traductionAttributes = [
        'description'=> 'descripción'
    ];

    /**
     * Aplica la lista de validacion
     */
    public function applyValidation(Request $request){
       $validator = Validator::make($request->all(), $this->rules);
        $validator -> setAttributeNames($this->traductionAttributes);
        if($validator->fails())
        {
            $data = response()->json(['errors'=> $validator->errors(), 'data' => $request->all()], Response::HTTP_BAD_REQUEST);
        }
        return $data;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $causals = Causal::all();
        return response()->json($causals, Response::HTTP_OK);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->applyValidation($request);
        if(!empty($data))
        {
            return $data;
        }

        $causal = Causal::create($request->all());
        $response =[

            'messaje' => 'Registro creado correctamente',
            'causal' => $causal
        
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
