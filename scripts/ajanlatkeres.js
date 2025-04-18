function loadRecaptcha(siteKey) {
  grecaptcha.ready(function () {
    grecaptcha.execute(siteKey, { action: 'ajanlatkeres' }).then(function (token) {
      document.getElementById('g-recaptcha-response').value = token;
    });
  });
}

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

function toggleFelmeres(value) {
  const felmeres = document.getElementById('felmeres-tipusok');
  felmeres.style.display = value === 'Felmérés' ? 'block' : 'none';
}
