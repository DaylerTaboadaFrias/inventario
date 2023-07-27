<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Models\Usuario;
use DB;

class UserController extends Controller
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
        return view('user.index',['users'=>Usuario::_getAdministradores()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($iduser)
    {
        $user = Usuario::findOrFail($iduser);
        return view('user.show',['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($iduser)
    {        
       return view('user.edit',['user'=>Usuario::findOrFail($iduser)]);
    }

    public function create()
    {        
       return view('user.create');
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Usuario::verificarEmailExiste($request)) {
                $usuario = Usuario::createAdministrador($request);
            }else{
                return response()->json(['codigo'=>1, 'mensaje'=>'El correo ingresado alguien lo esta ocupando, por favor comuniquese con soporte.']);
            }
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Administrador registrado correctamente']);

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
            if (!Usuario::verificarEmailExisteMenosAdministradorAEditar($request)) {

                if ($request->input('password')) {
                    if (trim($request->input('password'))!='') {
                        $usuario = Usuario::updateAdministrador($request);
                    }else{
                        return response()->json(['codigo'=>1, 'mensaje'=>'El password ingresado tiene caracteres no validos']);
                    }                     
                }else{
                        $usuario = Usuario::updateAdministrador($request);
                        $destinationPath = Usuario::createDirectorioPorIdAdministrador($usuario->id);
                        Usuario::actualizarPerfilPorIdAdministrador($request,$usuario->id,$destinationPath);
                }
             
            }else{
                return response()->json(['codigo'=>1, 'mensaje'=>'El correo ingresado alguien lo esta ocupando, por favor comuniquese con soporte.']);
            }
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Datos del user actualizado correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        } 
    }



    public function updateEstado(Request $request)
    {
        try {
            DB::beginTransaction();
            Usuario::updateEstado($request);
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Estado del user actualizado correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }    
    }

    public function estado(Request $request)
    {
        try {
            DB::beginTransaction();
            Usuario::estadoAdministrador($request);
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Estado del usuario actualizado correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }
    }


}
