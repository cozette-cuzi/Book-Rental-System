require('./bootstrap');
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip(
        { container: 'body', trigger: 'hover', placement: "bottom" }
    );
});
