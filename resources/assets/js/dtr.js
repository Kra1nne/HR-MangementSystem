$(function () {
  $(document).on('click', '#PeviewDTR', function () {
    const id = $(this).data('id');

    $('#idEmployee').val(id);
  });
});
