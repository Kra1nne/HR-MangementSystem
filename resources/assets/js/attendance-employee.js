$(function () {
  // ── Helpers ─────────────────────────────────────────

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

  const groupByDate = logs => logs.reduce((acc, l) => ((acc[l.date] ??= []).push(l), acc), {});

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
  // "/attendance/employee-dtr/123"

  var segments = path.split('/');
  var id = segments[segments.length - 1];

  $.get(`/attendance/employee/${id}`)
    .done(logs => {
      const events = Object.entries(groupByDate(logs)).map(([date, logs]) => ({
        id: date,
        title: 'Present',
        date,
        extendedProps: { logs }
      }));

      new FullCalendar.Calendar($('#calendar')[0], {
        initialView: 'dayGridMonth',
        headerToolbar: { left: 'prev,next', center: 'title', right: '' },
        dayMaxEventRows: 1,
        events,
        eventContent: () => ({
          html: `
          <div class="d-flex align-items-center gap-1 px-2 py-1 rounded small fw-medium bg-success-subtle text-success">
            <svg viewBox="0 0 12 12" width="10" height="10">
              <path d="M2 6l3 3 5-5" stroke="#27500A" stroke-width="1.8"
                    stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>`
        }),

        eventClick: ({ event }) => openModal(event.startStr, event.extendedProps.logs)
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
