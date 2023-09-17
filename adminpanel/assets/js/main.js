$(document).ready(function () {

  const button = document.querySelector(".pop-button"),
  toast1 = document.querySelector(".toast1");
(closeIcon = document.querySelector("popup-close-btn")),
  (progress = document.querySelector(".progress1"));
  checkItom= document.querySelector(".toast1-content .check ");

let timer1, timer2 ;

button.addEventListener("click", () => {
  
  toast1.style.display = 'block';
  checkItom.classList.add("bg-gradient-warning") ;
  progress.classList.add("active");

  timer1 = setTimeout(function() {
    toast1.classList.add('active');
  }, 50);

  timer1 = setTimeout(() => {
    toast1.classList.remove("active");
  }, 5000); //1s = 1000 milliseconds

 

  timer2 = setTimeout(() => {
    toast1.style.display = 'none';
    progress.classList.remove("active");
  }, 5300);
});

closeIcon.addEventListener("click", () => {
  
  toast1.classList.remove("active");

  setTimeout(() => {
    toast1.style.display = 'none';
    progress.classList.remove("active");
  }, 300);

  clearTimeout(timer1);
  clearTimeout(timer2);
});



});