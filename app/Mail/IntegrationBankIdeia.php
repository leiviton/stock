<?php

namespace Stock\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IntegrationBankIdeia extends Mailable
{
    use Queueable, SerializesModels;

    public $para;
    public $ideia;

    /**
     * IntegrationBankIdeia constructor.
     * @param $para
     * @param $ideia
     */
    public function __construct($para, $ideia)
    {
        $this->para = $para;
        $this->ideia = $ideia;
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
            ->subject('Nova ideia chegando')->markdown('mail.invoice.ideia');
    }
}
