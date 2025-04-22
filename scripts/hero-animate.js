/* ===== AJAX‑osan betöltjük az ajánlatkérő űrlapot ===== */
document.addEventListener('DOMContentLoaded', () => {
  const container = document.getElementById('quote-form-container');
  if (!container) return;             // ha nincs ilyen elem, kilépünk

  fetch('aloldalak/ajanlatkeres.php')
    .then(res  => res.text())
    .then(html => { container.innerHTML = html; })
    .catch(err => console.error('Űrlap betöltése sikertelen:', err));
});
