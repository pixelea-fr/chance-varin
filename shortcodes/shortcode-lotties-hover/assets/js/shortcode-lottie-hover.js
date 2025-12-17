document.addEventListener('DOMContentLoaded', function () {
  const lotties = document.querySelectorAll('.lottie-hover-container');

  lotties.forEach(container => {
    const src = container.dataset.src;
    if (!src) return;

    // Options par défaut ou depuis data-attributes
    const speed = parseFloat(container.dataset.speed) || 1;
    const reverseOnLeave = container.dataset.reverse === 'true';
    const loop = container.dataset.loop === 'true';
    const autoplay = container.dataset.autoplay === 'true';
    const triggerSelector = container.dataset.hoverTrigger;
    
    // Nouvelles options
    const persistEnd = container.dataset.persistEnd !== 'false'; // Default true
    const triggerType = container.dataset.trigger || 'hover'; // hover, scroll

    // Initialisation de l'animation
    const anim = lottie.loadAnimation({
      container: container,
      renderer: 'svg',
      loop: loop,
      autoplay: autoplay, // Si autoplay est true, ça démarre tout seul peu importe le trigger
      path: src
    });

    anim.setSpeed(speed);

    // Si autoplay est activé, on ignore les triggers
    if (autoplay) return;

    // Logique Scroll Trigger
    if (triggerType === 'scroll') {
      if (typeof ScrollTrigger !== 'undefined') {
        ScrollTrigger.create({
          trigger: container,
          start: "top 85%", 
          onEnter: () => {
            anim.goToAndPlay(0);
          }
        });
      } else {
        // Fallback IntersectionObserver si GSAP n'est pas là
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    anim.goToAndPlay(0);
                    observer.unobserve(entry.target);
                }
            });
        });
        observer.observe(container);
      }
      return;
    }

    // Logique Hover Trigger (Défaut)
    let triggerEl = container;
    if (triggerSelector) {
      const closest = container.closest(triggerSelector);
      if (closest) {
        triggerEl = closest;
      } else {
        const found = document.querySelector(triggerSelector);
        if (found) {
          triggerEl = found;
        }
      }
    }

    triggerEl.addEventListener('mouseenter', () => {
      anim.setDirection(1);
      anim.play();
    });

    triggerEl.addEventListener('mouseleave', () => {
      // Si persistEnd est true, on ne fait rien (on laisse finir ou rester à la fin)
      if (persistEnd) return;

      // Sinon, on applique la logique de reverse ou stop
      if (reverseOnLeave) {
        anim.setDirection(-1);
        anim.play();
      } else {
        anim.stop();
        // Ou anim.goToAndStop(0) si on veut reset immédiat
      }
    });

  });
});
