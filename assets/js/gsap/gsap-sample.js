// Attendre que le DOM soit chargé
document.addEventListener('DOMContentLoaded', function() {

  // Vérifier si GSAP et ScrollTrigger sont chargés
  if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {

    // Sélectionner l'élément avec la classe gsap-sample
    const element = document.querySelector('.gsap-sample');

    // Vérifier si l'élément existe
    if (element) {

      // Créer une animation GSAP
      gsap.fromTo(element,
        { opacity: 0.1 }, // État initial
        {
          opacity: 1, // État final
          duration: 1, // Durée de l'animation en secondes
          scrollTrigger: {
            trigger: element, // Élément déclencheur
            start: "top center", // Position de départ (hauteur de l'élément, position dans la fenêtre)
            end: "bottom center", // Position de fin (hauteur de l'élément, position dans la fenêtre)
            scrub: true, // Animation fluide pendant le défilement
            markers: true // Affiche des marqueurs pour le débogage (à supprimer en production)
          }
        }
      );

    } else {
      console.error('Élément avec la classe gsap-sample introuvable.');
    }

  } else {
    console.error('GSAP ou ScrollTrigger n\'est pas chargé.');
  }

});