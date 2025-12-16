# Architecture du Thème ng1-base-2026

Ce document décrit l'organisation des dossiers et fichiers du thème. C'est un thème **Full Site Editing (FSE)** basé sur des blocs.

## 📂 Racine du thème

- **`style.css`** : Déclaration principale du thème (Nom, Version, Auteur). Contient aussi le CSS global compilé.
- **`theme.json`** : Le cœur de la configuration FSE (palette de couleurs, typographie, réglages des blocs, mises en page par défaut).
- **`functions.php`** : Point d'entrée PHP. Il charge automatiquement les fichiers du dossier `functions/`.
- **`screenshot.png`** : Image de prévisualisation du thème dans l'admin WordPress.

## 📂 assets/
Ressources statiques du thème (sources et fichiers compilés).

- **`scss/`** : Sources Sass.
  - `style.scss` : Fichier maître qui importe tout (via `@use`).
  - `_index.scss` : Point central pour `@forward` les mixins/variables.
  - `blocks/` : Styles spécifiques pour chaque bloc.
- **`js/`** : Scripts JavaScript.
- **`fonts/`, `images/`, `icons/`** : Médias et typographies.

## 📂 functions/
Logique PHP découpée en petits fichiers pour plus de clarté.

- **`enqueue-*.php`** : Chargement des scripts et styles (CSS/JS).
- **`cpt/`** : Déclaration des Custom Post Types.
- **`taxonomy/`** : Déclaration des Taxonomies personnalisées.
- **`no-cache.php`**, **`remove-core-patterns.php`** : Utilitaires divers.

## 📂 templates/
Modèles de pages complets (FSE).

- **`index.html`** : Modèle par défaut.
- **`archive.html`** : Modèle pour les archives (catégories, tags...).
- _Note : Ces fichiers sont en HTML et contiennent le balisage des blocs WordPress._

## 📂 parts/
Composants réutilisables dans les templates (Template Parts).

- **`header.html`**, **`footer.html`** : Entête et pied de page globaux.
- **`sidebar.html`** : Barre latérale.
- **`query-loop-*.html`** : Modèles pour l'affichage des boucles d'articles.

## 📂 styles/ & variations/
Dossiers spécifiques au Full Site Editing.

- **`styles/`** : Variations de styles globales (JSON) sélectionnables dans l'éditeur de site (ex: mode sombre, alternatif...).
- **`variations/`** : Variations de styles pour des blocs spécifiques.
