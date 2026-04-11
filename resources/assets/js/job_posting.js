// error trapping
function validateForm(fields) {
  let valid = true;

  // Loop through all fields to check if any are empty
  fields.forEach(field => {
    const input = document.getElementById(field.id);
    const value = input.value.trim();
    const errorMessages = [];

    // Check for empty fields
    if (!value) {
      valid = false;
      errorMessages.push(`${field.label} is required.`);
    }

    if (field.id === 'password-confirmation' && value) {
      const password = document.getElementById('password').value.trim();
      if (value !== password) {
        valid = false;
        errorMessages.push('Passwords do not match.');
      }
    }

    if (errorMessages.length > 0) {
      input.classList.add('is-invalid'); // Add Bootstrap 'is-invalid' class
      let errorMessageContainer = input.parentNode.querySelector('.invalid-feedback');
      if (!errorMessageContainer) {
        errorMessageContainer = document.createElement('div');
        errorMessageContainer.classList.add('invalid-feedback');
        input.parentNode.appendChild(errorMessageContainer);
      }
      errorMessageContainer.innerHTML = errorMessages.join('<br>'); // Display all errors for this field
    } else {
      input.classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
      let errorMessageContainer = input.parentNode.querySelector('.invalid-feedback');
      if (errorMessageContainer) {
        errorMessageContainer.remove(); // Remove error messages
      }
    }
  });

  return valid;
}

$(function () {
  $(document).on('click', '#BtnSubmit', function () {
    const fields = [
      { id: 'jobTitle', label: 'Job Title' },
      { id: 'jobPosition', label: 'Job Position' },
      { id: 'jobLocation', label: 'Job Location' },
      { id: 'activeDate', label: 'Active Date' },
      { id: 'jobType', label: 'Job Type' },
      { id: 'workArrangement', label: 'Work Arrangement' },
      { id: 'department', label: 'Department' },
      { id: 'Jobsalary', label: 'Job Salary' },
      { id: 'jobDescription', label: 'Job Description' },
      { id: 'jobRequirements', label: 'Job Requirements' },
      { id: 'jobObjective', label: 'Job Objective' }
    ];
    const isValid = validateForm(fields);

    if (!isValid) {
      return;
    }

    $.ajax({
      url: '/job_posting/add',
      method: 'POST',
      cache: false,
      data: $('#jobPostingData').serialize(),
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
      error: function (data) {
        $('.preloader').hide();
        Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
      }
    });
  });
});
