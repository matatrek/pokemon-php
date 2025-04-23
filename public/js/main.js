$(document).ready(() => {

    const debouncedLog = debounce(getData, 500);

    getTypes();
    getData();

    $('#filter-attack').on('change', getData);
    $('#filter-defense').on('change', getData);
    $('#filter-speed').on('change', getData);
    $('#filter-search').on('input', debouncedLog);
    $(document).on('change', 'input[name="filter-type[]"]', getData);

});


const getData = () => {

    let type    = [];
    let attack  = $('#filter-attack').val();
    let defense = $('#filter-defense').val();
    let speed   = $('#filter-speed').val();
    let search  = $('#filter-search').val().trim();
    $('input[name="filter-type[]"]').each(function() {
        if ($(this).is(':checked')) {
            type.push($(this).val())
        }
    });

    const filters = {
        attack,
        defense,
        speed,
        search,
        type: JSON.stringify(type)
    };

    ajax('POST', 'http://pokemon-php.test/list', filters, (response) => {
        $('#list-pokemon').html(response);
    });
}
const getTypes = () => {
    ajax('POST', 'http://pokemon-php.test/types', {}, (response) => {
        $('#filter-type').html(response);
    });
}

const ajax = (type, url, data = {}, success = () => {}, error = () => {}) => {


    $.ajax({
        type,
        url,
        data,
        dataType: "html",
        success,
        error
    });
}

const debounce = (callback, delay) => {
    let timer;
    return function (...args) {
        clearTimeout(timer);
        timer = setTimeout(() => {
            callback.apply(this, args);
        }, delay);
    };
}