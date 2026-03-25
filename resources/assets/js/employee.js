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
  $('#selectAll').on('change', function () {
    const isChecked = $(this).is(':checked');
    $('.employee-row:visible .employee-checkbox').prop('checked', isChecked).trigger('change'); // ensure UI updates
    updateCount();
  });

  $(document).on('change', '.employee-checkbox', function () {
    const $isChecked = $(this).is(':checked');
    updateCount();
  });

  function updateCount() {
    const $visibleCheckboxes = $('.employee-row:visible .employee-checkbox');
    const $checkedVisible = $visibleCheckboxes.filter(':checked');

    const total = $('.employee-checkbox:checked').length;
    $('#selectedCount').text(total + ' selected');

    const selectAll = $('#selectAll')[0];

    if ($checkedVisible.length === 0) {
      selectAll.checked = false;
    } else if ($checkedVisible.length === $visibleCheckboxes.length) {
      selectAll.checked = true;
    }
  }
});

$(function () {
  $('body').on('click', '#employeeDelete', function () {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then(result => {
      if (result.isConfirmed) {
        Swal.fire({
          title: 'Deleted!',
          text: 'Your file has been deleted.',
          icon: 'success'
        });
      }
    });
  });
});

$(function () {
  function clearAllData() {
    $('#idNumber').val('');
    $('#firstname').val('');
    $('#middlename').val('');
    $('#lastname').val('');
    $('#address').val('');
    $('#phone').val('');
    $('#birth_date').val('');
    $('#sex').val('');
    $('#blood_type').val('');
    $('#emp_id').val('');
    $('#hire_date').val('');
    $('#salary').val('');
    $('#position').val('');
    $('#status').val('');
    $('#id_salary').val('');
    $('#id_title').val('');
  }

  $('body').on('click', '#ModalClickAdd', function () {
    clearAllData();
    $('#FormTitle').text('New Employee');
    $('#actionModal').val('Add');
  });
  $('body').on('click', '#ModalClickEdit', function () {
    clearAllData();
    const id = $(this).data('id');
    const salary_id = $(this).data('id-salary');
    const title = $(this).data('id-title');
    const firstname = $(this).data('firstname');
    const middlename = $(this).data('middlename');
    const lastname = $(this).data('lastname');
    const address = $(this).data('address');
    const phone = $(this).data('phone');
    const birthdate = $(this).data('birthdate');
    const sex = $(this).data('sex');
    const bloodType = $(this).data('blood_type');
    const empId = $(this).data('emp-id');
    const hireDate = $(this).data('hire-date');
    const salary = $(this).data('salary');
    const position = $(this).data('position');
    const status = $(this).data('status');

    $('#FormTitle').text('Edit Employee');
    $('#actionModal').val('Edit');
    $('#idNumber').val(id);
    $('#firstname').val(firstname);
    $('#middlename').val(middlename);
    $('#lastname').val(lastname);
    $('#address').val(address);
    $('#phone').val(phone);
    $('#birth_date').val(birthdate);
    $('#sex').val(sex);
    $('#blood_type').val(bloodType);
    $('#emp_id').val(empId);
    $('#hire_date').val(hireDate);
    $('#salary').val(salary);
    $('#position').val(position);
    $('#Workstatus').val(status);
    $('#id_salary').val(salary_id);
    $('#id_title').val(title);
  });
});
$(function () {
  $('body').on('click', '#btnSaveEmployee', function () {
    const fields = [
      { id: 'firstname', label: 'Firstname' },
      { id: 'middlename', label: 'Middlname' },
      { id: 'lastname', label: 'Lastname' },
      { id: 'address', label: 'Address' },
      { id: 'phone', label: 'Phone Number' },
      { id: 'birth_date', label: 'Birth Date' },
      { id: 'sex', label: 'Sex' },
      { id: 'blood_type', label: 'Blood Type' },
      { id: 'emp_id', label: 'Employee ID' },
      { id: 'hire_date', label: 'Hire Date' },
      { id: 'salary', label: 'Salary' },
      { id: 'position', label: 'Position' },
      { id: 'Workstatus', label: 'Work Status' }
    ];

    const isValid = validateForm(fields);

    if (!isValid) {
      event.preventDefault();
      return;
    }

    const action = $('#actionModal').val();
    if (action === 'Edit') {
      $.ajax({
        method: 'POST',
        url: '/employee/edit',
        cache: false,
        data: $('#dataEmployee').serialize(),
        beforeSend: function () {
          $('#Modal').modal('hide');
          $('.preloader').show();
        },
        success: function (data) {
          $('.preloader').hide();
          if (data.error == 1) {
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
    } else {
      $.ajax({
        method: 'POST',
        url: '/employee/add',
        cache: false,
        data: $('#dataEmployee').serialize(),
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
              location.reload();
            });
          }
        },
        error: function (data) {
          $('.preloader').hide();
          Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
        }
      });
    }
  });
});

$(function () {
  $(document).on('click', '#messageEmployee', function () {
    const id = $(this).data('id');
    const fullname = $(this).data('fullname');

    $('#idEmployee').val(id);
    $('#messageRecipents').val(fullname);
  });

  $('body').on('click', '#btnSaveMessage', function () {
    $.ajax({
      url: '/message/sent',
      method: 'POST',
      data: $('#EmployeeMessageContent').serialize(),
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
