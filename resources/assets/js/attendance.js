$(document).ready(function () {
  var calendarEl = $('#calendar')[0]; // FullCalendar needs the DOM element
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    headerToolbar: {
      left: 'prev,next',
      center: 'title'
    }
  });

  calendar.render();
});

$(function () {
  function formatDate(date, includeDate = true) {
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const month = months[date.getMonth()];
    const day = String(date.getDate()).padStart(2, '0');
    const year = date.getFullYear();

    let hours = date.getHours();
    const minutes = String(date.getMinutes()).padStart(2, '0');
    const seconds = String(date.getSeconds()).padStart(2, '0');

    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    if (hours === 0) hours = 12; // handle midnight & noon
    hours = String(hours).padStart(2, '0');

    if (includeDate) {
      return `${month} ${day}, ${year} ${hours}:${minutes}:${seconds} ${ampm}`;
    } else {
      return `${hours}:${minutes}:${seconds} ${ampm}`;
    }
  }

  // Update both elements
  function updateTime() {
    const now = new Date();
    $('#liveTime').text(formatDate(now));
  }

  // Run immediately and then every second
  updateTime();
  setInterval(updateTime, 1000);
});
