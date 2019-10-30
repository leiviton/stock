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
    public function __construct($para)
    {
        $this->para = $para;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from($this->para,'Portal DRS')
            ->subject('Erro integração')->markdown('mail.invoice.order');
    }
}
