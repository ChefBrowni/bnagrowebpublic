/* ===== AJAX form betöltés ===== */
document.addEventListener('DOMContentLoaded', () => {
  const container = document.getElementById('quote-form-container');
  if (!container) return;          // ha kézzel beillesztetted a formot, nincs konténer

  fetch('aloldalak/ajanlatkeres.php')
    .then(res  => res.text())
    .then(html => { container.innerHTML = html; })
    .catch(err => console.error('Űrlap betöltése sikertelen:', err));
});
