function validateForm(fields) {
  let valid = true;

  $.each(fields, function (_, field) {
    const $input = $('#' + field.id);
    if (!$input.length) return;

    let error = '';
    const type = $input.attr('type');
    const tag = $input.prop('tagName');

    // 🔹 Validation rules
    if (type === 'checkbox') {
      if (!$input.is(':checked')) {
        error = field.label + ' must be checked.';
      }
    } else if (type === 'file') {
      if ($input[0].files.length === 0) {
        error = field.label + ' is required.';
      }
    } else if (tag === 'SELECT') {
      if (!$input.val()) {
        error = 'Please select ' + field.label + '.';
      }
    } else {
      if (!$input.val().trim()) {
        error = field.label + ' is required.';
      }
    }

    // 🔹 Show / Remove error
    let $feedback = $input.parent().find('.invalid-feedback');

    if (error) {
      valid = false;
      $input.addClass('is-invalid');

      if (!$feedback.length) {
        $feedback = $('<div class="invalid-feedback"></div>').appendTo($input.parent());
      }

      $feedback.html(error);
    } else {
      $input.removeClass('is-invalid');
      $feedback.remove();
    }
  });

  return valid;
}

$(function () {
  $('body').on('click', '#btnResetRegisterFace', function () {
    const id = $(this).data('id');
    Swal.fire({
      title: 'Reset Biometric Verification?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, reset it!'
    }).then(result => {
      if (result.isConfirmed)
        $.ajax({
          type: 'POST',
          url: '/employee/face-registration/reset',
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
});

$(function () {
  $('body').on('click', '#btnDetailsUpdate', function () {
    const fields = [
      { id: 'Employeesalary', label: 'Salary' },
      { id: 'Employeetitle', label: 'Title' }
    ];
    const isValid = validateForm(fields);

    if (!isValid) {
      return;
    }

    $.ajax({
      type: 'POST',
      url: '/employee/details-update',
      cache: false,
      data: $('#UpadteEmployeeDetails').serialize(),
      dataType: 'json',
      beforeSend: function () {
        $('#modalEdit').modal('hide');
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

$(function () {
  $(document).on('click', '#ExperienceBtn', function () {
    const id = $(this).data('id');
    $('#emp_no').val(id);
  });

  $('body').on('click', '#btnExperience', function () {
    const fields = [
      { id: 'company', label: 'Company' },
      { id: 'position', label: 'Position' },
      { id: 'salary', label: 'Salary' },
      { id: 'start', label: 'Start employment date' },
      { id: 'end', label: 'End employment date' },
      { id: 'description', label: 'Description' }
    ];
    const isValid = validateForm(fields);

    if (!isValid) {
      return;
    }

    $.ajax({
      type: 'POST',
      url: '/profile/experience/add',
      cache: false,
      data: $('#EmployeeExperienceData').serialize(),
      dataType: 'json',
      beforeSend: function () {
        $('#ModalAddExperience').modal('hide');
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
