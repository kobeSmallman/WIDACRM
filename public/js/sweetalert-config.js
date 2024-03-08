import Swal from 'sweetalert2';

Swal.mixin({
  buttonsStyling: false,
  customClass: {
    confirmButton: 'btn btn-primary',
    cancelButton: 'btn btn-default'
  },
});
