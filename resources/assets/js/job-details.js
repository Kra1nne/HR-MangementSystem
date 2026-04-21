$(function () {
  $(document).on('click', '#OpenJob', function () {
    const id = $(this).data('id');
    Swal.fire({
      title: 'Open Draft Application?',
      text: 'Do you want to open this draft job application?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, open it'
    }).then(result => {
      if (result.isConfirmed)
        $.ajax({
          type: 'POST',
          url: '/job_posting/open',
          cache: false,
          data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: id
          },
          dataType: 'json',
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
                location.reload();
              });
            }
          },
          error: function () {
            $('.preloader').hide();
            Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
          }
        });
    });
  });

  $(document).on('click', '#closeJob', function () {
    const id = $(this).data('id');

    Swal.fire({
      title: 'Close Application?',
      text: 'This action cannot be undone. Do you want to close this job application?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Yes, close it',
      cancelButtonText: 'Cancel'
    }).then(result => {
      if (result.isConfirmed)
        $.ajax({
          type: 'POST',
          url: '/job_posting/close',
          cache: false,
          data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: id
          },
          dataType: 'json',
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
                location.reload();
              });
            }
          },
          error: function () {
            $('.preloader').hide();
            Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
          }
        });
    });
  });

  $(document).on('click', '#deleteJob', function () {
    const id = $(this).data('id');
    Swal.fire({
      title: 'Delete Application?',
      text: 'This action cannot be undone. Do you want to delete this job application?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Yes, delete it',
      cancelButtonText: 'Cancel'
    }).then(result => {
      if (result.isConfirmed)
        $.ajax({
          type: 'POST',
          url: '/job_posting/delete',
          cache: false,
          data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: id
          },
          dataType: 'json',
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
          },
          error: function () {
            $('.preloader').hide();
            Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
          }
        });
    });
  });

  $(document).on('click', '#BtnSubmit', function () {
    $.ajax({
      type: 'POST',
      url: '/job_posting/update',
      cache: false,
      data: $('#jobPostingData').serialize(),
      dataType: 'json',
      beforeSend: function () {
        $('.preloader').show();
        $('#Modal').modal('hide');
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
            location.reload();
          });
        }
      },
      error: function () {
        $('.preloader').hide();
        Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
      }
    });
  });
});

$(function () {
  $(document).on('click', '#urlLinks', function () {
    const id = $(this).data('id');
    console.log('click');

    const link = `${window.location.origin}/job/${id}`;

    navigator.clipboard.writeText(link).then(() => {
      Swal.fire({
        icon: 'success',
        title: 'Copied!',
        text: 'Link copied to clipboard',
        timer: 500,
        showConfirmButton: false
      });
    });
  });
});
