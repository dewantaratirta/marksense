import $ from 'jquery';
import select2 from 'select2';

select2(); 
window.$ = $;

const initSelect2 = () => {
    console.log('select2 initiated');

    let select2elements = document.querySelectorAll('.select2');
    if(!select2elements) return;

    Array.from(select2elements).forEach((element) => {
        let opts = {};
        // let dataset = element?.dataset;
        // let name = element?.name;
        let changeUrlAfterSelect = (element.dataset?.changeUrlAfterSelect) ? JSON.parse(element.dataset.changeUrlAfterSelect) : false;
        let clearAfterSelect = (element.dataset?.clearAfterSelect) ? JSON.parse(element.dataset.clearAfterSelect) : false;

        if(element.dataset.url) {
            opts = {
                ajax: {
                    url: function(params) {
                        let url = element.dataset.url;
                        let {urlParams} = element.dataset;
                        if(!urlParams) return url
                        return url + `?filter=${urlParams}`;
                    }
                  }
            }

            // addons options
            if(element.dataset?.addonsOptions) {
                let addonsOptions = JSON.parse(element.dataset.addonsOptions);
                console.log(addonsOptions);

                Array.from(addonsOptions).forEach((addonsOptions) => {
                    let option = document.createElement('option');
                    option.text = addonsOptions.text;
                    option.value = addonsOptions.id;
                    element.appendChild(option);
                });

                opts.ajax.processResults = function(data) {
                    console.log(addonsOptions);
                    return {
                        results: [...addonsOptions, ...data.results]
                    };
                }
            }
        }

        $(element).select2(opts);

        // clear other select2 on change
        if(clearAfterSelect) {
            let target_el = [];
            if(clearAfterSelect.length == 0) return;
            clearAfterSelect.forEach((el) => {
                target_el.push(document.querySelector(`[name=${el}]`));
            })

            $(element).on('change.select2', function() {
                target_el.forEach((el) => {
                    if(!el || el?.options?.length == 0) return;
                    // console.log(el, el.options);
                    Array.from(el.options).forEach((option) => {
                        el.removeChild(option);
                    });
                    setTimeout(() => {
                        $(el).trigger('change');
                    }, 200);
                })
            });
        }

        if(changeUrlAfterSelect){
            //init
            if(changeUrlAfterSelect.length > 0){
                changeUrlAfterSelect.forEach((el) => {
                    let target_el = document.querySelector(`[name=${el}]`);
                    if(!target_el) return;
                    target_el.dataset.urlParams = $(element).val();
                });
            }


            // change url after select
            $(element).on('change.select2', function() {
                if(changeUrlAfterSelect.length == 0) return;
                let val = $(this).val();

                changeUrlAfterSelect.forEach((el) => {
                    let target_el = document.querySelector(`[name=${el}]`);
                    if(!target_el) return;

                    target_el.dataset.urlParams = val;
                });
            });
        }
    })
};

window.initSelect2 = initSelect2;

$(document).ready(function(){
    initSelect2();
});