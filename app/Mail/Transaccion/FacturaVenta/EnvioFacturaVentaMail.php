<?php

namespace App\Mail\Transaccion\FacturaVenta;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnvioFacturaVentaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $rutaFile;
    public $rutaImg;
    public $datosCliente;


    public function __construct($rutaFile, $datosCliente, $rutaImg)
    {
        $this->rutaFile = $rutaFile;
        $this->rutaImg = $rutaImg;
        $this->datosCliente = $datosCliente;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('mail.Transaccion.FacturaVenta.envioFacturaVenta')
            ->attach($this->rutaFile);
    }
}
