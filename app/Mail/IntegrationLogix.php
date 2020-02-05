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
    public $solicitacao;

    /**
     * IntegrationLogix constructor.
     * @param $para
     * @param $order
     */
    public function __construct($para, $solicitacao)
    {
        $this->para = $para;
        $this->solicitacao = $solicitacao;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Solicitação de compra')->markdown('mail.invoice.order');
    }
}
