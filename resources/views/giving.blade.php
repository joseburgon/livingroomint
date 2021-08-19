<x-base-layout>
    <div x-data="{ amount: 0, country: 'CO', currency: 'COP' }" class="flex flex-col justify-center items-center w-full h-full">
        <nav id="nav" class="fixed inset-x-0 top-0 flex flex-row justify-center z-10 text-white bg-transparent">
            <div class="p-4">
                <a href="#">
                    <img class="w-40" src="{{ asset('img/logo-livingroom-blanco.svg') }}" alt="Logo Living Room">
                </a>
            </div>
        </nav>

        <header id="up" class="bg-center bg-fixed bg-no-repeat bg-center bg-cover w-full">
            <!-- Overlay Background + Center Control -->
            <div class="h-72 lg:h-96 bg-opacity-50 bg-black flex items-center justify-center"
                 style="background:rgba(0,0,0,0.5);">
                <div class="mx-2 text-center">
                    <h1 class="text-gray-100 text-xl lg:text-3xl mb-4">
                        Donar
                    </h1>
                    <div class="mb-4">
                        <div class="flex flex-col items-center relative">
                            <input
                                x-model="amount"
                                @keyup="handleAmountInputChange" type="text" id="amount" name="amount" size="4"
                                class="text-5xl lg:text-6xl w-3/4 text-center text-white border-white border-0 border-b-2 focus:border-current focus:shadow-none focus:ring-0 relative px-0 pb-3 bg-transparent"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Form -->
        @livewire('giving.form')
        <!-- End Form -->
    </div>

    @include('scripts.giving')
</x-base-layout>
