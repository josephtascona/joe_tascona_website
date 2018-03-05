window.onload = function() {
  document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
}

function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}
