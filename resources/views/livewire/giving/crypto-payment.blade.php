<div class="bg-white w-full lg:w-5/12 -mt-8 lg:-mt-20 shadow-md rounded-lg overflow-hidden">
    <div class="items-center justify-between py-10 px-5 bg-white shadow-2xl rounded-lg mx-auto text-center">
        <div x-data="init()" class="px-2 -mt-6">
            <form wire:loading.remove wire:target="pay">
                <div class="text-center">
                    {{--Cripto Currencies--}}
                    <div x-show="current === 'method'" class="my-3">
                        <div class="mb-2">
                            <label for="type" class="text-lg text-gray-700">Selecciona una criptomoneda para
                                pagar</label>
                        </div>
                        <div class="grid auto-rows-auto grid-cols-1 md:grid-cols-2 gap-2 mt-6">
                            @foreach($currencies as $symbol => $coinName)
                                <x-currency
                                    logo="{{ asset('img/currencies/' . $symbol . '.svg') }}"
                                    :name="$coinName"
                                    :symbol="$symbol"
                                />
                            @endforeach
                        </div>
                        @if($error)
                            <div class="flex justify-start mt-3">
                                <ul>
                                    <li class="flex items-center py-1">
                                        <div class="bg-red-200 text-red-700 rounded-full p-1 fill-current">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                 stroke="currentColor">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="2"
                                                      d="M6 18L18 6M6 6l12 12"/>

                                            </svg>
                                        </div>
                                        <span
                                            class="text-red-700 font-medium text-sm text-left ml-3">{{ $error }}</span>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                    {{--End Cripto Currencies--}}
                    {{--Payment--}}
                    <div x-show="current === 'payment'" wire:poll.visible.5000ms="updateInvoiceStatus" class="my-3">
                        <div class="mb-2">
                            <label for="type" class="text-lg text-gray-700">Envía el pago</label>
                            <p class="text-sm mt-2">Para realizar un pago, envíe el pago utilizando el código QR o los
                                botones a continuación</p>
                        </div>
                        <div class="flex flex-col justify-center mt-8 mb-2">
                            <div class="flex justify-center mb-6">
                                {!! $qrCode !!}
                            </div>
                            <p class="text-sm text-gray-400 mb-8">{{ "Solo envíe {$paymentMethod} a esta dirección" }}</p>
                            <div class="flex flex-col py-2 px-4 rounded border">
                                <div class="flex flex-col md:flex-row justify-between md:items-center w-full mb-4">
                                    {{--Wallet Address--}}
                                    <div class="flex flex-col text-left mb-4 md:mb-0">
                                        <p class="text-xs text-gray-400">{{ "{$paymentMethod} Address" }}</p>
                                        <p class="text-xs md:text-base">{{ $wallet }}</p>
                                    </div>
                                    {{--End Wallet Address--}}
                                    {{--Copy Wallet Button--}}
                                    <div>
                                        <div class="relative sm:max-w-xl sm:mx-auto">
                                            <div class="group cursor-pointer flex flex-col items-center">
                                                <button
                                                    @click.prevent="copyWallet()"
                                                    type="button"
                                                    class="bg-gray-100 transition duration-150 ease-in-out hover:bg-gray-200 rounded border border-gray-300 text-gray-600 px-6 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-600"
                                                >
                                                    Copiar
                                                </button>
                                                <div
                                                    x-text="copyText"
                                                    class="opacity-0 w-40 bg-black text-white text-center text-xs rounded-lg py-2 absolute z-10 group-hover:opacity-100 bottom-full px-3 pointer-events-none"
                                                >
                                                    <svg class="absolute text-black h-2 w-full left-0 top-full" x="0px"
                                                         y="0px" viewBox="0 0 255 255" xml:space="preserve"><polygon
                                                            class="fill-current" points="0,0 127.5,127.5 255,0"/></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Copy Wallet Button--}}
                                </div>
                                @if($invoice)
                                    <div class="flex flex-col md:flex-row justify-between md:items-center w-full">
                                        {{--Order Amount--}}
                                        <div class="flex flex-col text-left w-full">
                                            <p class="text-xs text-gray-400">Monto (Por favor envíe la cantidad exacta)</p>
                                            <div class="flex justify-between">
                                                <p class="text-base md:text-lg">{{ $invoice->get('orderAmount') }}</p>
                                                <p class="text-base md:text-lg">{{ $invoice->get('orderAmountFiat') }}</p>
                                            </div>
                                        </div>
                                        {{--End Order Amount--}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{--Waiting Bar--}}
                        <div class="w-full">
                            <div class="relative w-full bg-gray-200 rounded">
                                <div style="width: 100%" class="absolute top-0 h-2 rounded shim-black"></div>
                            </div>
                        </div>
                        {{--End Waiting Bar--}}
                        <div class="mt-4">
                            <p>Esperando por el pago</p>
                        </div>
                        {{--Timer--}}
                        <div class="flex justify-center mt-4">
                            @livewire('giving.timer')
                        </div>
                        {{--End Timer--}}
                        <div class="flex justify-end mt-8">
                            <button
                                @click="current='method'"
                                type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Atrás
                            </button>
                        </div>
                    </div>
                    {{--End Payment--}}
                </div>
            </form>
            {{--Loading Spinner--}}
            <div wire:loading wire:target="pay" class="flex items-center justify-center py-12 w-full h-full">
                <div class="flex justify-center items-center space-x-1 text-lg text-gray-700">
                    <svg fill='none' class="w-6 h-6 animate-spin" viewBox="0 0 32 32"
                         xmlns='http://www.w3.org/2000/svg'>
                        <path clip-rule='evenodd'
                              d='M15.165 8.53a.5.5 0 01-.404.58A7 7 0 1023 16a.5.5 0 011 0 8 8 0 11-9.416-7.874.5.5 0 01.58.404z'
                              fill='currentColor' fill-rule='evenodd'/>
                    </svg>
                    <div>Cargando...</div>
                </div>
            </div>
            {{--End Loading Spinner--}}
        </div>
    </div>
</div>

@prepend('scripts')
    <script>
        function init() {
            return {
                current: @entangle('currentStep'),
                copyText: 'Copiar al portapapeles',
                copyWallet() {
                    window.navigator.clipboard.writeText(this.wallet)

                    this.copyText = 'Copiado!'

                    setTimeout(() => {
                        this.copyText = 'Copy to clipboard'
                    }, 2000)
                },
            }
        }
    </script>
@endprepend
