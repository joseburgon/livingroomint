<x-base-layout>
    @section('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@iconscout/unicons@3.0.6/css/line.css">
    @endsection

    <div x-data="{ amount: 0.00, country: 'CO', currency: 'COP' }"
         class="flex flex-col justify-center items-center w-full h-full">
        <nav id="nav" class="fixed inset-x-0 top-0 flex flex-row justify-center z-10 text-white bg-transparent">
            <div class="p-4">
                <a href="https://www.livingroomint.org/">
                    <img class="w-32" src="{{ asset('img/logo-livingroom-blanco.svg') }}" alt="Logo Living Room">
                </a>
            </div>
        </nav>

        <header id="up" class="bg-center bg-no-repeat bg-center bg-cover w-full"
                style="background-image: url({{ asset('img/givings_header_1.jpeg') }});">
            <!-- Overlay Background + Center Control -->
            <div class="h-72 lg:h-96 bg-opacity-50 bg-black flex items-center justify-center"
                 style="background:rgba(0,0,0,0.5);">
                <div class="w-full mx-2 text-center">
                    <h1 class="text-gray-100 text-xl lg:text-3xl mb-4">
                        Donar en línea
                    </h1>
                    <div class="flex justify-center mb-4">
                        <div class="relative max-w-lg">
                            <span class="text-white absolute inline-block text-lg top-3 -left-5" aria-hidden="true"
                                  role="presentation">$</span>
                            <input
                                x-model="amount"
                                @keydown="handleInputKeyDown"
                                @keyup="handleAmountInputChange" type="text" pattern="\d*" inputmode="numeric"
                                id="amount_input" name="amount_input"
                                class="appearance-none transition-all text-5xl lg:text-6xl max-w-full h-20 lg:h-24 text-center text-white border-0 border-b border-white focus:border-white focus:shadow-none focus:ring-0 relative px-0 pb-3 bg-transparent"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </header>

        @livewire('giving.form')

        @if (session('error'))
            <div class="flex mt-8">
                <div class="bg-red-200 text-red-700 rounded-full p-1 fill-current">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>

                    </svg>
                </div>
                <span class="text-red-700 font-medium text-sm text-left ml-3">{{ session('error') }}</span>
            </div>
        @endif
    </div>

    <div class="flex flex-col justify-center items-center w-full">
        <div class="w-full lg:w-5/12 flex my-10">
            <x-footer bgColor="bg-gray-100"/>
        </div>
    </div>

    @push('scripts')
        @include('scripts.giving')
    @endpush
</x-base-layout>
