<script>
    let browserInfo = null;

    let isMobile = false;

    const factors = {
        'Google Chrome': 0,
        'Mozilla Firefox': -4,
        'Microsoft Edge': 1,
        'Safari': 0,
        'Brave Browser': 1,
        'Samsung Browser': 1,
        'Opera': 1,
        'Other': 1
    }

    const amountInput = document.getElementById('amount_input');

    function toggleNavBackground() {
        const nav = document.getElementById('nav');

        window.addEventListener('scroll', () => {
            let yPosition = window.scrollY;

            if (yPosition > 100) {
                nav.classList.remove('bg-transparent');
                nav.classList.add('bg-black');
            }
            else {
                nav.classList.remove('bg-black');
                nav.classList.add('bg-transparent');
            }
        });
    }

    function handleAmountInputChange() {
        const minSize = 5;
        const maxSize = 16;
        const factor = factors[browserInfo.name] ?? factors['Other'];

        const originalLength = amountInput.value.length;

        let caretPosition = amountInput.selectionStart;

        let currentAmount = parseCurrency(amountInput.value);

        if (isNaN(currentAmount)) {
            currentAmount = 0;
        }

        Livewire.emit('amountChanged', currentAmount);

        amountInput.value = new Intl.NumberFormat('en-US', {style: 'currency', currency: 'USD'}).format(currentAmount);

        const updatedLength = amountInput.value.length;

        caretPosition = updatedLength - originalLength + caretPosition;

        amountInput.setSelectionRange(caretPosition, caretPosition);

        let newSize = minSize;

        if (updatedLength >= newSize) {
            if (factor >= 0) {
                newSize = (updatedLength + factor);
            } else {
                newSize = (updatedLength - Math.abs(factor));
            }

            newSize += (isMobile ? 1 : 0);

            if (newSize >= 9 && isMobile) {
                if (amountInput.classList.contains('text-5xl')) {
                    amountInput.classList.remove('text-5xl');
                    amountInput.classList.add('text-4xl', 'py-5');
                }
            } else {
                amountInput.classList.remove('text-4xl', 'py-5');
                amountInput.classList.add('text-5xl');
            }

            if (newSize >= maxSize) {
                return;
            }
        }

        amountInput.setAttribute('size', newSize);
    }

    function parseCurrency(currency) {
        return Number(currency.replace(/[^0-9.-]+/g, ""));
    }

    document.addEventListener("DOMContentLoaded", function () {
        browserInfo = BrowserDetector.parseUserAgent();

        isMobile = browserInfo.isMobile;

        console.log(browserInfo);

        amountInput.value = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD'
        }).format(parseFloat(amountInput.value));

        amountInput.focus();

        amountInput.setSelectionRange(1, 1);

        handleAmountInputChange();

        toggleNavBackground();
    });
</script>
