<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Models\Lienzo;
use App\Models\Usuario;
use DB;

class LienzoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('lienzo.index',['lienzos'=>Lienzo::_getLienzos()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idlienzo)
    {
        $lienzo = Lienzo::findOrFail($idlienzo);
        return view('lienzo.show',['lienzo'=>$lienzo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idlienzo)
    {
        $lienzo = Lienzo::findOrFail($idlienzo);
        return view('lienzo.edit',['lienzo'=>Lienzo::findOrFail($idlienzo),'participantes'=>Usuario::_getJugadores()]);
    }

    public function create()
    {        
       return view('lienzo.create',['participantes'=>Usuario::_getJugadores()]);
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $lienzo = Lienzo::createLienzo($request);
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Lienzo registrado correctamente']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }      
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $lienzo = Lienzo::updateLienzo($request);
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Datos del lienzo actualizado correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        } 
    }


    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            Lienzo::deleteLienzo($request);
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Lienzo eliminado correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }
    }


}
