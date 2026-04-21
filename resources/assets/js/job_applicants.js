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
    let logs = $(this).data('logs');
    console.log(logs);
    let container = $('#documentsContainer');
    let timelineRecords = $('#timelineRecords');
    $('#applicantsTime').text(time);

    container.html('');
    timelineRecords.html('');

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

    logs.forEach(function (log) {
      const remarksBadge = log.remarks
        ? `<span class="${log.remarks == 'pass' ? 'badge bg-success' : 'badge bg-danger'}">${log.remarks.toLowerCase().replace(/^./, c => c.toUpperCase())}</span>`
        : '';

      timelineRecords.append(`
        <li class="timeline-item timeline-item-transparent mb-4">
          <span class="timeline-point timeline-point-success"></span>
          <div class="timeline-event">
              <div>
                  <div class="timeline-header mb-3">
                      <h6 class="mb-0 fw-bold text-dark">
                          <i class="bi bi-person-check-fill me-1"></i> ${log.event_type}

                      </h6>
                  </div>
                  <p class="mb-2">Applicant assessment record</p>
                  <p class="text-muted mb-2 small">
                    <i class="ri ri-calendar-line me-1"></i>
                    ${new Date(log.scheduled_at).toLocaleDateString(undefined, {
                      year: 'numeric',
                      month: 'short',
                      day: 'numeric'
                    })} • 
                    ${new Date(log.scheduled_at).toLocaleTimeString(undefined, {
                      hour: '2-digit',
                      minute: '2-digit'
                    })}
                  </p>
                  <div class="d-flex gap-2">
                      <span class="badge bg-light text-dark border">
                          Score: <strong>${log.score ?? 0}</strong>
                      </span>
                      <span class="badge bg-primary-subtle text-primary border">
                        ${(log.status ?? 'Ongoing').toLowerCase().replace(/^./, c => c.toUpperCase())}
                      </span>
                      ${remarksBadge}
                  </div>

              </div>
          </div>
        </li>
      `);
    });
  });
});

$(function () {
  $(document).on('click', '#AcceptBtn', function () {
    const id = $(this).data('id');
    const firstname = $(this).data('firstname');
    const lastname = $(this).data('lastname');
    const position = $(this).data('position');
    const email = $(this).data('email');

    Swal.fire({
      title: 'Accept Applicant?',
      text: 'This action cannot be undone. Do you want to accept this applicant?',
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, accept it'
    }).then(result => {
      if (result.isConfirmed)
        $.ajax({
          type: 'POST',
          url: '/job_posting/applicants/accept',
          cache: false,
          data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: id,
            firstname: firstname,
            lastname: lastname,
            position: position,
            email: email
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
  $(document).on('click', '#RejectBtn', function () {
    const id = $(this).data('id');
    const firstname = $(this).data('firstname');
    const lastname = $(this).data('lastname');
    const position = $(this).data('position');
    const email = $(this).data('email');

    Swal.fire({
      title: 'Reject Applicant?',
      text: 'This action cannot be undone. Do you want to reject this applicant?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Yes, reject it',
      cancelButtonText: 'Cancel'
    }).then(result => {
      if (result.isConfirmed)
        $.ajax({
          type: 'POST',
          url: '/job_posting/applicants/reject',
          cache: false,
          data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: id,
            firstname: firstname,
            lastname: lastname,
            position: position,
            email: email
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
  $(document).on('click', '#ShortlistBtn', function () {
    const id = $(this).data('id');
    Swal.fire({
      title: 'Shortlist Applicant?',
      text: 'This action cannot be undone. Do you want to shortlist this applicant?',
      icon: 'info',
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, accept it'
    }).then(result => {
      if (result.isConfirmed)
        $.ajax({
          type: 'POST',
          url: '/job_posting/applicants/shortlist',
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
  $('body').on('click', '.feedbackApplicant', function () {
    const id = $(this).data('id');
    const firstname = $(this).data('firstname');
    const lastname = $(this).data('lastname');
    const fullname = lastname + ' ' + lastname;

    $('#applicant_id').val(id);
    $('#applicantname').val(fullname);
  });

  $('body').on('click', '#btnFeedbackApplicant', function () {
    const fields = [
      { id: 'applicantname', label: 'Applicant Name' },
      { id: 'score', label: 'Applicant score' },
      { id: 'remarks', label: 'Applicant remarks' },
      { id: 'comment', label: 'Applicant comment' }
    ];

    const isValid = validateForm(fields);

    if (!isValid) {
      event.preventDefault();
      return;
    }

    $.ajax({
      url: '/job_posting/applicants/feedback',
      method: 'POST',
      data: $('#EmployeeFeedback').serialize(),
      cache: false,
      beforeSend: function () {
        $('#Feedback').modal('hide');
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
  $('body').on('click', '#assessmentApplicantBtn', function () {
    const fields = [
      { id: 'assessmentType', label: 'Assessment Type' },
      { id: 'schedule', label: 'Assessment Schedule' },
      { id: 'platform', label: 'Assessment Platform' },
      { id: 'instruction', label: 'Assessment Instructions' }
    ];

    const isValid = validateForm(fields);

    if (!isValid) {
      event.preventDefault();
      return;
    }

    $.ajax({
      url: '/job_posting/applicants/assessment',
      method: 'POST',
      data: $('#assessmentData').serialize(),
      cache: false,
      beforeSend: function () {
        $('#AssessmentModal').modal('hide');
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
  $('body').on('click', '.mailApplicant', function () {
    const email = $(this).data('email');

    $('#messageRecipents').val(email);
  });

  $(document).on('click', '#btnMailApplicant', function () {
    const fields = [
      { id: 'messageRecipents', label: 'Recipents' },
      { id: 'messageTitle', label: 'Title' },
      { id: 'messageContent', label: 'Message Content' }
    ];

    const isValid = validateForm(fields);

    if (!isValid) {
      event.preventDefault();
      return;
    }

    $.ajax({
      url: '/message/applicant/sent',
      method: 'POST',
      data: $('#ApplicantMessageContent').serialize(),
      cache: false,
      beforeSend: function () {
        $('#ModalMessage').modal('hide');
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
