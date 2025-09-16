<?php
/**
 * Page d'administration pour gérer le chargement permanent des CSS/JS
 */

// Ajouter la page d'admin au menu
add_action('admin_menu', 'up_add_permanent_assets_page');
function up_add_permanent_assets_page() {
    add_theme_page(
        'Assets Permanents',
        'Assets Permanents', 
        'manage_options',
        'up-permanent-assets',
        'up_permanent_assets_page_callback'
    );
}

// Callback pour afficher la page
function up_permanent_assets_page_callback() {
    // Traitement du formulaire
    if (isset($_POST['submit']) && wp_verify_nonce($_POST['up_nonce'], 'up_permanent_assets')) {
        $permanent_css = $_POST['permanent_css'] ?? [];
        $permanent_js = $_POST['permanent_js'] ?? [];
        
        update_option('up_permanent_css', $permanent_css);
        update_option('up_permanent_js', $permanent_js);
        
        echo '<div class="notice notice-success"><p>Configuration sauvegardée !</p></div>';
    }
    
    // Récupérer la configuration actuelle
    $permanent_css = get_option('up_permanent_css', []);
    $permanent_js = get_option('up_permanent_js', []);
    
    // Récupérer tous les assets disponibles
    $assets = up_get_all_available_assets();
    ?>
    
    <div class="wrap">
        <h1>Gestion des Assets Permanents</h1>
        <p>Cochez les éléments CSS et JS qui doivent être chargés sur toutes les pages du site.</p>
        <div class="card" style="margin-top: 30px;">
            <h3>Informations</h3>
            <p><strong>CSS permanents :</strong> <?php echo count($permanent_css); ?> fichier(s) sélectionné(s)</p>
            <p><strong>JS permanents :</strong> <?php echo count($permanent_js); ?> fichier(s) sélectionné(s)</p>
            <p><em>Les fichiers cochés seront chargés sur toutes les pages du site, pas seulement quand les blocs correspondants sont présents.</em></p>
            <p><em>Ceci est utile pour les styles et scripts qui sont liés à des blocs présent dans le header ou dans le footer.</em></p>
        </div>
        <form method="post" action="">
            <?php wp_nonce_field('up_permanent_assets', 'up_nonce'); ?>
            
            <div style="display: flex; gap: 40px; margin-top: 20px;">
                
                <!-- Section CSS -->
                <div style="flex: 1;">
                    <h2>Fichiers CSS</h2>
                    <table class="wp-list-table widefat fixed striped">
                        <thead>
                            <tr>
                                <th style="width: 50px;">Charger</th>
                                <th>Fichier</th>
                                <th>Source</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($assets['css'])): ?>
                                <?php foreach ($assets['css'] as $slug => $files): ?>
                                    <?php foreach ($files as $file_info): ?>
                                        <?php $file_key = $slug . '|' . $file_info['file']; ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" 
                                                       name="permanent_css[]" 
                                                       value="<?php echo esc_attr($file_key); ?>"
                                                       <?php checked(in_array($file_key, $permanent_css)); ?>>
                                            </td>
                                            <td>
                                                <strong><?php echo esc_html(basename($file_info['file'])); ?></strong>
                                                <br><small><?php echo esc_html($file_info['url']); ?></small>
                                            </td>
                                            <td><?php echo esc_html($file_info['source']); ?></td>
                                            <td>
                                                <span class="dashicons dashicons-<?php echo $file_info['type']; ?>"></span>
                                                <?php echo ucfirst($file_info['type']); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4">Aucun fichier CSS trouvé</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Section JS -->
                <div style="flex: 1;">
                    <h2>Fichiers JavaScript</h2>
                    <table class="wp-list-table widefat fixed striped">
                        <thead>
                            <tr>
                                <th style="width: 50px;">Charger</th>
                                <th>Fichier</th>
                                <th>Source</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($assets['js'])): ?>
                                <?php foreach ($assets['js'] as $slug => $files): ?>
                                    <?php foreach ($files as $file_info): ?>
                                        <?php $file_key = $slug . '|' . $file_info['file']; ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" 
                                                       name="permanent_js[]" 
                                                       value="<?php echo esc_attr($file_key); ?>"
                                                       <?php checked(in_array($file_key, $permanent_js)); ?>>
                                            </td>
                                            <td>
                                                <strong><?php echo esc_html(basename($file_info['file'])); ?></strong>
                                                <br><small><?php echo esc_html($file_info['url']); ?></small>
                                            </td>
                                            <td><?php echo esc_html($file_info['source']); ?></td>
                                            <td>
                                                <span class="dashicons dashicons-<?php echo $file_info['type']; ?>"></span>
                                                <?php echo ucfirst($file_info['type']); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4">Aucun fichier JavaScript trouvé</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
            
            <p class="submit">
                <input type="submit" name="submit" class="button-primary" value="Sauvegarder la configuration">
            </p>
        </form>
        
 
    </div>
    
    <style>
    .wp-list-table th, .wp-list-table td {
        padding: 12px;
    }
    .wp-list-table small {
        color: #666;
        font-style: italic;
    }
    .dashicons {
        width: 16px;
        height: 16px;
        font-size: 16px;
    }
    .card {
        background: #fff;
        border: 1px solid #ccd0d4;
        border-radius: 4px;
        padding: 20px;
    }
    </style>
    <?php
}

// Fonction pour récupérer tous les assets disponibles
function up_get_all_available_assets() {
    $sources = apply_filters('up_style_sources', []);
    $assets = ['css' => [], 'js' => []];
    
    foreach ($sources as $source_index => $source) {
        $base_dir = $source['base_dir'] ?? '';
        $css_dir = $source['css_dir'] ?? $base_dir;
        $js_dir = $source['js_dir'] ?? $base_dir . '/assets/js';
        $trigger_ext = $source['trigger_ext'] ?? 'json';
        $load_ext = $source['load_ext'] ?? 'css';
        
        $source_name = !empty($source['name']) ? $source['name'] : "Source " . ($source_index + 1);
        
        // Récupérer les slugs depuis les triggers
        $trigger_path = get_template_directory() . '/' . untrailingslashit($base_dir) . '/';
        if (!is_dir($trigger_path)) continue;
        
        $trigger_files = glob($trigger_path . '*.' . $trigger_ext);
        $slugs = array_map(fn($p) => basename($p, '.' . $trigger_ext), $trigger_files);
        
        // CSS
        $css_path = get_template_directory() . '/' . untrailingslashit($css_dir) . '/';
        $css_url = get_template_directory_uri() . '/' . untrailingslashit($css_dir) . '/';
        
        if (is_dir($css_path)) {
            // Front CSS
            $front_files = glob($css_path . '*.front.' . $load_ext);
            foreach ($front_files as $file) {
                $slug = str_replace('.front.' . $load_ext, '', basename($file));
                if (in_array($slug, $slugs)) {
                    $assets['css'][$slug][] = [
                        'file' => $file,
                        'url' => $css_url . basename($file),
                        'source' => $source_name,
                        'type' => 'front'
                    ];
                }
            }
            
            // Neutral CSS
            $regular_files = array_filter(
                glob($css_path . '*.' . $load_ext),
                fn($f) => !str_contains(basename($f), '.editor.') && !str_contains(basename($f), '.front.')
            );
            foreach ($regular_files as $file) {
                $slug = basename($file, '.' . $load_ext);
                if (in_array($slug, $slugs)) {
                    $assets['css'][$slug][] = [
                        'file' => $file,
                        'url' => $css_url . basename($file),
                        'source' => $source_name,
                        'type' => 'neutral'
                    ];
                }
            }
        }
        
        // JavaScript
        $js_path = get_template_directory() . '/' . untrailingslashit($js_dir) . '/';
        $js_url = get_template_directory_uri() . '/' . untrailingslashit($js_dir) . '/';
        
        if (is_dir($js_path)) {
            // Front JS
            $front_files = glob($js_path . '*.front.js');
            foreach ($front_files as $file) {
                $slug = str_replace('.front.js', '', basename($file));
                if (in_array($slug, $slugs)) {
                    $assets['js'][$slug][] = [
                        'file' => $file,
                        'url' => $js_url . basename($file),
                        'source' => $source_name,
                        'type' => 'front'
                    ];
                }
            }
            
            // Neutral JS
            $neutre_files = array_filter(
                glob($js_path . '*.js'),
                fn($f) => !str_contains(basename($f), '.') || substr_count(basename($f), '.') === 1
            );
            foreach ($neutre_files as $file) {
                $slug = basename($file, '.js');
                if (in_array($slug, $slugs)) {
                    $assets['js'][$slug][] = [
                        'file' => $file,
                        'url' => $js_url . basename($file),
                        'source' => $source_name,
                        'type' => 'neutral'
                    ];
                }
            }
        }
    }
    
    return $assets;
}

// Fonction pour charger les assets permanents
function up_enqueue_permanent_assets() {
    $permanent_css = get_option('up_permanent_css', []);
    $permanent_js = get_option('up_permanent_js', []);
    
    // Charger CSS permanents
    foreach ($permanent_css as $file_key) {
        list($slug, $file_path) = explode('|', $file_key, 2);
        $file_url = str_replace(get_template_directory(), get_template_directory_uri(), $file_path);
        wp_enqueue_style('up-permanent-css-' . sanitize_title($slug . '-' . basename($file_path)), $file_url, [], '1.0');
    }
    
    // Charger JS permanents
    foreach ($permanent_js as $file_key) {
        list($slug, $file_path) = explode('|', $file_key, 2);
        $file_url = str_replace(get_template_directory(), get_template_directory_uri(), $file_path);
        wp_enqueue_script('up-permanent-js-' . sanitize_title($slug . '-' . basename($file_path)), $file_url, ['jquery'], '1.0', true);
    }
}

// Ajouter le chargement des assets permanents avec une priorité plus élevée
add_action('wp_enqueue_scripts', 'up_enqueue_permanent_assets', 5);

// Ajouter aussi les permanents dans l'éditeur si nécessaire
function up_enqueue_permanent_editor_assets() {
    $permanent_css = get_option('up_permanent_css', []);
    
    foreach ($permanent_css as $file_key) {
        list($slug, $file_path) = explode('|', $file_key, 2);
        $relative_path = str_replace(get_template_directory() . '/', '', $file_path);
        add_editor_style($relative_path);
    }
}
add_action('after_setup_theme', 'up_enqueue_permanent_editor_assets');

?>