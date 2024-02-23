
document.addEventListener('DOMContentLoaded', function() {
    var copy = document.querySelector(".logos-slide").cloneNode(true);
    document.querySelector('.logos').appendChild(copy);
});


  
var hamburger = document.querySelector(".hamburger--elastic");
hamburger.addEventListener("click", function() {
    hamburger.classList.toggle("is-active");
});

var dropdown = document.getElementById("navbarDropdown");
var icon = document.getElementById("languageIcon");

dropdown.addEventListener("click", function(event) {
    icon.classList.toggle("lang-button-active");
    event.stopPropagation();
});

document.addEventListener("click", function() {
    icon.classList.remove("lang-button-active");
});

