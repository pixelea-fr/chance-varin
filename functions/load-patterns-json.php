<?php

add_action('init', 'charger_patterns_json');

function charger_patterns_json() {
  $dossier_patterns = get_template_directory() . '/patterns_json';

  if (is_dir($dossier_patterns)) {
    $fichiers_json = glob($dossier_patterns . '/*.json');
    foreach ($fichiers_json as $fichier) {
      $contenu = file_get_contents($fichier);
      $pattern = json_decode($contenu, true);
      if ($pattern && isset($pattern['title'], $pattern['content'])) {
        register_block_pattern(
          $pattern['title'],
          $pattern
        );
      }
    }
  }
}