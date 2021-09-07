<?php

namespace App\Mail;

use App\Models\Giving;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GivingReceived extends Mailable
{
    use Queueable, SerializesModels;

    protected $giving;

    public $subject = 'Donación recibida | Living Room';

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
        Log::info("[GIVINGS][EMAIL] Sending thanks email for giver: {$this->giving->giver->email}");

        return $this->view('emails.thanks')
            ->with([
                'dateOne' => $this->giving->short_date,
                'dateTwo' => $this->giving->long_date,
                'reference' => $this->giving->reference,
                'giver' => $this->giving->giver->full_name,
                'currency' => $this->giving->currency,
                'amount' => number_format($this->giving->amount, 0, ',', '.'),
                'transaction' => $this->giving->transaction_id,
                'type' => $this->giving->type->name,
                'method' => $this->giving->method->description,
            ]);
    }
}
