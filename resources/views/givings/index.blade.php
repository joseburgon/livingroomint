<x-base-layout>
    @section('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@iconscout/unicons@3.0.6/css/line.css">
    @endsection

    <div x-data="{ amount: 0, country: 'CO', currency: 'COP' }"
         class="flex flex-col justify-center items-center w-full h-full">
        <nav id="nav" class="fixed inset-x-0 top-0 flex flex-row justify-center z-10 text-white bg-transparent">
            <div class="p-4">
                <a href="https://www.livingroomint.org/">
                    <img class="w-40" src="{{ asset('img/logo-livingroom-blanco.svg') }}" alt="Logo Living Room">
                </a>
            </div>
        </nav>

        <header id="up" class="bg-center bg-fixed bg-no-repeat bg-center bg-cover w-full">
            <!-- Overlay Background + Center Control -->
            <div class="h-72 lg:h-96 bg-opacity-50 bg-black flex items-center justify-center"
                 style="background:rgba(0,0,0,0.5);">
                <div class="w-full mx-2 text-center">
                    <h1 class="text-gray-100 text-xl lg:text-3xl mb-4">
                        Donar en línea
                    </h1>
                    <div class="mb-4">
                        <div class="flex flex-col items-center relative">
                            <input
                                x-model="amount"
                                @keyup="handleAmountInputChange" type="text" id="amount_input" name="amount_input"
                                size="5"
                                class="appearance-none transition-all text-5xl lg:text-6xl max-w-full text-center text-white border-0 border-b-2 border-white focus:border-current focus:shadow-none focus:ring-0 relative px-0 pb-3 bg-transparent"
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

    <div class="flex flex-col justify-center items-center w-full">
        <div class="w-full lg:w-5/12 flex my-10">
            <x-footer bgColor="bg-gray-100"/>
        </div>
    </div>

    @section('scripts')
        @include('scripts.giving')
    @endsection
</x-base-layout>
