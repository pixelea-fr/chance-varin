document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('header.wp-block-template-part');
    
    // On vérifie si le header existe
    if (!header) return;

    // On cherche le bloc suivant direct ou le premier cover dans le contenu principal
    // La consigne est "s'il est suivi d'un wp-block-cover"
    const nextBlock = header.nextElementSibling;

    if (nextBlock && nextBlock.classList.contains('wp-block-cover')) {
        const cover = nextBlock;
        
        function handleScroll() {
            const scrollPosition = window.scrollY;
            const coverHeight = cover.offsetHeight;
            const headerHeight = header.offsetHeight;

            // Si le scroll est inférieur à la hauteur du cover (moins la hauteur du header pour transition plus smooth éventuellement, 
            // mais la demande est "inferieur a celui ci" donc hauteur du cover)
            if (scrollPosition < (coverHeight - headerHeight)) {
                header.classList.add('light-colors');
                     header.classList.remove('with-bg');
            } else {
                header.classList.remove('light-colors');
                     header.classList.add('with-bg');
            }
        }

        // Écouter le scroll
        window.addEventListener('scroll', handleScroll);
        
        // Lancer une fois au chargement
        handleScroll();
    } else {
        // Si pas de block cover après, on ajoute la classe with-bg
        header.classList.add('with-bg');
    }
});
