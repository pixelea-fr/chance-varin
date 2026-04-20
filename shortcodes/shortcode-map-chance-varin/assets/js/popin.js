(function () {
  'use strict';

  function init() {
    var wrappers = document.querySelectorAll('.map-chance-varin');

    wrappers.forEach(function (wrapper) {
      var tooltip = wrapper.querySelector('.map-chance-varin__tooltip');
      var groups = wrapper.querySelectorAll('.svg-cv-group');

      if (!tooltip || !groups.length) return;

      var hideTimer = null;

      groups.forEach(function (group) {
        var titleEl = group.querySelector(':scope > .svg-cv-title');
        var titleText = titleEl ? titleEl.textContent : '';
        var icon = group.querySelector('.svg-cv-icon');

        if (!titleText || !icon) return;

        group.style.cursor = 'pointer';

        group.addEventListener('mouseenter', function (e) {
          if (hideTimer) {
            clearTimeout(hideTimer);
            hideTimer = null;
          }
          tooltip.textContent = titleText;
          tooltip.classList.add('is-visible');
          positionTooltip(e, wrapper, tooltip, icon);
        });

        group.addEventListener('mouseleave', function () {
          hideTimer = setTimeout(function () {
            tooltip.classList.remove('is-visible');
            hideTimer = null;
          }, 1000);
        });

        group.addEventListener('click', function () {
          var link = group.getAttribute('data-link');
          if (link) {
            window.location.href = link;
          }
        });
      });
    });
  }

  function positionTooltip(e, wrapper, tooltip, icon) {
    var svgEl = wrapper.querySelector('svg');
    if (!svgEl) return;

    var wrapperRect = wrapper.getBoundingClientRect();
    var iconRect = icon.getBoundingClientRect();

    // Positionner à droite de l'icône, centré verticalement
    var left = iconRect.right - wrapperRect.left + 8;
    var top = iconRect.top - wrapperRect.top + iconRect.height / 2;

    // Si le tooltip dépasse à droite, le placer à gauche de l'icône
    tooltip.style.left = left + 'px';
    tooltip.style.top = top + 'px';
    tooltip.style.transform = 'translateY(-50%)';

    // Vérifier le dépassement après positionnement
    var tooltipRect = tooltip.getBoundingClientRect();
    if (tooltipRect.right > wrapperRect.right) {
      left = iconRect.left - wrapperRect.left - tooltipRect.width - 8;
      tooltip.style.left = left + 'px';
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
