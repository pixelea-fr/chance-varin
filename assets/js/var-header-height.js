// Fonction pour mettre à jour la variable CSS --header-height
function updateHeaderHeight() {
  const header = document.querySelector('.wp-site-blocks > header');
  
  if (header) {
    const height = header.offsetHeight;
    document.documentElement.style.setProperty('--header-height', `${height}px`);
  }
}

// Mettre à jour au chargement de la page
updateHeaderHeight();

// Mettre à jour lors du redimensionnement de la fenêtre
window.addEventListener('resize', updateHeaderHeight);

// Observer les changements du DOM pour détecter les modifications du header
const observer = new ResizeObserver(updateHeaderHeight);
const header = document.querySelector('.wp-site-blocks > header');

if (header) {
  observer.observe(header);
}