import * as faceapi from 'face-api.js';

const video = document.getElementById('video');
let canvas;
let latestDetection;
startVideo();
// Load models
Promise.all([
  faceapi.nets.tinyFaceDetector.loadFromUri('/models'),
  faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
  faceapi.nets.faceRecognitionNet.loadFromUri('/models')
]);

// Start webcam
function startVideo() {
  navigator.mediaDevices
    .getUserMedia({ video: {} })
    .then(stream => {
      video.srcObject = stream;
    })
    .catch(err => console.error(err));
}
function stopVideo() {
  if (videoStream) {
    // Stop all tracks (video/audio)
    videoStream.getTracks().forEach(track => track.stop());
    video.srcObject = null; // remove the video source
  }
}

async function detect() {
  if (!canvas || video.readyState !== 4) return;

  const detection = await faceapi
    .detectSingleFace(
      video,
      new faceapi.TinyFaceDetectorOptions({
        inputSize: 416,
        scoreThreshold: 0.5
      })
    )
    .withFaceLandmarks()
    .withFaceDescriptor();

  const ctx = canvas.getContext('2d');

  const displaySize = {
    width: video.offsetWidth,
    height: video.offsetHeight
  };

  ctx.clearRect(0, 0, canvas.width, canvas.height);

  if (!detection) {
    latestDetection = null;
    $('#btnRegister').addClass('disabled');
    $('#status').text('No face detected!!!');
    return;
  }
  $('#btnRegister').removeClass('disabled');
  const resized = faceapi.resizeResults(detection, displaySize);
  latestDetection = detection;
  // Draw box + landmarks
  faceapi.draw.drawDetections(canvas, resized);
}

// When video starts
video.addEventListener('play', () => {
  const container = video.parentElement;
  container.style.position = 'relative';

  canvas = document.createElement('canvas');
  container.appendChild(canvas);

  // 🔥 CRITICAL: match EXACT rendered size
  const width = video.offsetWidth;
  const height = video.offsetHeight;

  canvas.width = width;
  canvas.height = height;

  canvas.style.position = 'absolute';
  canvas.style.top = video.offsetTop + 'px';
  canvas.style.left = video.offsetLeft + 'px';
  canvas.style.width = width + 'px';
  canvas.style.height = height + 'px';

  // 🔥 ensures internal scaling is correct
  faceapi.matchDimensions(canvas, { width, height });

  setInterval(detect, 100);
});

$(function () {
  $(document).on('click', '#btnRegister', function () {
    const descriptor = Array.from(latestDetection.descriptor) ?? '';
    const id = $(this).data('id');
    stopVideo;
    $.ajax({
      url: '/employee/face-registration/add',
      method: 'POST',
      cache: false,
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        descriptor: descriptor,
        id: id
      },
      beforeSend: function () {
        $('.preloader').show();
      },
      success: function (data) {
        $('.preloader').hide();
        if (data.Error == 0) {
          Toastify({
            text: data.Message,
            duration: 3000,
            close: true,
            gravity: 'top', // top or bottom
            position: 'right', // left, center or right
            backgroundColor: '#008000',
            stopOnFocus: true
          }).showToast();
        } else {
          Toastify({
            text: data.Message,
            duration: 3000,
            close: true,
            gravity: 'top', // top or bottom
            position: 'right', // left, center or right
            backgroundColor: '#cc3300',
            stopOnFocus: true
          }).showToast();
        }
      },
      error: function () {
        $('.preloader').hide();
        Toastify({
          text: 'Unable to save data. Please try again later.',
          duration: 3000,
          close: true,
          gravity: 'top', // top or bottom
          position: 'right', // left, center or right
          backgroundColor: '#dc3545',
          stopOnFocus: true
        }).showToast();
      }
    });
  });
});
