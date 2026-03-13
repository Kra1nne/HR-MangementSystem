// delete
$(function () {
  $('body').on('click', '#applicantDelete', function () {
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

// modal manipulation
$(function () {
  $('body').on('click', '.modalButtonAdd', function () {
    var titleData = $(this).data('title');
    $('#modalCenterTitle').text(titleData);
  });

  $('body').on('click', '.modalButtonEdit', function () {
    var titleData = $(this).data('title');
    $('#modalCenterTitle').text(titleData);
  });
});

//tabs
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

// add Job
$(function () {
  $('body').on('click', '#btnSave', function () {
    $.ajax({
      method: 'POST',
      url: '/recruitment/addJob',
      cache: false,
      data: $('#dataJob').serialize(),
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
  });
});

// add Candidate
$(function () {
  $('body').on('click', '#btnSaveCandidate', function () {
    $.ajax({
      method: 'POST',
      url: '/recruitment/addCandidate',
      cache: false,
      data: $('#dataCandidate').serialize(),
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
  });
});
