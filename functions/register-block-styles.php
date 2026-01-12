<?php

add_action('init', 'charger_block_styles_json_recursive');

function charger_block_styles_json_recursive() {
    $dossier_styles = get_template_directory() . '/styles/blocks';

    if (!is_dir($dossier_styles)) {
        return;
    }

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dossier_styles, RecursiveDirectoryIterator::SKIP_DOTS)
    );

    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'json') {
            $contenu = file_get_contents($file->getPathname());
            $data = json_decode($contenu, true);

            if ($data && isset($data['slug'], $data['title'], $data['blockTypes'], $data['styles'])) {
                foreach ($data['blockTypes'] as $block_type) {
                    register_block_style(
                        $block_type,
                        array(
                            'name'       => $data['slug'],
                            'label'      => $data['title'],
                            'style_data' => $data['styles'],
                        )
                    );
                }
            }
        }
    }
}
