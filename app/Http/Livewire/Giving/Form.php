<?php

namespace App\Http\Livewire\Giving;

use App\Models\Country;
use App\Models\DocumentType;
use App\Models\Giver;
use App\Models\Giving;
use App\Models\GivingType;
use App\Models\PaymentGateway;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;

class Form extends Component
{
    public $givingTypes;
    public $documentTypes;
    public $countries;

    private $giver;
    private $paymentGateway;

    public $amount, $giving_type_id, $first_name, $last_name, $document_type_id, $document, $email, $phone, $country, $currency;

    protected $rules = [
        'first_name' => ['required', 'string'],
        'last_name' => ['required', 'string'],
        'document_type_id' => ['required', 'integer'],
        'document' => ['required', 'string'],
        'email' => ['required', 'email'],
        'phone' => ['required', 'string'],
    ];

    protected $listeners = ['amountChanged' => 'updateAmount'];

    public function mount()
    {
        $this->givingTypes = GivingType::active()->get();

        $this->documentTypes = DocumentType::active()->pluck('name', 'id');

        $this->countries = Country::active()
            ->orderBy('order')
            ->get()
            ->pluck('name', 'code');

        $this->giving_type_id = $this->givingTypes->firstWhere('name', 'Campus Barranquilla')->id;

        $this->document_type_id = $this->documentTypes->keys()[0];

        $this->country = $this->countries->keys()[0];

        $this->amount = 0;

        $this->currency = 'COP';
    }

    public function render()
    {
        return view('livewire.giving.form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateAmount($value)
    {
        $this->amount = $value;
    }

    public function updateCurrency($value)
    {
        $this->currency = $value;
    }

    public function give()
    {
        $this->giver = $this->storeGiver();

        $this->setPaymentGateway();

        $giving = $this->storeGivingRecord();

        Log::info("[GIVINGS][FORM] Storing new giving record with ID: {$giving->id}");

        redirect()->route('donaciones.redirect', $giving);
    }

    private function storeGivingRecord()
    {
        return Giving::create([
            'reference' => Str::uuid(),
            'amount' => $this->amount,
            'currency' => $this->currency,
            'description' => $this->description(),
            'status' => Giving::STATUS_CREATED,
            'giver_id' => $this->giver->id,
            'giving_type_id' => $this->giving_type_id,
            'payment_gateway_id' => $this->paymentGateway->id,
        ]);
    }

    private function description(): string
    {
        return "Donación: " . GivingType::find($this->giving_type_id)->name;
    }

    private function storeGiver()
    {
        $validatedData = $this->validate();

        $validatedData['country_id'] = $this->getCountryId();

        return Giver::updateOrCreate(
            ['email' => $validatedData['email']],
            Arr::except($validatedData, ['email'])
        );
    }

    private function setPaymentGateway()
    {
        $this->paymentGateway = PaymentGateway::active()
            ->where('name', 'PayU')
            ->first();
    }

    private function getCountryId()
    {
        return Country::code($this->country)->first()->id;
    }
}
