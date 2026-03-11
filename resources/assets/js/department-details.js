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
