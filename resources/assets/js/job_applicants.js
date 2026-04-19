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
  $(document).on('click', '#submitBtn', function () {
    const fields = [
      { id: 'first_name', label: 'First Name' },
      { id: 'last_name', label: 'Last Name' },
      { id: 'dob', label: 'Date of Birth' },
      { id: 'sex', label: 'Sex' },
      { id: 'blood_type', label: 'Blood Type' },
      { id: 'email', label: 'Email' },
      { id: 'phone', label: 'Phone' },
      { id: 'address', label: 'Address' },
      { id: 'resume', label: 'Resume' },
      { id: 'consentCheck', label: 'Consent' }
    ];
    const isValid = validateForm(fields);

    if (!isValid) {
      return;
    }
    var formData = new FormData($('#applicationForm')[0]);
    $.ajax({
      url: '/job/form/add',
      method: 'POST',
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
      dataType: 'json',
      beforeSend: function () {
        $('#Modal').modal('hide');
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
            if (result.isConfirmed) {
              location.reload();
            }
          });
        }
      },
      error: function (data) {
        $('.preloader').hide();
        Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
      }
    });
  });
});

$(function () {
  $(document).on('click', '.view-applicant', function () {
    let documents = $(this).data('documents');
    let time = $(this).data('time');
    let container = $('#documentsContainer');
    $('#applicantsTime').text(time);

    container.html(''); // clear previous

    if (documents.length === 0) {
      container.append('<p>No documents found</p>');
      return;
    }

    documents.forEach(function (doc) {
      let fileUrl = `/storage/${doc.file_path}`;

      container.append(`
        <a href="${fileUrl}" download 
           class="text-decoration-none me-2 gap-2 d-inline-block">
          <div class="badge bg-lighter rounded d-flex align-items-center"
               style="cursor:pointer;">
              <img src="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo/assets/img/icons/misc/pdf.png"
                   alt="img" width="20" class="me-2" />  
              <span class="h6 mb-0 text-body">${doc.type ?? 'Document'}</span>
          </div>

        </a>
      `);
    });
  });
});
