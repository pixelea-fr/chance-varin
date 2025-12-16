(function () {
  const nav = document.querySelector('.wp-block-navigation__container.navigation-logo-centered');
  if (!nav) return;                       
  const count = nav.children.length;     
  nav.setAttribute('data-nb-elements', count);
})();