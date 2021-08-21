<script>
    document.addEventListener("DOMContentLoaded", function() {
        let amountInput = document.getElementById('amount');

        amountInput.value = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD'
        }).format(parseFloat(amountInput.value));

        amountInput.focus();

        amountInput.setSelectionRange(1, 1);
    });

    const isMobile = detectDevice();

    console.log(`isMobile`, isMobile);

    function handleAmountInputChange(e) {
        const minSize = 4;
        const maxSize = 17;

        const amountInput = e.target;

        const originalLength = amountInput.value.length;

        let caretPosition = amountInput.selectionStart;

        console.log(`before`, amountInput.value);
        let currentAmount = parseCurrency(amountInput.value);
        console.log(`after`, currentAmount);

        if (isNaN(currentAmount)) {
            currentAmount = 0;
        }

        amountInput.value = new Intl.NumberFormat('en-US', {  style: 'currency', currency: 'USD' }).format(currentAmount);

        const updatedLength = amountInput.value.length;

        caretPosition = updatedLength - originalLength + caretPosition;

        amountInput.setSelectionRange(caretPosition, caretPosition);

        let newSize = minSize;

        if (updatedLength >= newSize) {
            newSize = updatedLength + 1;

            if (newSize >= 9 && isMobile) {
                amountInput.classList.remove('text-5xl');
                amountInput.classList.add('text-4xl', 'py-5');
            } else {
                amountInput.classList.remove('text-4xl', 'py-5');
                amountInput.classList.add('text-5xl');
            }

            if (newSize > maxSize) {
                newSize = maxSize;
            }
        }

        amountInput.setAttribute('size', newSize);
    }

    function parseCurrency(currency) {
        return Number(currency.replace(/[^0-9.-]+/g, ""));
    }

    function detectDevice() {
        return (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ||
            (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.platform)));
    }
</script>
