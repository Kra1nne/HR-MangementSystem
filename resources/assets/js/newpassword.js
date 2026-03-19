$(function () {
  //new-password-process

  $('body').on('click', '#NewPasswordBtn', function () {
    $.ajax({
      method: 'POST',
      url: '/new-password/process',
      data: $('#formAuthentication').serialize(),
      cache: false,
      beforeSend: function () {
        $('.preloader').show();
      },
      success: function (data) {
        $('.preloader').hide();
        if (data.Error == 1) {
          Swal.fire('Error!', data.Message, 'error');
        } else if (data.Error == 0) {
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Saved!',
            text: data.Message,
            showConfirmButton: true,
            confirmButtonText: 'OK'
          }).then(result => {
            window.location.href = data.Redirect;
          });
        }
      }
    });
  });
});
