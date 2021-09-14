<?php

namespace App\Mail;

use App\Models\Giving;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NotifyGiving extends Mailable
{
    use Queueable, SerializesModels;

    protected $giving;

    public $subject = 'Nueva donación online recibida';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Giving $giving)
    {
        $this->giving = $giving->load('giver.documentType', 'giver.country', 'type', 'method');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::info("[GIVINGS][EMAIL] Sending notify email to admin: ".config('givings.notify_email'));

        return $this->view('emails.notify-giving')
            ->with([
                'date' => $this->giving->short_date,
                'currency' => $this->giving->currency,
                'amount' => number_format($this->giving->amount, 0, ',', '.'),
                'type' => $this->giving->type->name,
                'method' => $this->giving->method->description,
                'giver' => $this->giving->giver->full_name,
                'documentType' => $this->giving->giver->documentType->code,
                'document' => $this->giving->giver->document,
                'country' => $this->giving->giver->country->name,
            ]);
    }
}
