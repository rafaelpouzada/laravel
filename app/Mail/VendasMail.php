<?php

namespace App\Mail;

use App\Models\Venda;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendasMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $vendas;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($vendas)
    {
        $this->vendas = $vendas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.VendasMail')->with('vendas', $this->vendas);
    }
}
