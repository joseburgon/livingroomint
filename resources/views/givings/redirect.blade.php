<x-base-layout>
    <div class="h-screen flex justify-center items-center">
        <div class="flex flex-col items-center justify-center ">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 text-black animate-spin" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5"
                      d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
            </svg>
            <h2 class="mt-10">Redireccionando a la pasarela de pagos...</h2>
        </div>
        <form id="redirect" action="{{ $checkoutUrl }}" method="POST">
            @foreach ($params as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById('redirect').submit();
        });
    </script>
</x-base-layout>
