document.addEventListener('DOMContentLoaded', function() {
    const adjustPadding = () => {
        const containers = document.querySelectorAll('.section-text-type-3__container');
        
        containers.forEach(container => {
            const child = container.querySelector('.has-decal-h-1');
            if (child) {
                const height = child.offsetHeight;
                const style = window.getComputedStyle(child);
                const lineHeight = parseFloat(style.lineHeight) || 0;
                const adjustedHeight = height - (lineHeight / 2);
                container.style.paddingTop = `${adjustedHeight}px`;
            }
        });
    };

    // Initial calculation
    adjustPadding();

    // Recalculate on resize
    window.addEventListener('resize', adjustPadding);
});