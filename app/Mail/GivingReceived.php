<?php

namespace App\Mail;

use App\Models\Giving;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GivingReceived extends Mailable
{
    use Queueable, SerializesModels;

    protected $giving;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Giving $giving)
    {
        $this->giving = $giving->load('giver', 'type', 'method');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.thanks')
            ->with([
                'dateOne' => $this->giving->short_date,
                'dateTwo' => $this->giving->long_date,
                'reference' => $this->giving->reference,
                'giver' => $this->giving->giver->full_name,
                'currency' => $this->giving->currency,
                'amount' => $this->giving->amount,
                'transaction' => $this->giving->transaction_id,
                'type' => $this->giving->type->name,
                'method' => $this->giving->method->name,
            ]);
    }
}
