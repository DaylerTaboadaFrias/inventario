<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Auth;
use File;
use DB;


class Usuario extends Model
{
    protected $table='users';

    protected $primaryKey='id';

    public $timestamps=true;


    protected $fillable =[
		'name',
		'perfil',	
		'email',	
		'password',	
        'tipoUsuario', 
        'password', 
		'estado'
    ];

    protected $guarded =[

    ];


    //SCOPES
    public function scope_getUsuarioPorEmail($query,$email)
    {
    	return $query->where('email',$email)->first();
    }


    public function scope_getAdministradores($query)
    {
        return $query->orderBy('id','desc')->get();
    }

    public function scope_getJugadores($query)
    {
        return $query->orderBy('id','desc')->where('estado',0)->where('tipoUsuario',2)->get();
    }

    public function scope_getParticipantePorId($query,$id)
    {
        return $query->where('id',$id)->first();
    }

    //RELATIONSHIPS
    public function participaciones()
    {
        return $this->hasMany('App\Models\Participante','idUser','id')->where('estado',0);
    }

   
    //STATICS
    public static function verificarAdministradorHabilitadoPorEmail($email)
    {
       	$usuario = Usuario::_getUsuarioPorEmail($email);
       	if ($usuario->estado==0) {
       		return true;
       	}else{
       		return false;
       	}
    }
    

    public static function verificarAdministrador($email)
    {
        $usuario = Usuario::_getUsuarioPorEmail($email);
        if ($usuario->tipoUsuario==1) {
            return true;
        }else{
            return false;
        }
    }
    

    public static function createAdministrador($request)
    {
        $usuario = new Usuario;
        $usuario->name = $request->input('name'); 
        $usuario->email = $request->input('email');    
        $usuario->password =  Hash::make($request->input('password'));
        $usuario->estado = 0;
        $usuario->tipoUsuario = $request->input('tipoUsuario');
        $usuario->save();
        return $usuario;
    }

    public static function createDirectorioPorIdAdministrador($idusuario)
    {
        $destinationPath = public_path().'/administradores/'.$idusuario;
        File::makeDirectory($destinationPath, $mode = 0777, true, true); 
        return $destinationPath;
    }


    public static function actualizarPerfilPorIdAdministrador($request,$idusuario,$destinationPath)
    {
        if ($request->file('perfil')) {
            $file = $request->file('perfil');
            $usuario = Usuario::findOrFail($idusuario);
            $usuario->perfil = '/administradores/'.$idusuario.'/'.'img_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $usuario->perfil);
            $usuario->update(); 
            return $usuario;
        }
    }


    public static function updateAdministrador($request)
    {
        $usuario = Usuario::findOrFail($request->input('id'));
        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');
        if ($request->input('password')) {
            $usuario->password =  Hash::make($request->input('password'));
        }
        $usuario->tipoUsuario = $request->input('tipoUsuario');
        $usuario->update();
        return $usuario;
    }



    public static function verificarEmailExiste($request)
    {
        $emails = DB::table('users')->where('email',$request->input('email'))->get();
        if (count($emails)>0) {
            return true;
        }else{
            return false;
        }
    }

    public static function verificarEmailExisteMenosAdministradorAEditar($request)
    {
        $emails = DB::table('users')->where('email',$request->input('email'))->where('users.id','<>',$request->input('id'))->get();
        if (count($emails)>0) {
            return true;
        }else{
            return false;
        }
    }


    public static function estadoAdministrador($request)
    {
        $usuario = Usuario::findOrFail($request->input('id'));
        $usuario->estado = $request->input('estado');
        $usuario->update();
        return $usuario;
    }

}
