<div class="bg-white w-full lg:w-5/12 -mt-8 lg:-mt-20 shadow-md rounded-lg overflow-hidden">
    <div class="items-center justify-between py-10 px-5 bg-white shadow-2xl rounded-lg mx-auto text-center">
        <div class="px-2 -mt-6">
            <form wire:submit.prevent="give">
                <div class="text-center">
                    <div class="">
                        {{--CURRENCY--}}
                        <div class="my-3">
                            <div class="mb-2">
                                <label for="type" class="text-gray-700">Moneda</label>
                            </div>
                            <div
                                class="w-full bg-gray-200 text-sm text-gray-500 leading-none border-2 border-gray-200 rounded inline-flex">
                                <button
                                    @click="currency='COP'"
                                    wire:click="currencyChanged('COP')"
                                    type="button"
                                    :class="{ 'bg-black text-white' : currency === 'COP' }"
                                    class="w-full inline-flex justify-center items-center transition-colors duration-300 ease-in focus:outline-none focus:text-white rounded-l p-2 lg:p-4"
                                    id="COP">
                                    <span>Peso Colombiano (COP)</span>
                                </button>
                                <button
                                    @click="currency='USD'"
                                    wire:click="currencyChanged('USD')"
                                    type="button"
                                    :class="{ 'bg-black text-white' : currency === 'USD' }"
                                    class="w-full inline-flex justify-center items-center transition-colors duration-300 ease-in focus:outline-none focus:text-white rounded-r p-2 lg:p-4"
                                    id="USD">
                                    <span>Dólar Americano (USD)</span>
                                </button>
                                {{--<button--}}
                                {{--@click="currency='BTC'"--}}
                                {{--wire:click="currencyChanged('BTC')"--}}
                                {{--type="button"--}}
                                {{--:class="{ 'bg-black text-white' : currency === 'BTC' }"--}}
                                {{--class="w-full inline-flex justify-center items-center transition-colors duration-300 ease-in focus:outline-none focus:text-white rounded-r p-2 lg:p-4"--}}
                                {{--id="USD">--}}
                                {{--<span>Bitcoin (USD/BTC)</span>--}}
                                {{--</button>--}}
                            </div>
                        </div>
                        {{--TYPE--}}
                        <div class="my-3">
                            <div class="mb-2">
                                <label for="type" class="text-gray-700">Tipo de donación</label>
                            </div>
                            <select
                                wire:model="giving_type_id"
                                name="type"
                                id="type"
                                class="form-select appearance-none block w-full px-5 py-2 border-gray-200 rounded-lg bg-white shadow-lg placeholder-gray-400 text-gray-700 focus:border-transparent focus:ring-2 focus:ring-gray-400"
                            >
                                @foreach($givingTypes->pluck('name', 'id') as $givingTypeId => $givingTypeName)
                                    <option value="{{ $givingTypeId }}">{{ $givingTypeName }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{--PERSONAL DATA--}}
                        <div class="my-3 flex flex-col">
                            <div class="mb-2">
                                <label for="" class="text-gray-700">Tus datos</label>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <input
                                    type="text"
                                    wire:model="first_name"
                                    name="first_name"
                                    id="first_name"
                                    class="block w-full px-5 py-2 border-gray-200 rounded-lg bg-white shadow-lg placeholder-gray-400 text-gray-700 focus:border-transparent focus:ring-2 focus:ring-gray-400"
                                    placeholder="Nombre"
                                    maxlength="50"
                                />
                                <input
                                    type="text"
                                    wire:model="last_name"
                                    name="last_name"
                                    id="last_name"
                                    class="block w-full px-5 py-2 border-gray-200 rounded-lg bg-white shadow-lg placeholder-gray-400 text-gray-700 focus:border-transparent focus:ring-2 focus:ring-gray-400"
                                    placeholder="Apellido"
                                    maxlength="50"
                                />
                            </div>
                        </div>
                        {{--DOCUMENT--}}
                        <div class="my-3">
                            <div class="grid lg:grid-cols-2 gap-2">
                                <select
                                    name="document_type_id"
                                    wire:model="document_type_id"
                                    id="document_type"
                                    class="form-select appearance-none flex-shrink flex-grow flex-auto w-full py-2 border-gray-200 rounded-lg bg-white shadow-lg placeholder-gray-400 text-gray-700 focus:border-transparent focus:ring-2 focus:ring-gray-400"
                                >
                                    @foreach($documentTypes as $documentTypeId => $documentTypeName)
                                        <option value="{{ $documentTypeId }}">{{ $documentTypeName }}</option>
                                    @endforeach
                                </select>
                                <input
                                    type="text"
                                    wire:model="document"
                                    name="document"
                                    id="document"
                                    class="block w-full py-2 border-gray-200 rounded-lg bg-white shadow-lg placeholder-gray-400 text-gray-700 focus:border-transparent focus:ring-2 focus:ring-gray-400"
                                    placeholder="Documento de Identidad"
                                    maxlength="50"
                                />
                            </div>
                        </div>
                        {{--EMAIL--}}
                        <div class="my-3">
                            <input
                                type="email"
                                wire:model="email"
                                name="email"
                                id="email"
                                class="block w-full px-5 py-2 border-gray-200 rounded-lg bg-white shadow-lg placeholder-gray-400 text-gray-700 focus:border-transparent focus:ring-2 focus:ring-gray-400"
                                placeholder="Correo Electrónico"
                            />
                        </div>
                        {{--PHONE--}}
                        <div class="my-3">
                            <input
                                type="text"
                                wire:model="phone"
                                name="phone"
                                id="phone"
                                class="block w-full px-5 py-2 border-gray-200 rounded-lg bg-white shadow-lg placeholder-gray-400 text-gray-700 focus:border-transparent focus:ring-2 focus:ring-gray-400"
                                placeholder="Teléfono / Celular"
                            />
                        </div>
                        {{--COUNTRY--}}
                        <div class="my-3 flex flex-col">
                            <div class="mb-2">
                                <label for="type" class="text-gray-700">¿Desde donde estás donando?</label>
                            </div>
                            <div class="flex items-stretch">
                                <div class="flex">
									<span
                                        class="flex items-center leading-normal bg-grey-lighter border-1 rounded-r-none shadow-lg border border-r-0 border-gray-100 px-3 whitespace-no-wrap text-grey-dark text-sm w-12 h-10 bg-gray-100 justify-center items-center text-xl rounded-lg text-white">
                                    <img :src="'https://flagcdn.com/' + country.toLowerCase() + '.svg'" class="w-8"
                                         alt="Selected Country Flag">
                                   </span>
                                </div>
                                <select
                                    wire:model="country"
                                    x-model="country"
                                    name="country"
                                    id="country"
                                    class="form-select appearance-none overflow-x-hidden w-full flex-shrink flex-grow flex-auto px-5 py-2 border-gray-200 border-l-0 rounded-lg rounded-l-none bg-white shadow-lg placeholder-gray-400 text-gray-700 focus:border-transparent focus:ring-2 focus:ring-gray-400"
                                >
                                    @foreach($countries as $code => $name)
                                        <option value="{{ $code }}">{{ $name }}</option>
                                        @if($loop->index === 8)
                                            <option value="" disabled>------------------------</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <input wire:model="currency" x-model="currency" type="hidden" name="currency">

                        {{--VALIDATION ERRORS--}}
                        @if ($errors->any())
                            <div class="flex justify-start mt-3 ml-4 p-1">
                                <ul>
                                    @foreach ($errors->all() as $error)
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
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{--GIVE BUTTON--}}
                        <div class="mt-6">
                            <button
                                wire:loading.attr="disabled"
                                wire:target="give"
                                type="submit"
                                class="flex justify-center items-center px-4 py-3 rounded bg-black text-gray-200 hover:bg-gray-700 disabled:opacity-50 cursor-pointer focus:ring focus:outline-none w-full text-xl font-semibold transition-colors"
                            >
                                <svg wire:loading wire:target="give" class="-ml-1 mr-3 h-5 w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>Donar En Línea</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

