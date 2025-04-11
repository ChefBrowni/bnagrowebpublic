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

  // Hamburger menü nyitás/zárás
  document.querySelector('.menu-toggle').addEventListener('click', () => {
    document.getElementById('main-nav').classList.toggle('active');
    const navLinks = document.querySelectorAll('#main-nav a');
    navLinks.forEach(link => {
      link.addEventListener('click', () => {
        document.getElementById('main-nav').classList.remove('active');
      });
    });
  });

  // ➕ Először generáljuk a nyilakat a step-ek közé (utolsó után nem)
  // 🔁 Generáljuk a nyilakat automatikusan a step-ek közé
  const steps = document.querySelectorAll('.workflow-steps .step');
  steps.forEach((step, index) => {
    if (index < steps.length - 1) {
      const arrow = document.createElement('div');
      arrow.className = 'arrow';
      arrow.textContent = '→';
      step.parentNode.insertBefore(arrow, step.nextSibling);
    }
  });

  // 🎯 Scroll figyelő: csak a .workflow-steps-en belül vizsgálja az elemeket
  function revealStepsOnScroll() {
    const steps = document.querySelectorAll('.workflow-steps .step');
    const arrows = document.querySelectorAll('.workflow-steps .arrow');
    const triggerPoint = window.innerHeight * 0.85;

    steps.forEach((step, index) => {
      const top = step.getBoundingClientRect().top;
      if (top < triggerPoint && !step.classList.contains('show')) {
        step.classList.add('show');
        if (arrows[index]) {
          arrows[index].classList.add('show');
        }
      }
    });
  }

  window.addEventListener('scroll', revealStepsOnScroll);
  revealStepsOnScroll(); // első betöltésnél is
});
