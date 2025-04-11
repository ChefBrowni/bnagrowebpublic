document.addEventListener("DOMContentLoaded", function () {
  const heroText = document.querySelector(".hero-text");
  if (heroText) {
    heroText.classList.add("animate");
  }

  const surveyImage = document.querySelector(".survey-image");
  const surveyText = document.querySelector(".survey-text");

  if (surveyImage) {
    surveyImage.classList.add("slide-in-left");
  }
  if (surveyText) {
    surveyText.classList.add("slide-in-right");
  }

  document.querySelector('.menu-toggle').addEventListener('click', () => {
     document.querySelector('nav').classList.toggle('active');
   })
});
