# Documentation - Templates dans les thèmes FSE

## Dossier Templates

### Vue d'ensemble
Le dossier `/templates` contient les templates principaux de votre thème FSE. Ces fichiers définissent la structure des pages et déterminent comment le contenu est affiché selon le type de page (accueil, article, archive, etc.).

### Structure des fichiers

#### Extension et format
- **Extension** : `.html`
- **Emplacement** : Racine du dossier `/templates`
- **Format** : HTML avec blocs WordPress

#### Templates courants
- `index.html` - Template par défaut (obligatoire)
- `front-page.html` - Page d'accueil statique
- `home.html` - Page d'accueil des articles
- `single.html` - Articles individuels
- `page.html` - Pages statiques
- `archive.html` - Pages d'archives
- `404.html` - Page d'erreur 404
- `search.html` - Résultats de recherche

### Contenu des templates

Les templates contiennent des blocs WordPress et des inclusions de template parts :

```html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main"} -->
<main class="wp-block-group">
  <!-- wp:post-title {"level":1} /-->
  <!-- wp:post-content /-->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
```