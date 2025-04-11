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
  const subHeaders = document.querySelectorAll('.dropdown-subheader');

  subHeaders.forEach(header => {
    const subContent = header.nextElementSibling;
    const arrow = header.querySelector('.sub-arrow');

    header.addEventListener('click', () => {
      subContent.classList.toggle('active');
      arrow.classList.toggle('open');
    });
  });
});
