<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Models\Usuario;
use App\Models\Lienzo;
use App\Models\Participante;
use App\Events\GetPiezasEvent;
use DB;

use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;

class ParticipanteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $idParticipante = auth()->user()->id;
        return view('participante.index',['participante'=>Usuario::_getParticipantePorId($idParticipante)]);
    }

    public function show($idLienzo)
    {
        $idParticipante = auth()->user()->id;
        if(Participante::esParticipante($idLienzo,$idParticipante)){
            return view('participante.show',['lienzo'=>Lienzo::_getLienzoPorId($idLienzo),'participante'=>Usuario::_getParticipantePorId($idParticipante)]);
        }
    }  
 


    public function enviarMovimiento(Request $request)
    {
        event(new GetPiezasEvent($request->datos,$request->idParticipante));
        Lienzo::guardarDiagrama($request->idLienzo,$request->datos);
        return response()->json(['codigo'=>0, 'mensaje'=>'Movimiento enviado correctamente']);
    }

    public function generarVozAyuda(Request $request)
    {
        try {
            $textToSpeechClient = new TextToSpeechClient([
                'credentials'=> base_path().'/database/data/rompezabezai-44d3054a4fc0.json'
            ]);

            $input = new SynthesisInput();
            $input->setText($request->texto);
            $voice = new VoiceSelectionParams();
            $voice->setLanguageCode('es-ES');
            $voice->setName('es-ES-Standard-D');
            $audioConfig = new AudioConfig();
            $audioConfig->setAudioEncoding(AudioEncoding::MP3);

            $resp = $textToSpeechClient->synthesizeSpeech($input, $voice, $audioConfig);
            $nombre = uniqid().'.mp3';
            file_put_contents('participantes/'.$request->idJuego.'/'.$nombre, $resp->getAudioContent());

        return response()->json(['codigo'=>0, 'mensaje'=>'Voz generada correctamente','data'=>'/participantes/'.$request->idJuego.'/'.$nombre]);
        } catch (Exception $e) {
            return response()->json(['codigo'=>0, 'mensaje'=>$e->getMessage()]);
        }
    }



}
