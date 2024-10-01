import Cleave from 'cleave.js';

const initMaskedRupiah = () => {
    let masked_element = document.querySelectorAll('.mask-rupiah');
    if(masked_element) {
        Array.from(masked_element).forEach((element) => {
            if(element.classList.contains('masked')) return;
            if(element.value == "") element.value = 0;
            //on init
            let temp_value = element.value;
            element.value = element.value.replace(/\./g, ',');
            element.classList.add('masked');

            // duplicate element
            let clone = element.cloneNode(true);
            clone.setAttribute('id', 'mask-rupiah-' + element.id);
            clone.classList.add('mask-rupiah-clone');
            clone.removeAttribute("name");
            clone.classList.remove('d-none');
            element.insertAdjacentElement('afterend', clone);

            new Cleave(clone, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand',
                delimiter: '.',
                numeralDecimalMark: ',',
                numeralDecimalScale: 2,
                numeralPositiveOnly: true,
                prefix: '',
                suffix: ',00'
            });

            element.value = temp_value;

            let changeEvent = new Event('change');

            const rupiahEventHandler =(ev) => {
                let n =  ev.target.value.replaceAll('\.', '');
                n = n.replace('\,','.');
                element.value = n;
                element.dispatchEvent(changeEvent);
            }

            let timeout;

            clone.addEventListener('keyup', function(ev) {
                timeout = setTimeout(function() {
                    rupiahEventHandler(ev);
                    if (timeout) {
                        clearTimeout(timeout)
                        timeout = null
                    }
                }, 50)
            });

            clone.addEventListener('change', function(ev) {
                setTimeout(function() {
                    rupiahEventHandler(ev);
                    if (timeout) {
                        clearTimeout(timeout)
                        timeout = null
                    }
                }, 50)
            });
        });
    }
}

initMaskedRupiah();