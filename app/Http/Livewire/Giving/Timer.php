<?php

namespace App\Http\Livewire\Giving;

use Livewire\Component;

class Timer extends Component
{
    public bool $active = false;
    public int $maxTime = 1800;
    public int $expirationTime = 0;

    public string $remainingPathColor;
    public string $timeLeftFormatted;

    protected $listeners = ['invoiceUpdated' => 'startTimer', 'invoicePaid' => 'stopTimer'];

    public function render()
    {
        return view('livewire.giving.timer');
    }

    public function startTimer(array $params)
    {
        $this->active = true;
        $this->maxTime = $params['maxTime'];
        $this->expirationTime = $params['expirationTime'];
    }

    public function stopTimer()
    {
        $this->active = false;
        $this->maxTime = 0;
        $this->expirationTime = 0;
    }
}
