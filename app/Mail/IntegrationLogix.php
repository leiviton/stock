<?php

namespace Stock\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IntegrationLogix extends Mailable
{
    use Queueable, SerializesModels;

    public $para;
    public $erro;

    /**
     * IntegrationLogix constructor.
     * @param $para
     * @param $order
     */
    public function __construct($para, $erro)
    {
        $this->para = $para;
        $this->erro = $erro;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from($this->para,'Portal DRS Tecnologia e Inovação')
            ->subject('Erro integração')->markdown('mail.invoice.order');
    }
}
