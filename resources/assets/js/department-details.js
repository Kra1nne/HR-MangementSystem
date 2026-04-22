// error trappings for inputs
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
// delete ajax
$(function () {
  $('body').on('click', '#employeeDelete', function () {
    const id = $(this).data('id');
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
        $.ajax({
          method: 'POST',
          url: '/department/remove',
          cache: false,
          data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: id
          },
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
          error: function (data) {
            $('.preloader').hide();
            Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
          }
        });
      }
    });
  });
});
// add Employee Ajax
$(function () {
  $('body').on('click', '#btnAddEmployee', function () {
    $.ajax({
      method: 'POST',
      url: '/department/addEmployee',
      cache: false,
      data: $('#employeeFormData').serialize(),
      beforeSend: function () {
        $('#ModalAddEmployee').modal('hide');
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
  });
});
// for changing tabs
$(function () {
  var activeTab = localStorage.getItem('activeTab');

  if (activeTab) {
    $('.nav-link').removeClass('active');
    $('.tab-pane').removeClass('active show');

    var $tabElement = $('.nav-link[data-bs-target="' + activeTab + '"]');

    if ($tabElement.length) {
      $tabElement.addClass('active');
      $(activeTab).addClass('active show');
    }
  }

  $('.nav-link').on('shown.bs.tab', function (e) {
    localStorage.setItem('activeTab', $(e.target).data('bs-target'));
  });
});
// for selecting the employee in add manager modal
$(function () {
  let debounceTimer;

  $('#searchInputManager').on('input', function () {
    clearTimeout(debounceTimer);
    const query = $(this).val().toLowerCase().trim();

    debounceTimer = setTimeout(() => {
      let visibleCount = 0;

      $('.employee-row').each(function () {
        const name = $(this).find('label').data('name');
        const match = name.includes(query);

        $(this).toggle(match);
        if (match) visibleCount++;
      });

      $('#noResultsManager').toggleClass('d-none', visibleCount !== 0);
    }, 250);
  });
});

// for selecting the employee in adding the employee modal
$(function () {
  let debounceTimer;

  $('#searchInput').on('input', function () {
    clearTimeout(debounceTimer);
    const query = $(this).val().toLowerCase().trim();

    debounceTimer = setTimeout(() => {
      let visibleCount = 0;

      $('.employee-row').each(function () {
        const name = $(this).find('label').data('name');
        const match = name.includes(query);

        $(this).toggle(match);
        if (match) visibleCount++;
      });

      $('#noResults').toggleClass('d-none', visibleCount !== 0);
    }, 250);
  });

  $('#selectAll').on('change', function () {
    const isChecked = $(this).prop('checked');
    $('.employee-row:visible .employee-checkbox').prop('checked', isChecked).trigger('change');
    updateCount();
  });

  $(document).on('change', '.employee-checkbox', function () {
    $(this).is(':checked');
    updateCount();
  });

  function updateCount() {
    const total = $('.employee-checkbox:checked').length;
    $('#selectedCount').text(total + ' selected');

    const visible = $('.employee-row:visible .employee-checkbox').length;
    const checkedVisible = $('.employee-row:visible .employee-checkbox:checked').length;

    $('#selectAll').prop('checked', visible > 0 && visible === checkedVisible);
  }
});

// for message
$(function () {
  let action;
  $('body').on('click', '#MessageAll', function () {
    const department = $(this).data('department');
    $('#action').val('everyone');
    $('#idEmployee').val(0);
    $('#messageRecipents').val(department + ' Employees');
    action = 'everyone';
  });
  $('body').on('click', '#ModalPersonalMessage', function () {
    const id = $(this).data('id');
    const fullname = $(this).data('fullname');

    $('#action').val('personal');
    $('#idEmployee').val(id);
    $('#messageRecipents').val(fullname);
    action = 'personal';
  });

  $('body').on('click', '#btnSaveMessage', function () {
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
    if (action == 'personal') {
      $.ajax({
        url: '/message/sent',
        method: 'POST',
        data: $('#EmployeeMessageData').serialize(),
        cache: false,
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
        error: function () {
          $('.preloader').hide();
          Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
        }
      });
    } else {
      console.log('Ongoing');
    }
  });
});

// adding a manager in department

$(function () {
  $(document).on('click', '#btnAddManager', function () {
    $.ajax({
      url: '/department/manager/add',
      method: 'POST',
      cache: false,
      data: $('#ManagerFormData').serialize(),
      beforeSend: function () {
        $('#ModalAddManeger').modal('hide');
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

// update Department
$(function () {
  $('body').on('click', '#updateDepartment', function () {
    const id = $(this).data('id');
    const name = $(this).data('name');
    const details = $(this).data('details');
    const icon = $(this).data('icon');

    $('#departmentIcon').val(icon);
    $('#dept_no').val(id);
    $('#name').val(name);
    $('#details').val(details);

    $('body').on('click', '#btnSaveEdit', function () {
      $.ajax({
        url: '/department/edit',
        method: 'POST',
        cache: false,
        data: $('#dataDepartment').serialize(),
        beforeSend: function () {
          $('#ModalEdit').modal('hide');
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
  // delete Department
  $('body').on('click', '#deleteDepartment', function () {
    const id = $(this).data('id');
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
        $.ajax({
          method: 'POST',
          url: '/department/delete',
          cache: false,
          data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: id
          },
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
          error: function (data) {
            $('.preloader').hide();
            Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
          }
        });
      }
    });
  });
});
