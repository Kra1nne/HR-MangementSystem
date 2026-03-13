import * as faceapi from 'face-api.js';

const video = document.getElementById('video');

Promise.all([
  faceapi.nets.tinyFaceDetector.loadFromUri('/models'),
  faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
  faceapi.nets.faceRecognitionNet.loadFromUri('/models')
]).then(startVideo);

function startVideo() {
  navigator.mediaDevices
    .getUserMedia({ video: {} })
    .then(stream => (video.srcObject = stream))
    .catch(err => console.error(err));
}

async function detectFace() {
  const detection = await faceapi
    .detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
    .withFaceLandmarks()
    .withFaceDescriptor();

  if (!detection) {
    $('#status').text('No face detected');
    return;
  }

  const descriptor = Array.from(detection.descriptor);
  $('#status').text('Face detected! Sending to server...');

  // Send descriptor to backend (Laravel) via AJAX
  //   $.ajax({
  //     url: '/face-login', // your Laravel face-login route
  //     method: 'POST',
  //     data: {
  //       descriptor: descriptor,
  //       _token: '{{ csrf_token() }}'
  //     },
  //     success: function (res) {
  //       if (res.status === 'success') {
  //         $('#status').text('Welcome ' + res.user);
  //       } else {
  //         $('#status').text(res.message);
  //       }
  //     },
  //     error: function (err) {
  //       console.error(err);
  //       $('#status').text('Error communicating with server');
  //     }
  //   });
}

// Auto detect every 2 seconds
setInterval(detectFace, 2000);
