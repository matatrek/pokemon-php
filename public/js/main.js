$(document).ready(() => {
    getTypes();
    getData();
});


const getData = () => {
    ajax('POST', 'http://pokemon-php.test/list', {}, (response) => {
        $('#list-pokemon').html(response);
    });
}
const getTypes = () => {
    ajax('POST', 'http://pokemon-php.test/types', {}, (response) => {
        $('#filter-type').html(response);
    });
}

const ajax =(type, url, data = {}, success = () => {}, error = () => {}) => {
    $.ajax({
        type,
        url,
        data,
        dataType: "html",
        success,
        error
    });
}
