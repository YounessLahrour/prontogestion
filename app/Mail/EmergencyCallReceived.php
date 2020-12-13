<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use File;
use App\Controllers\EnviarController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class EmergencyCallReceived extends Mailable
{
    use Queueable, SerializesModels;
    public $nombre;
    public $apellido;
    public $telefono;
    public $audio;
    public $lat;
    public $lng;
    //public $files;
    public $directorio;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datos, $directorio, $audio, $directorio1, $telefono, $lat, $lng)
    {
        
        $this->nombre = $datos;
        $this->apellido = $directorio;
        $this->telefono = $telefono;
        $this->audio = $audio;
        $this->lat = $lat;
       $this->lng = $lng;
        //$this->files = $datos;
        $this->directorio = $directorio1;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('mails.emergency_call')->from('prontogestion@gmail.es', ucfirst($this->nombre) . " " . ucfirst($this->apellido))->subject("Pronto Gestión");
       
        if (isset($this->audio)) {
            $email->attach(public_path("img/").$this->audio, [
                'as' => 'audio'.ucfirst($this->nombre).'.webm',
                'mime' => 'application/mp3',
            ]);
            //File::delete(public_path($this->audio));
        }
        
        $directorio = $this->directorio;
        if($directorio!="vacio"){
            $email->attach(public_path("img/").$directorio, [
            'mime' => 'application/pdf',
        ]);
        }
     //   unlink($directorio);

        return $email;
    }
}
