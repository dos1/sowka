function blinkEyes() {
  document.getElementById('header-sowka-logo').style.backgroundPosition='0px -200px';
  setTimeout("unblinkEyes()", 200);
  initBlinking();
}

function unblinkEyes() {
  document.getElementById('header-sowka-logo').style.backgroundPosition='0px 0px';
}

function initBlinking() {
  setTimeout("blinkEyes()", (Math.random()*20000)+2000);
}

if (window.addEventListener) {
  window.addEventListener('load', initBlinking, false);
}
else if (document.addEventListener) {
  document.addEventListener('load', initBlinking, false);
}
