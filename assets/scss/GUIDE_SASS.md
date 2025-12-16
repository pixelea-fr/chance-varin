# Guide Sass : @use, @forward et as *

Ce guide explique simplement comment organiser vos fichiers Sass moderne (sans `@import`).

## 1. @use : Charger un fichier
C'est la nouvelle façon d'importer un fichier. Par défaut, **`@use` protège vos variables et mixins** en les mettant dans un "namespace" (un préfixe).

**Exemple :**
Si vous avez un fichier `_mixins.scss` :
```scss
// _mixins.scss
@mixin m($size) { ... }
```

Et que vous l'appelez dans un autre fichier :
```scss
@use 'mixins';

.element {
    // ❌ Erreur : m() n'est pas connu directement
    // @include m(600); 

    // ✅ Correct : il faut utiliser le nom du fichier comme préfixe
    @include mixins.m(600); 
}
```

---

## 2. as * : Enlever le préfixe
C'est ce que vous utilisez pour simplifier l'écriture. `as *` dit à Sass : *"Charge tout ce fichier et mets-le directement à disposition, sans préfixe"*.

**Exemple (votre cas) :**
```scss
@use 'mixins' as *;

.element {
    // ✅ Plus besoin de 'mixins.', on peut l'utiliser directement comme avant
    @include m(600); 
}
```
> **Note :** C'est très pratique pour les mixins et fonctions utilitaires que vous utilisez partout.

---

## 3. @forward : Le "Passe-plat"
`@forward` sert à créer des fichiers d'index (comme votre `_index.scss`). Il ne charge pas le code pour l'utiliser *dans* le fichier actuel, il le **transmet** à celui qui appellera ce fichier.

**Votre structure actuelle :**

1.  **`_mixins.scss`** : Contient les définitions (`@mixin m`, `@function px`...).
2.  **`_index.scss`** : Sert de point central.
    ```scss
    // _index.scss
    @forward 'mixins'; 
    // Cela veut dire : "Quiconque charge '_index.scss' aura accès à tout ce qu'il y a dans 'mixins'"
    ```
3.  **Dans vos blocs (ex: `_is-style-section.scss`)** :
    ```scss
    // Au lieu d'aller chercher '../../mixins', on charge l'index
    @use '../../index' as *; 
    
    // Grâce au @forward dans l'index, on a accès aux mixins ici
    @include m(600) { ... }
    ```

## Résumé pour votre projet

*   **Dans `style.scss`** (le fichier racine) :
    Utilisez `@use` pour charger vos partiels finaux qui génèrent du CSS.
    ```scss
    @use 'blocks/root'; // Charge le CSS des blocs
    ```

*   **Dans `_index.scss`** (le fichier central) :
    Utilisez `@forward` pour regrouper vos outils (mixins, variables, fonctions).
    ```scss
    @forward 'mixins';
    @forward 'variables'; // Si vous en avez
    ```

*   **Dans un composant** (ex: `blocks/core-group/_is-style-section.scss`) :
    Utilisez `@use ... as *` pour récupérer vos outils sans préfixe.
    ```scss
    @use '../../index' as *; // Remonte de 2 dossiers pour trouver l'index
    ```
