<script>
    document.addEventListener("DOMContentLoaded", function() {
        let amountInput = document.getElementById('amount');

        amountInput.value = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD'
        }).format(parseFloat(amountInput.value));

        amountInput.focus();

        amountInput.setSelectionRange(2, 2);
    });

    function handleAmountInputChange(e) {
        const minSize = 4;
        const maxSize = 15;

        const amountInput = e.target;

        const originalLength = amountInput.value.length;

        let currentAmount = parseCurrency(amountInput.value);

        let caretPosition = amountInput.selectionStart;

        if (isNaN(currentAmount)) {
            currentAmount = 0;
        }

        amountInput.value = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(currentAmount);

        const updatedLength = amountInput.value.length;

        caretPosition = updatedLength - originalLength + caretPosition;

        amountInput.setSelectionRange(caretPosition, caretPosition);

        let newSize = minSize;

        if (updatedLength > newSize) {
            newSize = updatedLength;

            if (newSize >= 10) {
                amountInput.classList.remove('text-5xl');
                amountInput.classList.add('text-4xl', 'py-4');
            } else {
                amountInput.classList.remove('text-4xl', 'py-4');
                amountInput.classList.add('text-5xl');
            }

            if (newSize > maxSize) {
                newSize = maxSize;
            }
        }

        amountInput.setAttribute('size', newSize);
    }

    function updateFlag(e) {
        console.log(e.target.value);

        this.country = e.target.value;
    }

    function parseCurrency(currency) {
        return Number(currency.replace(/[^0-9.-]+/g, ""));
    }
</script>
