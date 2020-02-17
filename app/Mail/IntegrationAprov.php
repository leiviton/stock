<?php

namespace Stock\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IntegrationAprov extends Mailable
{
    use Queueable, SerializesModels;

    public $para;
    public $erro;
    public $solicitacao;
    public $order;

    /**
     * IntegrationLogix constructor.
     * @param $para
     * @param $order
     */
    public function __construct($para, $solicitacao, $order)
    {
        $this->para = $para;
        $this->solicitacao = $solicitacao;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to($this->para)
            ->subject('Solicitação de compra')->markdown('mail.invoice.aprovador');
    }
}
