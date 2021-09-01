<x-base-layout>
    <form id="redirect" action="{{ $checkoutUrl }}" method="POST">
        @foreach ($params as $key => $value)
            <p>{{ $key }} - {{ $value }}</p>
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById('redirect').submit();
        });
    </script>
</x-base-layout>
