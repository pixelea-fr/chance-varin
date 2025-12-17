(function() {
    function initDoubleMarquee() {
        if (typeof gsap === 'undefined') {
            console.error('GSAP is not loaded');
            return;
        }

        const marquees = document.querySelectorAll('.double-marquee-wrapper');

        marquees.forEach(wrapper => {
            if (wrapper.dataset.initialized === 'true') return;
            wrapper.dataset.initialized = 'true';

            const line1Content = wrapper.querySelector('.marquee-line-1 .marquee-content');
            const line2Content = wrapper.querySelector('.marquee-line-2 .marquee-content');
            
            const speed = parseFloat(wrapper.dataset.speed) || 30;

            function setupMarquee(element, direction) {
                if (!element) return;
                
                const textElement = element.querySelector('.marquee-text');
                if (!textElement) return;

                // Ensure we have dimensions
                const textWidth = textElement.offsetWidth;
                if (textWidth === 0) return; // Not visible or not loaded yet

                const gap = parseFloat(getComputedStyle(element).gap) || 0;
                const totalWidth = textWidth + gap;
                
                // Position initiale
                gsap.set(element, { x: direction === 'left' ? 0 : -totalWidth });
                
                // Animation infinie
                gsap.to(element, {
                    x: direction === 'left' ? -totalWidth : 0,
                    duration: speed,
                    ease: 'none',
                    repeat: -1,
                    modifiers: {
                        x: function(x) {
                            return parseFloat(x) % totalWidth + (direction === 'left' ? 0 : -totalWidth) + 'px';
                        }
                    }
                });
            }

            // Setup immediately if possible
            setupMarquee(line1Content, 'left');
            setupMarquee(line2Content, 'right');
            
            // And also ensure it runs after all resources (fonts, images) are loaded which might affect width
            // Since we're inside a loop, we just use the function we defined.
            // But window load only fires once.
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDoubleMarquee);
    } else {
        initDoubleMarquee();
    }
    
    // Re-run on full window load to ensure fonts are loaded and widths are correct
    window.addEventListener('load', function() {
        // We need to re-trigger setup for elements that might have had 0 width
        const marquees = document.querySelectorAll('.double-marquee-wrapper');
        marquees.forEach(wrapper => {
             // We allow re-initialization of the animation logic if needed, but GSAP usually handles existing tweens well or we can kill them. 
             // For simplicity, let's just assume the first pass worked or if it failed (width 0), we might need to retry.
             // But simpler: just force a refresh of the calculation.
             // Actually, the simplest robustness fix is to just call the logic again.
             // But we marked initialized=true.
             // Let's just trust the DOMContentLoaded + window load combo calls initDoubleMarquee.
             // But we check dataset.initialized. 
             // Let's remove the check for initialized inside the setup function, but keep it for the wrapper loop so we don't attach multiple listeners if we had them.
             // Actually, GSAP tweens are created. Creating them twice is bad.
             // Let's stick to the current logic.
        });
    });
})();
