document.addEventListener("DOMContentLoaded", function () {
  // Hero szöveg animáció
  const heroText = document.querySelector(".hero-text");
  if (heroText) {
    heroText.classList.add("animate");
  }

  // Survey szekció animáció
  const surveyImage = document.querySelector(".survey-image");
  const surveyText = document.querySelector(".survey-text");

  if (surveyImage) surveyImage.classList.add("slide-in-left");
  if (surveyText) surveyText.classList.add("slide-in-right");

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

  // Dropdown nyíl kezelés a hero szekcióban (több dropdown támogatása)
  const dropdownHeaders = document.querySelectorAll(".dropdown-header");

  dropdownHeaders.forEach(header => {
    const dropdownContent = header.nextElementSibling;
    const arrow = header.querySelector(".arrow, .arrow_hero");

    header.addEventListener("click", () => {
      // Csak egy lehet nyitva egyszerre
      dropdownHeaders.forEach(otherHeader => {
        const otherContent = otherHeader.nextElementSibling;
        const otherArrow = otherHeader.querySelector(".arrow, .arrow_hero");
        if (otherHeader !== header) {
          otherContent.classList.remove("active");
          if (otherArrow) otherArrow.classList.remove("open");
        }
      });

      dropdownContent.classList.toggle("active");
      if (arrow) arrow.classList.toggle("open");
    });
  });

  // Almenük – például "Permetezés" és "Felmérés"
  const subHeaders = document.querySelectorAll('.dropdown-subheader');

  subHeaders.forEach(header => {
    const subContent = header.nextElementSibling;
    const arrow = header.querySelector('.sub-arrow');

    header.addEventListener('click', () => {
      subHeaders.forEach(otherHeader => {
        const otherContent = otherHeader.nextElementSibling;
        const otherArrow = otherHeader.querySelector('.sub-arrow');

        if (otherHeader !== header) {
          otherContent.classList.remove('active');
          otherArrow.classList.remove('open');
        }
      });

      subContent.classList.toggle('active');
      arrow.classList.toggle('open');
    });
  });

  // ➕ Automatikusan generált nyilak a step-ek közé
  const steps = document.querySelectorAll('.workflow-steps .step');
  steps.forEach((step, index) => {
    if (index < steps.length - 1) {
      const arrow = document.createElement('div');
      arrow.className = 'arrow';
      arrow.textContent = '→';
      step.parentNode.insertBefore(arrow, step.nextSibling);
    }
  });

  // 📌 Scroll trigger az animációkhoz (workflow szekció)
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
  revealStepsOnScroll(); // első betöltéskor is fut
});
