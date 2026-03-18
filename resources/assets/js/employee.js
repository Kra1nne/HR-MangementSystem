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
    }
  });
});
