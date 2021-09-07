<x-base-layout>
    @section('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@iconscout/unicons@3.0.6/css/line.css">
    @endsection

    <div class="flex flex-col h-screen">
        <div class="w-full h-1/3 bg-white flex items-center lg:justify-start p-4 lg:p-20">
            <div class="max-w-screen-md mx-auto w-full">
                <div class="flex flex-row items-center">
                    <div class="text-yellow-500 mr-5 lg:mr-10">
                        <svg class="h-16 w-16 lg:h-20 lg:w-20 text-yellow-500" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                            <path fill="none" class="fill-current" d="M14.8476562,13.0673828L12.5,11.7109375V7c0-0.276123-0.223877-0.5-0.5-0.5S11.5,6.723877,11.5,7v5c0.000061,0.1785278,0.0953369,0.3434448,0.25,0.4326172l2.5976562,1.5c0.0759277,0.0441895,0.1621704,0.0674438,0.25,0.0673828c0.1783447-0.0001221,0.3430786-0.0952148,0.432373-0.2495728C15.1682739,13.5114746,15.0866699,13.2056274,14.8476562,13.0673828z M12,2C6.4771729,2,2,6.4771729,2,12s4.4771729,10,10,10c5.5201416-0.0064697,9.9935303-4.4798584,10-10C22,6.4771729,17.5228271,2,12,2z M12,21c-4.9705811,0-9-4.0294189-9-9s4.0294189-9,9-9c4.9683228,0.0054321,8.9945679,4.0316772,9,9C21,16.9705811,16.9705811,21,12,21z"/>
                        </svg>
                    </div>
                    <h1 class="font-light text-4xl lg:text-5xl text-yellow-500">Esperemos un momento...</h1>
                </div>
            </div>
        </div>
        <div class="w-full h-1/2 bg-gray-100 border-t border-b border-gray-300">
            <div class="max-w-screen-md mx-auto">
                <div class="flex flex-col py-10 px-4 lg:px-0 lg:py-16">
                    <h2 class="font-bold text-2xl lg:text-3xl mb-8">Tu donación está pendiente de confirmación</h2>
                    <p class="font-normal text-base lg:text-xl">Has realizado una donación por un valor de
                        <strong>{{ $currency }} ${{ $amount }}</strong> a nuestra
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
        <div class="w-full h-1/4 bg-white">
            <div class="max-w-screen-md mx-auto">
                <x-footer bgColor="bg-white"/>
            </div>
        </div>
    </div>
</x-base-layout>
