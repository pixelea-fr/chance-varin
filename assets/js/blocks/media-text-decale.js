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

    const lastChild = txt.lastElementChild;
    if (!lastChild) continue;

    const txtRect = txt.getBoundingClientRect();
    const lastChildRect = lastChild.getBoundingClientRect();

    const offsetTop = lastChildRect.top - txtRect.top;

    // Attendre que before-media ait une hauteur valide
    const beforeMediaHeight = await waitForBeforeMediaHeight(block);

    const finalOffset = offsetTop - beforeMediaHeight;
    const clampedOffset = Math.max(0, finalOffset);
    block.style.setProperty('--margin-top-media', `${clampedOffset}px`);
  }
}

// Lancement
window.addEventListener('DOMContentLoaded', () => {
  alignMediaWithLastChild();
  window.addEventListener('resize', alignMediaWithLastChild);
});