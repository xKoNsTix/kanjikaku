/* This website was created as MultiMediaProject 1 for MultiMediaTechnology at the Salzburg University of Applied Sciences.
Author: Jennifer Scharinger
Illustration: by pikisuperstar - www.freepik.com */

const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');
let coord = { x: 0, y: 0};

document.addEventListener('mousedown', start);
document.addEventListener('mouseup', stop);
// window.addEventListener('resize', resize);

// Resizing
    //canvas.height = window.innerHeight;

function start(event) {
    document.addEventListener('mousemove', draw);
    reposition(event);
  }

function reposition(event) {
    coord.x = event.clientX - canvas.offsetLeft;
    coord.y = event.clientY - canvas.offsetTop;
}

function stop() {
    document.removeEventListener('mousemove', draw);
}

function draw(event) {
    ctx.beginPath();
    ctx.lineWidth = 5;
    ctx.lineCap = 'round';
    ctx.strokeStyle = '#AF315C';
    ctx.moveTo(coord.x, coord.y);
    reposition(event);
    ctx.lineTo(coord.x, coord.y);
    reposition(event);
    ctx.stroke();
  }

  document.getElementById('clear').addEventListener("click", function() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
  })
