import * as faceapi from 'face-api.js';

const video = document.getElementById('video');
let canvas;
let lastMatchTime = 0;
const MATCH_COOLDOWN = 5000;

let employeeName;
let faceMatcher;
let isProcessing = false;

// 🔹 Fetch employee descriptor from server
$.ajax({
  url: '/employee-data',
  method: 'GET',
  success: function (response) {
    employeeName = response.employee;

    const labeledDescriptor = new faceapi.LabeledFaceDescriptors(employeeName, [new Float32Array(response.descriptor)]);

    faceMatcher = new faceapi.FaceMatcher(labeledDescriptor, 0.4);
  },
  error: function (err) {
    console.error(err);
  }
});

function fetchAttendance() {
  $.ajax({
    url: '/attendance/todays-date',
    method: 'GET',
    success: function (response) {
      const todaysData = response.TodayData || [];
      console.log(todaysData);
      // IDs of your DOM elements
      const ids = ['first', 'second', 'third', 'fourth'];

      ids.forEach((id, index) => {
        const timeUtc = todaysData[index]?.time;

        const timeManila = timeUtc ? timeUtc : '--:--';

        $('#' + id).text(timeManila.replace(/ AM| PM/, ''));
      });
    },
    error: function (err) {
      console.log(err);
    }
  });
}

fetchAttendance();
setInterval(fetchAttendance, 5000);

// 🔹 Load models then start camera
Promise.all([
  faceapi.nets.tinyFaceDetector.loadFromUri('/models'),
  faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
  faceapi.nets.faceRecognitionNet.loadFromUri('/models')
]).then(startVideo);

function startVideo() {
  navigator.mediaDevices
    .getUserMedia({ video: {} })
    .then(stream => {
      video.srcObject = stream;

      video.addEventListener('play', () => {
        const container = video.parentElement;
        container.style.position = 'relative';

        // OPTIONAL: Keep canvas but no drawing
        canvas = faceapi.createCanvasFromMedia(video);
        canvas.style.position = 'absolute';
        canvas.style.top = '0';
        canvas.style.left = '0';
        canvas.style.zIndex = '1000';
        canvas.style.pointerEvents = 'none';
        container.appendChild(canvas);

        const displaySize = {
          width: video.clientWidth,
          height: video.clientHeight
        };

        faceapi.matchDimensions(canvas, displaySize);

        setInterval(detectFace, 300);
      });
    })
    .catch(err => console.error(err));
}

// 🔹 Detect + Match face (NO DRAWING)
async function detectFace() {
  if (!canvas || !faceMatcher || isProcessing) return;

  isProcessing = true;

  const displaySize = {
    width: video.clientWidth,
    height: video.clientHeight
  };

  faceapi.matchDimensions(canvas, displaySize);

  const detection = await faceapi
    .detectSingleFace(video, new faceapi.TinyFaceDetectorOptions())
    .withFaceLandmarks()
    .withFaceDescriptor();

  // Clear canvas (no drawings anyway)
  const ctx = canvas.getContext('2d');
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  if (!detection) {
    $('#status').text('No face detected');
    isProcessing = false;
    return;
  }

  // 🔹 Match face (NO BOX / LABEL)
  const bestMatch = faceMatcher.findBestMatch(detection.descriptor);

  if (bestMatch.label === employeeName) {
    const now = Date.now();

    if (now - lastMatchTime < MATCH_COOLDOWN) {
      isProcessing = false;
      $('#status').text('Loading...');
      return;
    }

    lastMatchTime = now;
    $('#status').text(`Matched: ${employeeName}`);
    $.ajax({
      url: '/attendance/check',
      method: 'GET',
      cache: false,
      success: function (data) {
        Toastify({
          text: data.Message,
          duration: 3000,
          close: true,
          gravity: 'top',
          position: 'right',
          backgroundColor: data.Error == 0 ? '#008000' : '#cc3300',
          stopOnFocus: true
        }).showToast();
      },
      error: function () {
        Toastify({
          text: 'Unable to save data. Please try again later.',
          duration: 3000,
          close: true,
          gravity: 'top',
          position: 'right',
          backgroundColor: '#dc3545',
          stopOnFocus: true
        }).showToast();
      }
    });
  } else {
    $('#status').text('Not Matched'); // ✅ fixed typo
  }

  isProcessing = false;
}

// running time
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
