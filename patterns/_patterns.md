# Documentation - Patterns dans les thèmes FSE

## Dossier Patterns

### Vue d'ensemble
Le dossier `/patterns` contient des patterns de blocs personnalisés. Ces patterns sont des arrangements prédéfinis de blocs qui peuvent être insérés facilement dans les contenus.

### Structure des fichiers

#### Extension et format
- **Extension** : `.php`
- **Emplacement** : Racine du dossier `/patterns`
- **Format** : PHP avec en-tête de déclaration

### Déclaration d'un pattern

Chaque fichier pattern doit commencer par un en-tête de déclaration :

```php
<?php
/**
 * Title: Mon Pattern Héro
 * Slug: mon-theme/hero-pattern
 * Description: Un pattern héro avec titre et boutons
 * Categories: hero, featured
 * Keywords: hero, banner, cta
 * Viewport Width: 1400
 * Block Types: core/group, core/cover
 * Post Types: page, post
 * Template Types: front-page, single-post
 * Inserter: true
 */
?>

<!-- wp:group {"align":"full"} -->
<div class="wp-block-group alignfull">
  <!-- wp:heading {"level":1} -->
  <h1>Mon titre héro</h1>
  <!-- /wp:heading -->
  
  <!-- wp:buttons -->
  <div class="wp-block-buttons">
    <!-- wp:button -->
    <div class="wp-block-button">
      <a class="wp-block-button__link">Mon bouton</a>
    </div>
    <!-- /wp:button -->
  </div>
  <!-- /wp:buttons -->
</div>
<!-- /wp:group -->
```

## Propriétés des en-têtes de patterns

### Propriétés obligatoires

- **Title** : Titre lisible du pattern
- **Slug** : Identifiant unique au format `namespace/nom`

### Propriétés optionnelles

#### **Description**
Description du pattern (non visible mais utile pour la recherche)
```php
Description: Un layout en deux colonnes avec image et texte
```

#### **Categories** 
Catégories pour organiser les patterns dans l'interface
```php
Categories: header, hero, featured, gallery, text, buttons
```

**Catégories disponibles par défaut :**
- `header` - En-têtes
- `footer` - Pieds de page  
- `hero` - Sections héro/bannières
- `featured` - Contenus mis en avant
- `gallery` - Galeries d'images
- `text` - Contenus textuels
- `buttons` - Boutons et appels à l'action
- `columns` - Layouts en colonnes
- `testimonials` - Témoignages
- `pricing` - Tableaux de prix
- `contact` - Formulaires de contact

#### **Keywords**
Mots-clés pour améliorer la recherche
```php
Keywords: hero, banner, cta, call to action, accueil
```

#### **Viewport Width**
Largeur d'affichage pour l'aperçu (en pixels)
```php
Viewport Width: 1400
```

#### **Block Types**
Types de blocs avec lesquels le pattern peut être utilisé
```php
Block Types: core/group, core/cover, core/columns
```

**Exemples de block types courants :**
- `core/group` - Groupes
- `core/columns` - Colonnes
- `core/cover` - Couvertures
- `core/heading` - Titres
- `core/paragraph` - Paragraphes
- `core/button` - Boutons
- `core/image` - Images
- `core/template-part/header` - Template part header
- `core/template-part/footer` - Template part footer

#### **Post Types**
Types de contenu où le pattern est disponible
```php
Post Types: page, post, product
```

#### **Template Types**
Types de templates où le pattern est pertinent
```php
Template Types: front-page, single-post, archive, 404
```

#### **Inserter**
Visibilité dans l'interface d'insertion (true/false)
```php
Inserter: true
```

## Patterns dans theme.json

### Inclusion de patterns externes
Vous pouvez inclure des patterns du répertoire WordPress.org :

```json
{
  "version": 2,
  "patterns": [
    "hero-banner-with-overlap-images",
    "fullscreen-cover-image-gallery",
    "mixed-shape-gallery"
  ]
}
```

### Patterns sémantiques
Les patterns peuvent être marqués comme "header" ou "footer" pour les template parts :

```php
/**
 * Title: Mon Header Personnalisé
 * Categories: header
 * Block Types: core/template-part/header
 */
```

## Bonnes pratiques

### Organisation
1. **Nommage cohérent** : Utilisez des slugs descriptifs `mon-theme/nom-pattern`
2. **Catégorisation** : Assignez les patterns aux bonnes catégories
3. **Documentation** : Ajoutez toujours une description claire

### Performance
1. **Viewport Width** : Définissez une largeur appropriée pour l'aperçu
2. **Blocs optimisés** : Utilisez les blocs les plus adaptés
3. **Images** : Optimisez les images utilisées dans les patterns

### Accessibilité
1. **Structure sémantique** : Utilisez les bons niveaux de titres
2. **Contrastes** : Vérifiez les contrastes de couleurs
3. **Textes alternatifs** : Ajoutez des descriptions aux images

### Réutilisabilité
1. **Contenu générique** : Évitez les contenus trop spécifiques
2. **Flexibilité** : Permettez la personnalisation facile
3. **Compatibilité** : Testez avec différents types de contenu