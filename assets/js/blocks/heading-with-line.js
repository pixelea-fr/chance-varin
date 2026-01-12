document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.wp-block-heading.is-style-with-line').forEach(heading => {
        // Créer le wrapper externe (pour l'alignement et max-width)
        const outerWrapper = document.createElement('div');
        outerWrapper.className = 'is-style-with-line__container';
        
        // Créer le container interne (pour les lignes)
        const innerContainer = document.createElement('div');
        innerContainer.className = 'is-style-with-line__wrapper';
        
        // Transférer les classes d'alignement vers le wrapper externe
        ['alignwide', 'alignfull', 'has-text-align-center', 'has-text-align-right', 'has-text-align-left']
            .forEach(className => {
                if (heading.classList.contains(className)) {
                    innerContainer.classList.add(className);
                    // Retirer les classes align* du heading
                    if (className.startsWith('align')) {
                        heading.classList.remove(className);
                    }
                }
            });
        
        // Remplacer le heading par le wrapper
        heading.replaceWith(outerWrapper);
        
        // Assembler : wrapper > container > heading
        outerWrapper.appendChild(innerContainer);
        innerContainer.appendChild(heading);
    });
});