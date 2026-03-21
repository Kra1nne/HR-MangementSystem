$(function () {
  const duration = 60; // seconds

  if (!localStorage.getItem('endTime')) {
    $('#resendOtp').removeClass('disabled-link opacity-25');
    const endTime = Date.now() + duration * 1000;
    localStorage.setItem('endTime', endTime);
  }

  function updateTimer() {
    const endTime = parseInt(localStorage.getItem('endTime'));
    const now = Date.now();
    let timeLeft = Math.floor((endTime - now) / 1000);

    if (timeLeft <= 0) {
      $('#resendOtp').removeClass('disabled-link opacity-25');
      timeLeft = 0;
    }

    $('#timer').text(timeLeft);
  }

  // Run immediately + every second
  updateTimer();
  setInterval(updateTimer, 1000);

  // Optional: reset timer when clicking resend
  $('#resendOtp').click(function (e) {
    if ($(this).hasClass('disabled-link')) {
      e.preventDefault();
      return;
    }

    const newEndTime = Date.now() + duration * 1000;
    localStorage.setItem('endTime', newEndTime);
    updateTimer();
  });
});
