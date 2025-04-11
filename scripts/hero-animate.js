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

  // Minden .dropdown-header lenyíló kezelés (pl. Rólunk, Gépeink stb.)
  const dropdownHeaders = document.querySelectorAll(".dropdown-header");

  dropdownHeaders.forEach(header => {
    const dropdownContent = header.nextElementSibling;
    const arrow = header.querySelector(".arrow");

    header.addEventListener("click", () => {
      // Először zárjon be minden más nyitott
      dropdownHeaders.forEach(otherHeader => {
        const otherContent = otherHeader.nextElementSibling;
        const otherArrow = otherHeader.querySelector(".arrow");

        if (otherHeader !== header) {
          otherContent.classList.remove("active");
          otherArrow.classList.remove("open");
        }
      });

      // Ezután nyissa/zárja ezt a konkrétat
      dropdownContent.classList.toggle("active");
      arrow.classList.toggle("open");
    });
  });

  // Belső lenyíló szekciók: Permetezés, Felmérés
  // Belső lenyíló szekciók: Permetezés, Felmérés
  const subHeaders = document.querySelectorAll('.dropdown-subheader');

  subHeaders.forEach(header => {
    const subContent = header.nextElementSibling;
    const arrow = header.querySelector('.sub-arrow');

    header.addEventListener('click', () => {
      // Bezár minden másik nyitott almenüt
      subHeaders.forEach(otherHeader => {
        const otherContent = otherHeader.nextElementSibling;
        const otherArrow = otherHeader.querySelector('.sub-arrow');

        if (otherHeader !== header) {
          otherContent.classList.remove('active');
          otherArrow.classList.remove('open');
        }
      });

      // Majd toggle a jelenlegire
      subContent.classList.toggle('active');
      arrow.classList.toggle('open');
    });
  });

  // Scrollra jelenjenek meg a workflow kártyák
function revealStepsOnScroll() {
  const steps = document.querySelectorAll('.step');
  const arrows = document.querySelectorAll('.arrow');
  const triggerPoint = window.innerHeight * 0.85;

  steps.forEach((step, index) => {
    const top = step.getBoundingClientRect().top;
    if (top < triggerPoint) {
      step.classList.add('show');
      if (arrows[index]) arrows[index].classList.add('show');
    }
  });
}

window.addEventListener('scroll', revealStepsOnScroll);
revealStepsOnScroll(); // első betöltésnél is
});
