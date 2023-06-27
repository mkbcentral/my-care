import toastr from 'toastr';
window.$(document).ready(function () {
    toastr.options = {
    "positionClass": "toast-bottom-right",
    "progressBar": true
    };
    window.addEventListener('added', function (event) {
        toastr.success(event.detail.message, 'Validation');

    });
    window.addEventListener('updated', function (event) {
        toastr.info(event.detail.message, 'Validation');

    });
    window.addEventListener('deleted', function (event) {
        toastr.error(event.detail.message, 'Alert !');
        $('#formEditInscriptionModal').modal('hide');
    });


});

