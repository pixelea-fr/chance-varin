/**
 * Script pour détecter et ajouter une classe indiquant le nombre de lignes
 * pour les éléments avec la classe .has-decal-h-1
 */

(function() {
  'use strict';

  /**
   * Calcule le nombre de lignes d'un élément en fonction de sa hauteur et de la hauteur de ligne
   * @param {HTMLElement} element - L'élément à analyser
   * @returns {number} - Le nombre de lignes
   */
  function getLineCount(element) {
    // Obtenir la hauteur totale de l'élément
    const elementHeight = element.offsetHeight;
    
    // Obtenir la hauteur de ligne calculée
    const computedStyle = window.getComputedStyle(element);
    const lineHeight = parseFloat(computedStyle.lineHeight);
    
    // Si line-height est "normal", on l'estime à environ 1.2 fois la taille de police
    const actualLineHeight = isNaN(lineHeight) 
      ? parseFloat(computedStyle.fontSize) * 1.2 
      : lineHeight;
    
    // Calculer le nombre de lignes
    const lineCount = Math.round(elementHeight / actualLineHeight);
    
    return Math.max(1, lineCount); // Au minimum 1 ligne
  }

  /**
   * Met à jour la classe d'un élément en fonction de son nombre de lignes
   * @param {HTMLElement} element - L'élément à mettre à jour
   */
  function updateLineClass(element) {
    // Retirer toutes les classes de type --Xlines
    const classList = Array.from(element.classList);
    classList.forEach(className => {
      if (className.match(/has-decal-h-1--\d+lines?/)) {
        element.classList.remove(className);
      }
    });

    // Calculer le nombre de lignes
    const lineCount = getLineCount(element);
    
    // Ajouter la nouvelle classe
    const lineWord = lineCount === 1 ? 'line' : 'lines';
    element.classList.add(`has-decal-h-1--${lineCount}${lineWord}`);
    
    // Optionnel : ajouter un attribut data pour faciliter le débogage
    element.setAttribute('data-line-count', lineCount);
  }

  /**
   * Met à jour tous les éléments .has-decal-h-1
   */
  function updateAllElements() {
    const elements = document.querySelectorAll('.has-decal-h-1');
    elements.forEach(updateLineClass);
  }

  /**
   * Debounce function pour limiter la fréquence d'exécution
   * @param {Function} func - La fonction à debouncer
   * @param {number} wait - Le délai en millisecondes
   * @returns {Function} - La fonction debouncée
   */
  function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
      const later = () => {
        clearTimeout(timeout);
        func(...args);
      };
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
    };
  }

  // Créer une version debouncée de la fonction de mise à jour
  const debouncedUpdate = debounce(updateAllElements, 150);

  /**
   * Initialisation
   */
  function init() {
    // Mise à jour initiale au chargement du DOM
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', updateAllElements);
    } else {
      updateAllElements();
    }

    // Mise à jour au redimensionnement de la fenêtre
    window.addEventListener('resize', debouncedUpdate);

    // Observer les changements dans le DOM pour les nouveaux éléments
    const observer = new MutationObserver((mutations) => {
      let shouldUpdate = false;
      
      mutations.forEach((mutation) => {
        mutation.addedNodes.forEach((node) => {
          if (node.nodeType === 1) { // Element node
            if (node.classList && node.classList.contains('has-decal-h-1')) {
              shouldUpdate = true;
            }
            // Vérifier aussi dans les descendants
            if (node.querySelectorAll && node.querySelectorAll('.has-decal-h-1').length > 0) {
              shouldUpdate = true;
            }
          }
        });
      });
      
      if (shouldUpdate) {
        debouncedUpdate();
      }
    });

    // Observer les changements dans tout le document
    observer.observe(document.body, {
      childList: true,
      subtree: true
    });

    // Mise à jour lors du chargement complet (images, fonts, etc.)
    window.addEventListener('load', updateAllElements);
  }

  // Lancer l'initialisation
  init();

  // Exposer la fonction de mise à jour globalement si besoin
  window.updateLineClasses = updateAllElements;

})();