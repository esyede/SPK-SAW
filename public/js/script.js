function deleteData(id) {
    Swal.fire({
        title: 'Hapus data ini?',
        text: 'Anda tidak akan dapat mengembalikan ini!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (! result.value) {
            return;
        }

        document.getElementById('delete-form-' + id).submit();
    })
}

function resetForm(formId) {
    document.getElementById(formId).reset();
}

$(document).ready(function() {
    // Dropify
    $('.dropify').dropify();

    // Select2
    $('.select').each(function () {
        $(this).select2();
    });
});

