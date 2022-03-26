<x-base-layout>
    <div class="flex flex-col justify-center items-center w-full h-full">
        <nav id="nav" class="fixed inset-x-0 top-0 flex flex-row justify-center z-10 text-white bg-transparent">
            <div class="p-4">
                <a href="https://www.livingroomint.org/">
                    <img class="w-32" src="{{ asset('img/logo-livingroom-blanco.svg') }}" alt="Logo Living Room">
                </a>
            </div>
        </nav>

        <header id="up" class="bg-center bg-no-repeat bg-center bg-cover w-full" style="background-image: url({{ asset('img/givings_header_1.jpeg') }});">
            <!-- Overlay Background + Center Control -->
            <div class="h-72 lg:h-96 bg-opacity-50 bg-black flex items-center justify-center"
                 style="background:rgba(0,0,0,0.5);">
                <div class="w-full mx-2 text-center">
                    <h1 class="text-gray-100 text-xl lg:text-3xl mb-4">Donar con Crypto</h1>
                    <h3 class="text-white text-lg lg:text-xl">{{ "{$giving->amount} (USD)" }}</h3>
                </div>
            </div>
        </header>

        <!-- Form -->
        @livewire('giving.crypto-payment', ['invoice' => $invoice])
        <!-- End Form -->
    </div>

    <div class="flex flex-col justify-center items-center w-full">
        <div class="w-full lg:w-5/12 flex my-10">
            <x-footer bgColor="bg-gray-100"/>
        </div>
    </div>
</x-base-layout>
