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

    $('.employee-row:visible .employee-checkbox').prop('checked', isChecked);
    updateCount();
  });

  $(document).on('change', '.employee-checkbox', function () {
    const $label = $(this).closest('label');

    $label.toggleClass('bg-opacity-10', $(this).is(':checked'));

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
