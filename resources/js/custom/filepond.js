import $ from 'jquery';
import * as Filepond from "filepond";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";

$(document).ready(function () {
    Filepond.registerPlugin(FilePondPluginImagePreview);

    document.addEventListener('FilePond:addfilestart', (e) => {
        let {target, detail} = e;
        //find input children
        let inputs = target.querySelectorAll('input');

        if(target.classList.contains('fp-init')) {
            setTimeout(() => {
                if(inputs[1].value !== '' && typeof detail.file.source == 'string'){
                    console.log('input removed');
                    inputs[1].value = '';
                }
            }, 100);
            target.classList.remove('fp-init');
        };
    });

    $(".filepond").each(function () {
        this.classList.add('fp-init');
        let val = this.dataset?.source ?? null;
        val = val == "" ? null : val;

        let opts = {};
        if (val !== null) {
            opts = {
                files: [
                    {
                        source: val,
                    }
                ]
            };
        }

        Filepond.create(this, {
            storeAsFile: true,
            ...opts
        });
    });
});
