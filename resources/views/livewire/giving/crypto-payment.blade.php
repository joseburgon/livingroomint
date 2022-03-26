<div class="bg-white w-full lg:w-5/12 -mt-8 lg:-mt-20 shadow-md rounded-lg overflow-hidden">
    <div class="items-center justify-between py-10 px-5 bg-white shadow-2xl rounded-lg mx-auto text-center">
        <div class="px-2 -mt-6">
            <form>
                <div class="text-center">
                    {{--Criptomoneda--}}
                    <div class="my-3">
                        <div class="mb-2">
                            <label for="type" class="text-gray-700">Selecciona una criptomoneda para pagar</label>
                        </div>
                        <div class="grid auto-rows-auto grid-cols-1 md:grid-cols-2 gap-2 mt-6">
                            @foreach($currencies as $symbol => $coinName)
                                <x-currency logo="{{ asset('img/currencies/' . $symbol . '.svg') }}" :name="$coinName" :symbol="$symbol" />
                            @endforeach
                        </div>
                    </div>
                    {{--End Criptomoneda--}}
                </div>
            </form>
        </div>
    </div>
</div>
