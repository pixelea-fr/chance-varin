document.addEventListener('DOMContentLoaded', () => {
  // inputs ET textareas
  const fields = document.querySelectorAll('.with-label-behind input, .with-label-behind textarea');

  const toggleValueClass = el =>
    el.classList.toggle('has-value', el.value.trim().length > 0);

  fields.forEach(el => {
    // état initial
    toggleValueClass(el);

    // à chaque modification
    el.addEventListener('input', () => toggleValueClass(el));
    el.addEventListener('change', () => toggleValueClass(el));
  });
});