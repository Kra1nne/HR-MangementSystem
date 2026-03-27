import * as faceapi from 'face-api.js';

const video = document.getElementById('video');
let canvas;

let employeeName;
let faceMatcher;
let isProcessing = false;

// 🔹 Fetch employee descriptor from server
$.ajax({
  url: '/employee-data',
  method: 'GET',
  success: function (response) {
    employeeName = response.employee;

    // Convert descriptor to Float32Array
    const labeledDescriptor = new faceapi.LabeledFaceDescriptors(employeeName, [new Float32Array(response.descriptor)]);

    // Create matcher
    faceMatcher = new faceapi.FaceMatcher(labeledDescriptor, 0.6);

    console.log('✅ Employee descriptor loaded');
  },
  error: function (err) {
    console.error(err);
  }
});

// 🔹 Load models then start camera
Promise.all([
  faceapi.nets.tinyFaceDetector.loadFromUri('/models'),
  faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
  faceapi.nets.faceRecognitionNet.loadFromUri('/models')
]).then(startVideo);

// 🔹 Start webcam
function startVideo() {
  navigator.mediaDevices
    .getUserMedia({ video: {} })
    .then(stream => {
      video.srcObject = stream;

      video.addEventListener('play', () => {
        const container = video.parentElement;
        container.style.position = 'relative';

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

        setInterval(detectFace, 300); // 🔹 optimized interval
      });
    })
    .catch(err => console.error(err));
}

// 🔹 Detect + Match face
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

  const ctx = canvas.getContext('2d');
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  if (!detection) {
    document.getElementById('status').innerText = 'No face detected';
    isProcessing = false;
    return;
  }

  const resizedDetection = faceapi.resizeResults(detection, displaySize);

  // 🔹 Match face
  const bestMatch = faceMatcher.findBestMatch(detection.descriptor);

  const box = resizedDetection.detection.box;

  // 🔹 Draw box
  ctx.lineWidth = 2;
  ctx.strokeStyle = 'blue';
  ctx.strokeRect(box.x, box.y, box.width, box.height);

  // 🔹 Label
  const label = bestMatch.toString(); // "John Doe (0.45)" or "unknown"

  ctx.font = '16px Arial';
  ctx.textBaseline = 'top';

  ctx.fillStyle = 'blue';
  ctx.fillRect(box.x, box.y - 20, ctx.measureText(label).width + 10, 20);

  ctx.fillStyle = 'white';
  ctx.fillText(label, box.x + 5, box.y - 18);

  // 🔹 Status text
  if (bestMatch.label === employeeName) {
    document.getElementById('status').innerText = `✅ Matched: ${employeeName}`;
  } else {
    document.getElementById('status').innerText = `❌ Not Matched`;
  }

  isProcessing = false;
}

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
