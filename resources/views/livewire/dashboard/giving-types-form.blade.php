<form wire:submit.prevent="submit">
    @csrf

    <div class="flex flex-col space-y-2">
        <label for="name" class="text-sm text-gray-700 dark:text-gray-400 select-none font-medium">Nombre del
            tipo</label>
        <input
            wire:model="name"
            type="text"
            name="name"
            placeholder="Concepto"
            class="px-4 py-2 rounded-lg border border-gray-300 dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:border-purple-400 focus:shadow-outline-purple dark:focus:shadow-outline-gray"
        />
        @error('name')
        <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
        @enderror
    </div>


    <div class="flex flex-col space-y-2">
        <label class="block mt-4">
            <span class="text-sm text-gray-700 dark:text-gray-400">
              Estado
            </span>
            <select
                wire:model="active"
                name="active"
                class="block w-full mt-1 rounded-lg border border-gray-300 dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
            >
                <option value="1" selected>Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </label>
        @error('active')
        <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
        @enderror
    </div>

    <div
        class="flex flex-col items-center justify-end px-6 py-3 mt-6 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
    >
        <a
            wire:loading.attr="disabled"
            href="#"
            class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
        >
            Cancelar
        </a>

        <button
            wire:loading.attr="disabled"
            type="submit"
            class="w-full px-5 py-3 text-sm font-medium leading-5 text-white dark:text-white transition-colors duration-150 bg-purple-600 dark:bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 dark:hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
        >
            <svg wire:loading wire:target="submit" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Crear
        </button>
    </div>
</form>

