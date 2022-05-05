<x-base-layout>
    @section('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@iconscout/unicons@3.0.6/css/line.css">
    @endsection

    <div class="flex flex-col min-h-screen">
        <div class="w-full h-52 lg:h-64 bg-white flex items-center lg:justify-start p-4 lg:p-20">
            <div class="max-w-screen-md mx-auto w-full">
                <div class="flex flex-row items-center">
                    <div class="text-red-500 mr-5 lg:mr-10">
                        <svg class="h-16 w-16 lg:h-20 lg:w-20 text-red-500 fill-current" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                            <path fill="none" class="fill-current"
                                  d="M12,13h0.0006104c0.2759399-0.0001831,0.4995728-0.223999,0.4993896-0.5v-4C12.5,8.223877,12.276123,8,12,8s-0.5,0.223877-0.5,0.5v4.0005493C11.5001831,12.7765503,11.723999,13.0001831,12,13z M21.8535156,7.7119141l-5.5654297-5.5654297C16.1943359,2.0526733,16.0671997,2,15.9345703,2H8.0654297C7.9328003,2,7.8056641,2.0526733,7.7119141,2.1464844L2.1464844,7.7119141C2.0526733,7.8056641,2,7.9328003,2,8.0654297v7.8691406c0,0.1326294,0.0526733,0.2597656,0.1464844,0.3535156l5.5654297,5.5654297C7.8056641,21.9473267,7.9328003,22,8.0654297,22h7.8691406c0.1326294,0,0.2597656-0.0526733,0.3535156-0.1464844l5.5654297-5.5654297C21.9473267,16.1943359,22,16.0671997,22,15.9345703V8.0654297C22,7.9328003,21.9473267,7.8056641,21.8535156,7.7119141z M21,15.7275391L15.7275391,21H8.2724609L3,15.7275391V8.2724609L8.2724609,3h7.4550781L21,8.2724609V15.7275391z M12,14.375c-0.3451538,0-0.625,0.2798462-0.625,0.625s0.2798462,0.625,0.625,0.625s0.625-0.2798462,0.625-0.625S12.3451538,14.375,12,14.375z"/>
                        </svg>
                    </div>
                    <h1 class="font-light text-4xl lg:text-5xl text-red-500">Donación inválida</h1>
                </div>
            </div>
        </div>
        <div class="w-full min-h-full bg-gray-100 border-t border-b border-gray-300">
            <div class="max-w-screen-md mx-auto">
                <div class="flex flex-col py-10 px-4 lg:px-0 lg:py-16">
                    <h2 class="font-bold text-2xl lg:text-3xl mb-8">La transacción ya ha finalizado</h2>
                    <p class="font-normal text-base lg:text-xl">
                        Si lo que intentas es realizar una nueva donación entonces da click en el botón de abajo
                    </p>
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
