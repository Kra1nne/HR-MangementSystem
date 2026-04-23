/**
 * Dashboard Analytics
 */
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
    $('#runningTime').text(formatDate(now, false));
  }

  // Run immediately and then every second
  updateTime();
  setInterval(updateTime, 1000);
});

('use strict');

$(document).ready(function () {
  const dates = applicantsData.map(function (item) {
    return item.applied_at;
  });

  const totals = applicantsData.map(function (item) {
    return parseInt(item.total);
  });

  const options = {
    series: [
      {
        name: 'Applicants',
        data: totals
      }
    ],
    chart: {
      type: 'line',
      height: 380,
      toolbar: {
        show: true,
        tools: {
          download: true,
          zoom: true,
          zoomin: true,
          zoomout: true,
          pan: true,
          reset: true
        }
      },
      zoom: {
        enabled: true
      },
      animations: {
        enabled: true,
        easing: 'easeinout',
        speed: 600
      }
    },
    stroke: {
      curve: 'smooth',
      width: 3
    },
    markers: {
      size: 5,
      hover: {
        size: 7
      }
    },
    xaxis: {
      categories: dates,
      labels: {
        rotate: -45,
        rotateAlways: false,
        hideOverlappingLabels: true,
        style: {
          fontSize: '12px'
        }
      },
      title: {
        text: 'Date Applied',
        style: {
          fontSize: '13px',
          fontWeight: 500
        }
      }
    },
    yaxis: {
      title: {
        text: 'Number of Applicants',
        style: {
          fontSize: '13px',
          fontWeight: 500
        }
      },
      min: 0,
      forceNiceScale: true,
      labels: {
        formatter: function (val) {
          return Math.floor(val);
        }
      }
    },
    tooltip: {
      x: {
        formatter: function (val, opts) {
          return 'Date: ' + opts.w.globals.categoryLabels[opts.dataPointIndex];
        }
      },
      y: {
        formatter: function (val) {
          return val + ' applicant(s)';
        }
      }
    },
    grid: {
      borderColor: '#e9ecef',
      strokeDashArray: 4
    },
    colors: ['#0d6efd'],
    dataLabels: {
      enabled: false
    },
    responsive: [
      {
        breakpoint: 576,
        options: {
          chart: {
            height: 280
          },
          xaxis: {
            labels: {
              rotate: -60
            }
          }
        }
      }
    ]
  };

  const chart = new ApexCharts(document.querySelector('#applicants-chart'), options);
  chart.render();
});

$(document).ready(function () {
  const STATUS_CONFIG = {
    apply: { label: 'Applied', color: '#0d6efd', countEl: '#count-applied' },
    shortlist: { label: 'Shortlisted', color: '#ffc107', countEl: '#count-shortlisted' },
    accepted: { label: 'Accepted', color: '#198754', countEl: '#count-accepted' },
    rejected: { label: 'Rejected', color: '#dc3545', countEl: '#count-rejected' }
  };

  const ORDER = ['apply', 'shortlist', 'accepted', 'rejected'];

  // Build a keyed map from the Laravel data
  const dataMap = {};
  $.each(statusData, function (_, item) {
    dataMap[item.status] = parseInt(item.total);
  });

  // Populate stat cards
  $.each(ORDER, function (_, key) {
    const count = dataMap[key] || 0;
    $(STATUS_CONFIG[key].countEl).text(count);
  });

  const series = ORDER.map(function (key) {
    return dataMap[key] || 0;
  });
  const labels = ORDER.map(function (key) {
    return STATUS_CONFIG[key].label;
  });
  const colors = ORDER.map(function (key) {
    return STATUS_CONFIG[key].color;
  });
  const total = series.reduce(function (a, b) {
    return a + b;
  }, 0);

  const options = {
    series: series,
    labels: labels,
    colors: colors,
    chart: {
      type: 'donut',
      height: 380,
      animations: {
        enabled: true,
        easing: 'easeinout',
        speed: 700
      }
    },
    plotOptions: {
      pie: {
        donut: {
          size: '68%',
          labels: {
            show: true,
            name: {
              show: true,
              fontSize: '15px',
              fontWeight: 600,
              offsetY: -6
            },
            value: {
              show: true,
              fontSize: '28px',
              fontWeight: 700,
              offsetY: 6,
              formatter: function (val) {
                return val;
              }
            },
            total: {
              show: true,
              label: 'Total',
              fontSize: '14px',
              fontWeight: 500,
              color: '#6c757d',
              formatter: function () {
                return total;
              }
            }
          }
        }
      }
    },
    dataLabels: {
      enabled: true,
      formatter: function (val) {
        return val.toFixed(1) + '%';
      },
      dropShadow: { enabled: false }
    },
    legend: {
      position: 'bottom',
      horizontalAlign: 'center',
      fontSize: '13px',
      markers: { width: 10, height: 10, radius: 2 },
      itemMargin: { horizontal: 12, vertical: 6 }
    },
    tooltip: {
      y: {
        formatter: function (val) {
          const pct = total > 0 ? ((val / total) * 100).toFixed(1) : 0;
          return val + ' applicant(s) (' + pct + '%)';
        }
      }
    },
    stroke: {
      width: 2
    },
    responsive: [
      {
        breakpoint: 576,
        options: {
          chart: { height: 320 },
          legend: { position: 'bottom' }
        }
      }
    ]
  };

  const chart = new ApexCharts(document.querySelector('#status-chart'), options);
  chart.render();
});
