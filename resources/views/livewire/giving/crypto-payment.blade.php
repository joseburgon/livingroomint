<div class="bg-white w-full lg:w-5/12 -mt-8 lg:-mt-20 shadow-md rounded-lg overflow-hidden">
    <div class="items-center justify-between py-10 px-5 bg-white shadow-2xl rounded-lg mx-auto text-center">
        <div x-data="{ current: @entangle('currentStep') }" class="px-2 -mt-6">
            <form wire:loading.remove>
                <div class="text-center">
                    {{--Criptomoneda--}}
                    <div  x-show="current === 'method'" class="my-3">
                        <div class="mb-2">
                            <label for="type" class="text-lg text-gray-700">Selecciona una criptomoneda para pagar</label>
                        </div>
                        <div class="grid auto-rows-auto grid-cols-1 md:grid-cols-2 gap-2 mt-6">
                            @foreach($currencies as $symbol => $coinName)
                                <x-currency logo="{{ asset('img/currencies/' . $symbol . '.svg') }}" :name="$coinName" :symbol="$symbol" />
                            @endforeach
                        </div>
                    </div>
                    {{--End Criptomoneda--}}
                    {{--Payment--}}
                    <div x-show="current === 'payment'" class="my-3">
                        <div class="mb-2">
                            <label for="type" class="text-lg text-gray-700">Envía el pago</label>
                            <p class="text-sm mt-2">Para realizar un pago, envíe el pago utilizando el código QR o los botones a continuación</p>
                        </div>
                        <div class="flex flex-col justify-center my-8">
                            <div class="flex justify-center mb-6">
                                {!! $qrCode !!}
                            </div>
                            <p class="text-sm text-gray-400 mb-8">{{ "Only send {$paymentMethod} to this address" }}</p>
                            <div class="flex rounded border">
                                <div class="flex flex-col">
                                    <p class="text-xs text-gray-400">{{ "{$paymentMethod} Address" }}</p>
                                    <p class="">{{ $this->wallet }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end mt-16">
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
            <div wire:loading class="flex items-center justify-center py-12 w-full h-full">
                <div class="flex justify-center items-center space-x-1 text-lg text-gray-700">
                    <svg fill='none' class="w-6 h-6 animate-spin" viewBox="0 0 32 32" xmlns='http://www.w3.org/2000/svg'>
                        <path clip-rule='evenodd'
                              d='M15.165 8.53a.5.5 0 01-.404.58A7 7 0 1023 16a.5.5 0 011 0 8 8 0 11-9.416-7.874.5.5 0 01.58.404z'
                              fill='currentColor' fill-rule='evenodd' />
                    </svg>
                    <div>Cargando...</div>
                </div>
            </div>
        </div>
    </div>
</div>
