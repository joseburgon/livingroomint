<div class="bg-white w-full lg:w-5/12 -mt-8 lg:-mt-20 shadow-md rounded-lg overflow-hidden">
    <div class="items-center justify-between py-10 px-5 bg-white shadow-2xl rounded-lg mx-auto text-center">
        <div class="px-2 -mt-6">
            <form wire:submit.prevent="donate">
                <div class="text-center">
                    <div class="">
                        <div class="my-3">
                            <div class="mb-2">
                                <label for="type" class="text-gray-700">Moneda</label>
                            </div>
                            <div class="flex justify-center">
                                <label class="flex radio p-2 cursor-pointer">
                                    <input class="my-auto" type="radio" name="currency" />
                                    <span class="title px-2">COP</span>
                                </label>
                                <label class="flex radio p-2 cursor-pointer">
                                    <input class="my-auto" type="radio" name="currency" />
                                    <span class="title px-2">USD</span>
                                </label>
                            </div>
                        </div>
                        <div class="my-3">
                            <div class="mb-2">
                                <label for="type" class="text-gray-700">Tipo de donación</label>
                            </div>
                            <select
                                name="type"
                                id="type"
                                class="form-select appearance-none block w-full px-5 py-2 border-gray-200 rounded-lg bg-white shadow-lg placeholder-gray-400 text-gray-700 focus:border-transparent focus:ring-2 focus:ring-gray-400"
                            >
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="my-3 flex flex-col">
                            <div class="mb-2">
                                <label for="" class="text-gray-700">Tus datos</label>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <input
                                    type="text"
                                    name="first_name"
                                    id="first_name"
                                    class="block w-full px-5 py-2 border-gray-200 rounded-lg bg-white shadow-lg placeholder-gray-400 text-gray-700 focus:border-transparent focus:ring-2 focus:ring-gray-400"
                                    placeholder="Nombre"
                                    maxlength="50"
                                />
                                <input
                                    type="text"
                                    name="last_name"
                                    id="last_name"
                                    class="block w-full px-5 py-2 border-gray-200 rounded-lg bg-white shadow-lg placeholder-gray-400 text-gray-700 focus:border-transparent focus:ring-2 focus:ring-gray-400"
                                    placeholder="Apellido"
                                    maxlength="50"
                                />
                            </div>
                        </div>
                        <div class="my-3">
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="block w-full px-5 py-2 border-gray-200 rounded-lg bg-white shadow-lg placeholder-gray-400 text-gray-700 focus:border-transparent focus:ring-2 focus:ring-gray-400"
                                placeholder="Correo Electrónico"
                            />
                        </div>
                        <div class="my-3">
                            <input
                                type="text"
                                name="phone"
                                id="phone"
                                class="block w-full px-5 py-2 border-gray-200 rounded-lg bg-white shadow-lg placeholder-gray-400 text-gray-700 focus:border-transparent focus:ring-2 focus:ring-gray-400"
                                placeholder="Teléfono / Celular"
                            />
                        </div>
                        <div class="flex flex-wrap items-stretch my-3">
                            <div class="flex">
									<span
                                        class="flex items-center leading-normal bg-grey-lighter border-1 rounded-r-none shadow-lg border border-r-0 border-gray-100 px-3 whitespace-no-wrap text-grey-dark text-sm w-12 h-10 bg-gray-100 justify-center items-center text-xl rounded-lg text-white">
                                    <img :src="'https://flagcdn.com/' + country.toLowerCase() + '.svg'" class="w-8" alt="Selected Country Flag">
                                   </span>
                            </div>
                            <select
                                @change="updateFlag"
                                name="country"
                                id="country"
                                class="form-select appearance-none flex-shrink flex-grow flex-auto px-5 py-2 border-gray-200 border-l-0 rounded-lg rounded-l-none bg-white shadow-lg placeholder-gray-400 text-gray-700 focus:border-transparent focus:ring-2 focus:ring-gray-400"
                            >
                                <option value="" selected disabled>País</option>
                                <option value="CO">Colombia</option>
                                <option value="US">Estados Unidos</option>
                                <option value="ES">España</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

