function waitForBeforeMediaHeight(block, maxAttempts = 50) {
  return new Promise((resolve) => {
    let attempts = 0;
    const check = () => {
      const beforeMedia = block.querySelector('.media-text-decale__before-media');
      if (beforeMedia && beforeMedia.offsetHeight > 0) {
        resolve(beforeMedia.offsetHeight);
      } else if (attempts < maxAttempts) {
        attempts++;
        requestAnimationFrame(check);
      } else {
        resolve(0); // fallback si jamais chargé
      }
    };
    check();
  });
}

async function alignMediaWithLastChild() {
  const blocks = document.querySelectorAll('.media-text-decale');

  for (const block of blocks) {
    const txt = block.querySelector('.media-text-decale__txt');
    const media = block.querySelector('.media-text-decale__media');

    if (!txt || !media) continue;

    // Trouver le dernier "vrai" enfant visible (ignorer les outils de dev ou éléments vides)
    let lastChild = txt.lastElementChild;
    while (lastChild && (lastChild.classList.contains('up-class-visualizer-container') || lastChild.offsetHeight === 0)) {
      lastChild = lastChild.previousElementSibling;
    }

    if (!lastChild) continue;

    // Attendre que before-media ait une hauteur valide (et que le layout soit stable)
    await waitForBeforeMediaHeight(block);

    // RE-MESURE après le chargement pour avoir les positions exactes
    const txtRect = txt.getBoundingClientRect();
    const lastChildRect = lastChild.getBoundingClientRect();
    
    // On cible l'image à l'intérieur du wrapper media
    const img = media.querySelector('img');
    // On prend le wrapper media en référence pour le margin, mais on vise l'alignement visuel de l'image si elle existe
    const mediaRect = img ? img.getBoundingClientRect() : media.getBoundingClientRect();

    // CALCUL ROBUSTE : "Delta"
    // On veut que le HAUT de l'image (mediaRect.top) soit au niveau du HAUT du bouton (lastChildRect.top)
    // On récupère la marge actuelle déjà appliquée (pour ne pas la perdre au redimensionnement)
    const currentMargin = parseFloat(window.getComputedStyle(block).getPropertyValue('--margin-top-media')) || 0;
    
    // Différence à combler
    const delta = lastChildRect.top - mediaRect.top;
    
    // Nouvelle marge = Marge actuelle + Différence
    const newMargin = currentMargin + delta;

    console.log('Media Text Decale Debug:', {
      'Target (Button Top)': Math.round(lastChildRect.top),
      'Current (Media Top)': Math.round(mediaRect.top),
      'Current Margin': Math.round(currentMargin),
      'Delta needed': Math.round(delta),
      'New Margin': Math.round(newMargin)
    });

    block.style.setProperty('--margin-top-media', `${newMargin}px`);
  }
}

// Lancement
window.addEventListener('DOMContentLoaded', () => {
  alignMediaWithLastChild();
  window.addEventListener('resize', alignMediaWithLastChild);
});