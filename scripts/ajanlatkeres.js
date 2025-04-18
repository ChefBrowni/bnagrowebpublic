// reCAPTCHA v3 betöltése
function loadRecaptcha(siteKey) {
  grecaptcha.ready(function () {
    grecaptcha.execute(siteKey, { action: 'submit' }).then(function (token) {
      document.getElementById('g-recaptcha-response').value = token;
    });
  });
}

// Valós idejű email szintaxis ellenőrzés
function validateEmail() {
  const emailField = document.getElementById('email');
  const feedback = document.getElementById('email-feedback');
  const email = emailField.value;
  const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!regex.test(email)) {
    feedback.textContent = "Hibás e-mail formátum.";
    emailField.classList.add("is-invalid");
  } else {
    feedback.textContent = "";
    emailField.classList.remove("is-invalid");
  }
}

// Felmérés mező megjelenítése
function toggleFelmeres(value) {
  const felmeres = document.getElementById('felmeres-tipusok');
  felmeres.style.display = value === 'Felmérés' ? 'block' : 'none';
}
