<?php

namespace App\Http\Livewire\Giving;

use App\Models\Country;
use App\Models\DocumentType;
use App\Models\Giver;
use App\Models\Giving;
use App\Models\GivingType;
use App\Models\PaymentGateway;
use App\Rules\GivingAmount;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;

class Form extends Component
{
    public $givingTypes;
    public $documentTypes;
    public $countries;

    private $giver;
    private $givingType;
    private $paymentGateway;

    public $amount, $giving_type_id, $first_name, $last_name, $document_type_id, $document, $email, $phone, $country, $currency;

    protected function rules(): array
    {
        return [
            'first_name' => ['required', 'regex:/^[ a-zA-ZÀ-ÿ]*$/'],
            'last_name' => ['required', 'regex:/^[ a-zA-ZÀ-ÿ]*$/'],
            'document_type_id' => ['required', 'integer'],
            'document' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string'],
            'amount' => ['required', 'numeric', new GivingAmount($this->currency ?? 'COP')]
        ];
    }

    protected $listeners = ['amountChanged' => 'amountChanged'];

    public function mount()
    {
        $this->givingTypes = GivingType::active()->orderBy('name')->get();

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

    public function amountChanged($value)
    {
        $this->amount = $value;

        if ($this->amount > 0) {
            $this->validateOnly('amount');
        }
    }

    public function currencyChanged($value)
    {
        $this->currency = $value;

        if ($this->amount > 0) {
            $this->validateOnly('amount');
        }
    }

    public function give()
    {
        $this->giver = $this->storeGiver();

        $this->setGivingType();

        $this->setPaymentGateway();

        $giving = $this->storeGivingRecord();

        Log::info("[GIVINGS][FORM] Storing new giving record with ID: {$giving->id}");

        redirect()->route('donaciones.redirect', $giving);
    }

    private function storeGivingRecord()
    {
        return Giving::create([
            'reference' => $this->reference(),
            'amount' => $this->amount,
            'currency' => $this->currency,
            'description' => $this->description(),
            'status' => Giving::STATUS_CREATED,
            'giver_id' => $this->giver->id,
            'giving_type_id' => $this->giving_type_id,
            'payment_gateway_id' => $this->paymentGateway->id,
        ]);
    }

    private function reference(): string
    {
        return bin2hex(random_bytes(5))
            . '_'
            . Str::upper(Str::snake($this->givingType->name));
    }

    private function description(): string
    {
        return "Donación: " . $this->givingType->name;
    }

    private function storeGiver()
    {
        $validatedData = $this->validate();

        $validatedData['country_id'] = $this->getCountryId();

        $validatedData = collect($validatedData)->map(function ($value) {
            return Str::of($value)->trim();
        });

        return Giver::updateOrCreate(
            ['email' => $validatedData->get('email')],
            $validatedData->except(['email', 'amount'])->all()
        );
    }

    private function setGivingType()
    {
        $this->givingType = GivingType::find($this->giving_type_id);
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
