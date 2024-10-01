import $ from 'jquery';
import Swal from 'sweetalert2';

$(document).ready(function() {

    $(document).on('click', '.delete' , function() {
        let element = $(this);

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            customClass: {
              confirmButton: 'btn btn-primary waves-effect waves-light',
              cancelButton: 'btn btn-danger waves-effect'
            },
            showClass: {
                popup: 'animate__animated animate__bounceIn'
            },
            buttonsStyling: true,
            confirmButtonText: "Yes, delete it!",
            showCancelButton: true,
          }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: element.data('url'),
                    type: 'DELETE',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (result) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'The record has been deleted!',
                            confirmButtonColor: '#3085d6',
                            customClass: {
                                confirmButton: 'btn btn-primary waves-effect waves-light',
                            },
                            timer: 3000
                        }).then(function() {
                            window.location.reload();
                        })
                    }
                })
            };
          })
    })
})