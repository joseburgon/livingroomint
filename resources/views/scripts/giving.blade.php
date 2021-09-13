<script>
    let browserInfo = null;

    let isMobile = false;

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

    function handleInputKeyDown(event) {
        const allowedKeys = ['Backspace', 'Delete', 'ArrowUp', 'ArrowDown', 'ArrowRight', 'ArrowLeft' , 'Home', 'End'];

        if (!allowedKeys.includes(event.key)) {
            event.preventDefault();
        }
    }

    function handleAmountInputChange(event = null) {
        const maxLength = 13;

        const originalLength = amountInput.value.length;

        if (originalLength >= maxLength) {
            return;
        }

        let numberEntered = '';

        if (event) {
            numberEntered = isNumber(event.key) ? event.key : '';
        }

        let caretPosition = amountInput.selectionStart;

        let valueString = amountInput.value.toString();

        let valueArray = Array.from(valueString);

        valueArray.splice(caretPosition, 0, numberEntered);

        valueString = valueArray.join('');

        valueString = valueString.replace('.', '').replace(',', '');

        valueString = valueString.slice(0, valueString.length - 2) + '.' + valueString.slice(valueString.length - 2, valueString.length);

        if (valueString.length > 3 && valueString.slice(0, 2) === '00') {
            valueString = valueString.slice(1);
        }

        let currentAmount = parseCurrency(valueString);

        if (isNaN(currentAmount)) {
            currentAmount = 0;
        }

        Livewire.emit('amountChanged', currentAmount);

        amountInput.value = new Intl.NumberFormat('en-US', {
            maximumFractionDigits: 2,
            minimumFractionDigits: 2,
        }).format(currentAmount);

        amountInput.style.width = getElementWidth(amountInput);

        const updatedLength = amountInput.value.length;

        caretPosition = updatedLength - originalLength + caretPosition;

        amountInput.setSelectionRange(caretPosition, caretPosition);

        if (updatedLength > 10 && isMobile) {
            if (amountInput.classList.contains('text-5xl')) {
                amountInput.classList.remove('text-5xl');
                amountInput.classList.add('text-4xl');
                amountInput.style.width = getElementWidth(amountInput, '36px');
            }
        } else {
            if (amountInput.classList.contains('text-4xl')) {
                amountInput.classList.remove('text-4xl');
                amountInput.classList.add('text-5xl');
                amountInput.style.width = getElementWidth(amountInput, '48px');
            }
        }
    }

    function getElementWidth(input, fontSize = '') {
        const canvas = document.createElement("canvas");

        let context = canvas.getContext("2d");

        if (fontSize) {
            context.font = `${fontSize} ${getComputedStyle(input).fontFamily}`;
        } else {
            context.font = `${getComputedStyle(input).fontSize} ${getComputedStyle(input).fontFamily}`;
        }

        const width = context.measureText(input.value).width;

        return Math.ceil(width) + "px";
    }

    function parseCurrency(currency) {
        return Number(currency.replace(/[^0-9.-]+/g, ""));
    }

    function isNumber(n) {
        return /^-?[\d.]+(?:e-?\d+)?$/.test(n);
    }

    document.addEventListener("DOMContentLoaded", function () {
        browserInfo = BrowserDetector.parseUserAgent();

        isMobile = browserInfo.isMobile;

        console.log(browserInfo);

        amountInput.value = new Intl.NumberFormat('en-US', {
            maximumFractionDigits: 2,
            minimumFractionDigits: 2,
        }).format(amountInput.value);

        amountInput.focus();

        amountInput.setSelectionRange(4, 4);

        handleAmountInputChange();

        toggleNavBackground();
    });
</script>
