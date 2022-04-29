<x-base-layout>
    @section('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@iconscout/unicons@3.0.6/css/line.css">
    @endsection

    <div class="flex flex-col min-h-screen">
        <div class="w-full h-1/3 bg-white flex items-center lg:justify-start p-4 lg:p-20">
            <div class="max-w-screen-md mx-auto w-full">
                <div class="flex flex-row items-center">
                    <div class="text-green-500 mr-5 lg:mr-10">
                        <svg class="h-16 w-16 lg:h-20 lg:w-20" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <g id="44.-Check" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                               stroke-linecap="round" stroke-linejoin="round">
                                <g transform="translate(2.000000, 2.000000)" stroke="currentColor" stroke-width="4">
                                    <path
                                        d="M48,96 C74.509668,96 96,74.509668 96,48 C96,21.490332 74.509668,0 48,0 C21.490332,0 0,21.490332 0,48 C0,74.509668 21.490332,96 48,96 Z"
                                        id="Layer-1"></path>
                                    <polyline id="Layer-2"
                                              points="27.7058857 47.0210276 42.0345786 61.4826208 67.9945661 35.4382535"></polyline>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <h1 class="font-light text-4xl lg:text-5xl text-green-500">¡Muy bien!</h1>
                </div>
            </div>
        </div>
        <div class="w-full min-h-full bg-gray-100 border-t border-b border-gray-300">
            <div class="max-w-screen-md mx-auto">
                <div class="flex flex-col py-10 px-4 lg:px-0 lg:py-16">
                    <h2 class="font-bold text-2xl lg:text-3xl mb-8">¡Gracias! Hemos recibido tu donación.</h2>
                    <p class="font-normal text-base lg:text-xl">Has realizado una donación por un valor de
                        <strong>{{ strtoupper($currency) }} ${{ $amount }}</strong> a nuestra
                        comunidad.</p>
                    <p class="font-normal text-base lg:text-xl">Recibirás una notificación en
                        <strong>{{ $email }}</strong> cuando la donación
                        haya sido procesada.</p>
                    <div class="flex mt-8">
                        <a href="{{ route('donaciones') }}"
                           class="bg-black text-white text-lg lg:text-xl px-6 py-2 rounded font-bold hover:bg-gray-800 transition duration-200 each-in-out">Hacer
                            otra donación</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full h-52 lg:h-64 bg-white">
            <div class="max-w-screen-md mx-auto">
                <x-footer bgColor="bg-white"/>
            </div>
        </div>
    </div>
</x-base-layout>
