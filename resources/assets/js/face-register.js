import * as faceapi from 'face-api.js';

const video = document.getElementById('video');
let canvas;

Promise.all([
  faceapi.nets.tinyFaceDetector.loadFromUri('/models'),
  faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
  faceapi.nets.faceRecognitionNet.loadFromUri('/models')
]).then(startVideo);

function startVideo() {
  navigator.mediaDevices
    .getUserMedia({ video: true })
    .then(stream => {
      video.srcObject = stream;
    })
    .catch(err => console.error(err));
}

async function detect() {
  const detection = await faceapi
    .detectSingleFace(video, new faceapi.TinyFaceDetectorOptions())
    .withFaceLandmarks()
    .withFaceDescriptor();

  const ctx = canvas.getContext('2d');
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  if (!detection) return;

  const resized = faceapi.resizeResults(detection, {
    width: video.videoWidth,
    height: video.videoHeight
  });

  faceapi.draw.drawDetections(canvas, resized);
}

video.addEventListener('play', () => {
  // create canvas
  canvas = faceapi.createCanvasFromMedia(video);
  document.body.append(canvas);

  const displaySize = {
    width: video.videoWidth,
    height: video.videoHeight
  };

  faceapi.matchDimensions(canvas, displaySize);

  setInterval(detect, 10);
});
