<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Auth;
use File;
use DB;
use Mail;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Participante;
use Carbon\Carbon;



class Lienzo extends Model
{
    protected $table='lienzo';

    protected $primaryKey='id';

    public $timestamps=true;

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $fillable =[
		'nombre',
		'dato',	
		'estado'
    ];

    protected $guarded =[

    ];


    //SCOPES

    public function scope_getLienzos($query)
    {
        return $query->orderBy('id','desc')->where('estado',0)->get();
    }


    public function scope_getLienzoPorId($query,$id)
    {
        return $query->where('id',$id)->first();
    }


    //RELATIONSHIPS
    public function participantes()
    {
        return $this->hasMany('App\Models\Participante','idLienzo','id')->where('estado',0);
    }
  
    //STATICS
    

    public static function createLienzo($request)
    {
        
        $lienzo = new Lienzo;
        $lienzo->nombre = $request->input('nombre'); 
        $lienzo->dato = '';
        $lienzo->estado = 0;   
        $lienzo->save();

        $idsParticipantes = $request->input('idsParticipantes');
        if($idsParticipantes){

            for ($i=0; $i < count($idsParticipantes) ; $i++) { 
                $jugador = new Participante;
                $jugador->idLienzo = $lienzo->id;
                $jugador->idUser = $idsParticipantes[$i];   
                $jugador->estado = 0;
                $jugador->save(); 
            }
        }else{
            throw new \ErrorException('El participante es obligatorio.');
        }

        return $lienzo;
    }

    public static function updateLienzo($request)
    {
        $lienzo = Lienzo::findOrFail($request->input('id'));
        $lienzo->nombre = $request->input('nombre'); 
        $lienzo->update();

        Participante::where('idLienzo', $lienzo->id)->update(['estado' => 1]);

        $idsParticipantes = $request->input('idsParticipantes');
        if($idsParticipantes){
            for ($i=0; $i < count($idsParticipantes) ; $i++) { 
                $participante = new Participante;
                $participante->idLienzo = $lienzo->id;
                $participante->idUser = $idsParticipantes[$i];   
                $participante->estado = 0;
                $participante->save(); 
            }
        }else{
            throw new \ErrorException('El participante es obligatorio.');
        }

        return $lienzo;
    }


    public static function deleteLienzo($request)
    {
        $lienzo = Lienzo::findOrFail($request->input('id'));
        $lienzo->estado = 1;
        $lienzo->update();
        return $lienzo;
    }

    //WEB SERVICES


    public static function guardarDiagrama($idLienzo,$dato)
    {
        $lienzo = Lienzo::findOrFail($idLienzo);
        $lienzo->dato = $dato;
        $lienzo->update();
        return $lienzo;
    }






}
