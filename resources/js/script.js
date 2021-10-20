$(document).ready(function() {
    let myDatatable = $('#datatable');
    let myDropify = $('.dropify');
    let mySelect2 = $('.select');
    let mySelectAll = $('#select-all');
    let myDeleteBtn = $('#delete-btn');
    let myResetBtn = $('#reset-btn');

    if (myDatatable.length) {
        myDatatable.DataTable();
    }

    if (myDropify.length) {
        myDropify.dropify();
    }

    if (mySelect2.length) {
        mySelect2.each(function () {
            $(this).select2();
        });
    }

    if (mySelectAll.length) {
        mySelectAll.click(function (event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function () {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function () {
                    this.checked = false;
                });
            }
        });
    }

    if (myDeleteBtn.length) {
        myDeleteBtn.click(function (e) {
            $.ajax({
                url: this.data('action'),
                type: 'DELETE',
                dataType: 'json',
                headers; { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { id: this.data('id'), '_token': '{{ csrf_token() }}' },
                success: function (data) {

                },
                error: function (data) {
                    // body...
                }
            });
        });
    }
});

