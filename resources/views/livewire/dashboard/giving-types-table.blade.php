<div class="flex flex-col mt-8">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <div class="max-w-lg w-full lg:max-w-xs mb-4 lg:mb-0">
                    <label for="search" class="sr-only">Buscar</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input wire:model="search"
                               id="search"
                               class="block w-full pl-10 pr-3 py-2 text-white dark:text-white border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 focus:shadow-outline-blue sm:text-sm transition duration-150 ease-in-out"
                               placeholder="Search" type="search">
                    </div>
                </div>
                <div class="relative flex items-start nightwind-prevent-block">
                    <button
                        class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white dark:text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                    >
                        Agregar tipo
                        <span class="ml-2" aria-hidden="true">+</span>
                    </button>
                </div>
            </div>

            <div class="w-full overflow-hidden rounded-lg shadow-xs mt-4">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                        >
                            <th class="px-4 py-3">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('id')"
                                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase dark:border-gray-700 dark:text-gray-400">
                                        ID
                                    </button>
                                    <x-dashboard.sort-icon field="id" :sortField="$sortField" :sortAsc="$sortAsc" class="text-gray-500 bg-gray-50 nightwind-prevent-block"/>
                                </div>
                            </th>
                            <th class="px-4 py-3">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('name')"
                                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase dark:border-gray-700 dark:text-gray-400">
                                        Nombre
                                    </button>
                                    <x-dashboard.sort-icon field="name" :sortField="$sortField" :sortAsc="$sortAsc" class="text-gray-500 bg-gray-50 nightwind-prevent-block"/>
                                </div>
                            </th>
                            <th class="px-4 py-3">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('active')"
                                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase dark:border-gray-700 dark:text-gray-400">
                                        ¿Activo?
                                    </button>
                                    <x-dashboard.sort-icon field="active" :sortField="$sortField" :sortAsc="$sortAsc" class="text-gray-500 bg-gray-50 nightwind-prevent-block"/>
                                </div>
                            </th>
                        </tr>
                        </thead>
                        <tbody
                            class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                        >
                        @foreach($types as $type)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">{{ $type->id }}</td>
                                <td class="px-4 py-3 text-sm">{{ $type->name }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <div
                                        class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                        <input wire:click="toggleActive({{ $type->id }})" type="checkbox" name="toggle"
                                               class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                                            {{ $type->active ? 'checked' : '' }}
                                        />
                                        <label for="toggle"
                                               class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $types->links() }}
            </div>
        </div>
    </div>
</div>
