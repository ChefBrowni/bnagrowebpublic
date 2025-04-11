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

  // Rólunk lenyíló szöveg kattintásra
  const dropdownHeader = document.querySelector(".dropdown-header");
  const dropdownContent = document.querySelector(".dropdown-content");
  const arrow = document.querySelector(".arrow");

  if (dropdownHeader && dropdownContent && arrow) {
    dropdownHeader.addEventListener("click", () => {
      dropdownContent.classList.toggle("active");
      arrow.classList.toggle("open");
    });
  }

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
