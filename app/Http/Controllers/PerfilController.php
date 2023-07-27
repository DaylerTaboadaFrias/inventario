<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Usuario;
use App\Models\GrupoModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PerfilController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|string
     */
    public function index()
    {
        $grupo = GrupoModel::find(auth()->user()->id_grupo);
        return view('usuarios/perfil', compact('grupo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateDiaNoche(Usuario $user, $modo){
        switch ($modo){
            case('modo'):
                $user->update(['is_dia' => auth()->user()->is_dia? 'false': 'true']);
                break;
            case('Infantil'):
                $user->update(['tema' => 'Infantil']);
                break;
            case('Juvenil'):
                $user->update(['tema' => 'Juvenil']);
                break;
            case('Adultos'):
                $user->update(['tema' => 'Adultos']);
                break;
        }
        return redirect()->route('perfil.index');
    }

}
