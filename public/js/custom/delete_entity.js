$('body').on('click', '.a-delete-entity', function() {
    event.preventDefault();
    swal({
        title: "Êtes-vous sûr de vouloir faire ça?",
        icon: "warning",
        buttons: ["Annuler", true],
        dangerMode: true,
    }).then((value) => {
        if (value) {
            document.getElementById('destroy-form-' + $(this).data('entityname') + '-' + $(this).data('entityid')).submit();
            return;
        }
    });
});