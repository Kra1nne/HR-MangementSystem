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

        setInterval(detectFace, 100); // 100ms for performance
      });
    })
    .catch(err => console.error(err));
}

async function detectFace() {
  if (!canvas) return;

  const displaySize = {
    width: video.clientWidth,
    height: video.clientHeight
  };
  faceapi.matchDimensions(canvas, displaySize);

  const detections = await faceapi
    .detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
    .withFaceLandmarks()
    .withFaceDescriptors();

  const resizedDetections = faceapi.resizeResults(detections, displaySize);

  const ctx = canvas.getContext('2d');
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  if (!detections || detections.length === 0) {
    document.getElementById('status').innerText = 'No face detected';
    return;
  }

  // Draw custom colored boxes (green)
  ctx.lineWidth = 2;
  ctx.strokeStyle = 'blue';

  resizedDetections.forEach(detection => {
    const box = detection.detection.box;
    ctx.beginPath();
    ctx.rect(box.x, box.y, box.width, box.height);
    ctx.stroke();
  });

  // Draw "person" label above each detected face box
  ctx.font = '16px Arial';
  ctx.textBaseline = 'top';

  resizedDetections.forEach(detection => {
    const box = detection.detection.box;
    const label = 'person';

    ctx.fillStyle = 'blue'; // Label background
    ctx.fillRect(box.x, box.y - 20, ctx.measureText(label).width + 10, 20);

    ctx.fillStyle = 'white'; // Label text
    ctx.fillText(label, box.x + 5, box.y - 18);
  });

  document.getElementById('status').innerText = 'Face detected! Sending to server...';
}
