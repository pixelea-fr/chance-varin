document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('header.wp-block-template-part');

    // On vérifie si le header existe
    if (!header) return;

    // Variables pour suivre le sens du scroll
    let lastScrollPosition = 0;
    
    // Fonction pour gérer le scroll sur tous les headers sans condition
    function handleGlobalScroll() {
        const scrollPosition = window.scrollY;
        const headers = document.querySelectorAll('header.wp-block-template-part');
        const scrollDifference = Math.abs(scrollPosition - lastScrollPosition);
        
        headers.forEach(header => {
            if (scrollPosition > 100 && scrollPosition > lastScrollPosition) {
                // Scroll vers le bas et > 100px
                header.classList.add('nav-scroll-down');
            } else if (scrollPosition < 100 || (scrollPosition < lastScrollPosition && scrollDifference > 10)) {
                // Scroll vers le haut avec au moins 30px de différence ou < 100px
                header.classList.remove('nav-scroll-down');
            }
        });
        
        lastScrollPosition = scrollPosition;
    }

    // Écouter le scroll pour tous les headers
    window.addEventListener('scroll', handleGlobalScroll);
    
    // Lancer une fois au chargement
    handleGlobalScroll();

    // On cherche le premier bloc dans entry-content
    const entryContent = document.querySelector('.entry-content');
    if (!entryContent) {
        // Si pas d'entry-content, on ajoute la classe with-bg par défaut
        header.classList.add('with-bg');
        return;
    }

    // On cible le premier enfant direct de entry-content
    const firstBlock = entryContent.firstElementChild;

    if (firstBlock && firstBlock.classList.contains('wp-block-cover')) {
        const cover = firstBlock;
        
        function handleScroll() {
            const scrollPosition = window.scrollY;
            const coverHeight = cover.offsetHeight;
            const headerHeight = 100;
            // Si le scroll est inférieur à la hauteur du cover (moins la hauteur du header pour transition plus smooth)
           //if (scrollPosition < (coverHeight - headerHeight)) {
           //    header.classList.add('light-colors');
           //    header.classList.remove('with-bg');
           //} else {
           //    header.classList.remove('light-colors');
           //    header.classList.add('with-bg');
           //}
           if (scrollPosition < 100) {
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
        // Si le premier bloc n'est pas un wp-block-cover, on ajoute la classe with-bg
        header.classList.add('with-bg');
    }
});