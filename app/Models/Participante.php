<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Auth;
use File;
use DB;
use Mail;
use App\Models\Lienzo;
use Carbon\Carbon;

class Participante extends Model
{
    protected $table='participante';

    protected $primaryKey='id';

    public $timestamps=true;

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $fillable =[
        'estado',   
        'idLienzo', 
        'idUser'  
    ];

    protected $guarded =[

    ];


    //SCOPES




    //RELATIONSHIPS
    public function lienzo()
    {
        return $this->belongsTo('App\Models\Lienzo','idLienzo','id');
    }
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario','idUser','id');
    }


       
    //STATICS
    public static function esParticipante($idLienzo,$idUser)
    {
        $validar = Participante::where('idLienzo',$idLienzo)->where('idUser',$idUser)->where('estado',0)->first();
        if($validar){
            return true;
        }else{
            return false;
        }   
    }

    public static function guardarMovimiento($idLienzo,$idUser,$correcto)
    {
          
    }



    //WEB SERVICES






}
