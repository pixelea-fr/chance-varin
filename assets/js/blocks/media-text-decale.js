// function adjustMediaTextDecaleHeight() {
//     const containers = document.querySelectorAll('.media-text-decale');
    
//     containers.forEach(container => {
//         const textElement = container.querySelector('.media-text-decale__txt');
//         const mediaElement = container.querySelector('.media-text-decale__media');
        
//         if (!textElement || !mediaElement) return;
        
//         // Récupère les dimensions réelles
//         const textHeight = textElement.offsetHeight;
//         const mediaHeight = mediaElement.offsetHeight;
        
//         // Récupère les variables CSS
//         const styles = getComputedStyle(container);
//         const paddingText = parseFloat(styles.getPropertyValue('--padding-text')) || 120; // 7.5rem = 120px par défaut
//         const btnHeight = parseFloat(styles.getPropertyValue('--btn-height')) || 36;
        
//         // Calcule la hauteur nécessaire
//         // La hauteur totale = hauteur du texte + le dépassement du media
//         const mediaOverflow = mediaHeight - paddingText - btnHeight;
//         const totalHeight = textHeight + mediaOverflow;
        
//         // Applique la hauteur au conteneur
//         container.style.height = `${totalHeight}px`;
//     });
// }

// // Exécute au chargement de la page
// document.addEventListener('DOMContentLoaded', adjustMediaTextDecaleHeight);

// // Exécute lors du redimensionnement de la fenêtre
// let resizeTimeout;
// window.addEventListener('resize', () => {
//     clearTimeout(resizeTimeout);
//     resizeTimeout = setTimeout(adjustMediaTextDecaleHeight, 150);
// });

// // Si vous chargez des images dynamiquement, exécutez aussi après le chargement des images
// window.addEventListener('load', adjustMediaTextDecaleHeight);