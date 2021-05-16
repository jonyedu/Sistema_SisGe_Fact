<?php

namespace App\Mail\Transaccion\FacturaCompra;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnvioFacturaCompraMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $rutaFile;
    public $rutaImg;
    public $datosProveedor;


    public function __construct($rutaFile, $datosProveedor, $rutaImg)
    {
        $this->rutaFile = $rutaFile;
        $this->rutaImg = $rutaImg;
        $this->datosProveedor = $datosProveedor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('mail.Transaccion.FacturaCompra.envioFacturaCompra')
            ->attach($this->rutaFile);
    }
}
