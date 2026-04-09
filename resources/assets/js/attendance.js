$(function () {
  // ── Helpers ─────────────────────────────────────────

  const toDateStr = raw => raw.split('T')[0];

  const parseTime = (date, time) =>
    time
      ? new Date(
          time.includes('T') || (time.includes('-') && time.length > 10) ? time.replace(' ', 'T') : `${date}T${time}`
        )
      : null;

  const fmt = (d, t) => {
    const x = parseTime(d, t);
    return x && !isNaN(x) ? x.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true }) : '—';
  };

  const minutesBetween = (d, a, b) => {
    const x = parseTime(d, a),
      y = parseTime(d, b);
    return x && y && !isNaN(x) && !isNaN(y) ? Math.round((y - x) / 60000) : 0;
  };

  const fmtHours = m => `${Math.floor(m / 60)}h ${m % 60}m`;

  const groupByDate = logs =>
    logs.reduce((acc, l) => {
      const key = toDateStr(l.date);
      (acc[key] ??= []).push(l);
      return acc;
    }, {});

  // ── Shift Builder ───────────────────────────────────

  function buildShifts(logs, date) {
    const names = ['Morning', 'Afternoon', 'Evening'];
    let shifts = [],
      open = null;

    logs.forEach(log => {
      if (log.row === 1) {
        if (open) shifts.push(open);
        open = {
          label: names[shifts.length] ?? `Shift ${shifts.length + 1}`,
          in: log,
          out: null,
          mins: null,
          date
        };
      } else if (log.row === 2 && open) {
        open.out = log;
        open.mins = minutesBetween(date, open.in.time, log.time);
        shifts.push(open);
        open = null;
      }
    });

    if (open) shifts.push(open);
    return shifts;
  }

  // ── Modal ───────────────────────────────────────────

  function openModal(date, logs) {
    let total = 0;

    const rows = buildShifts(logs, date)
      .map(s => {
        if (s.mins) total += s.mins;

        return `
      <div class="d-flex justify-content-between align-items-center py-2 border-bottom small">
        <div>
          <div class="text-muted small mb-1">${s.label}</div>
          <div class="d-flex align-items-center gap-2">
            <span class="badge rounded-pill bg-success-subtle text-success">
              IN&nbsp;${fmt(date, s.in.time)}
            </span>
            ${
              s.out
                ? `<span class="text-muted small">→</span>
                   <span class="badge rounded-pill bg-warning-subtle text-warning">
                     OUT&nbsp;${fmt(date, s.out.time)}
                   </span>`
                : ''
            }
          </div>
        </div>
        <div class="fw-medium">${s.mins ? fmtHours(s.mins) : ''}</div>
      </div>`;
      })
      .join('');

    $('#att-modal').modal('show');
    $('#att-modal-date').text(
      new Date(date).toLocaleDateString([], {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      })
    );
    $('#att-modal-logs').html(rows);
    $('#att-modal-hours').text(total ? fmtHours(total) : '—');
  }

  // ── Fetch + Calendar ────────────────────────────────

  var path = window.location.pathname;
  var segments = path.split('/');
  var id = segments[segments.length - 1];

  $.get('/attendance/data')
    .done(logs => {
      const events = Object.entries(groupByDate(logs)).map(([date, logs]) => ({
        id: date,
        title: ' ',
        date,
        backgroundColor: '#07aa5e',
        display: 'background',
        extendedProps: { logs }
      }));

      new FullCalendar.Calendar($('#calendar')[0], {
        initialView: 'dayGridMonth',
        headerToolbar: { left: 'prev,next', center: 'title', right: '' },
        dayMaxEventRows: 1,
        selectable: true,
        events,
        dateClick: function (info) {
          const clickedDate = info.dateStr;
          const existingEvent = events.find(e => e.id === clickedDate);

          if (existingEvent) {
            openModal(existingEvent.id, existingEvent.extendedProps.logs);
          } else {
            $('#att-modal').modal('show');
            $('#att-modal-date').text(
              new Date(clickedDate).toLocaleDateString([], {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
              })
            );
            $('#att-modal-logs').html(`
              <div class="text-center text-muted py-4 small">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" class="mb-2 opacity-50">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5
                          A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5
                          A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5
                          A2.25 2.25 0 0 1 21 11.25v7.5"/>
                </svg>
                <div>No attendance records for this day.</div>
              </div>
            `);
            $('#att-modal-hours').text('—');
          }
        }
      }).render();
    })
    .fail(() => console.error('Failed to fetch attendance data.'));
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
    if (hours === 0) hours = 12;
    hours = String(hours).padStart(2, '0');

    if (includeDate) {
      return `${month} ${day}, ${year} ${hours}:${minutes}:${seconds} ${ampm}`;
    } else {
      return `${hours}:${minutes}:${seconds} ${ampm}`;
    }
  }

  function updateTime() {
    const now = new Date();
    $('#liveTime').text(formatDate(now));
  }

  updateTime();
  setInterval(updateTime, 1000);
});
