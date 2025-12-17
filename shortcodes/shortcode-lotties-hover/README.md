# Shortcode Lottie Hover

Ce shortcode permet d'afficher une animation Lottie (.json) qui se joue au survol de la souris (hover). Il gère également la lecture inversée (reverse) lorsque la souris quitte l'élément, ainsi que d'autres options de lecture.

## Utilisation de base

Le paramètre `src` est obligatoire.

```shortcode
[lottie_hover src="mon-animation.json"]
```

Si le fichier JSON se trouve dans le dossier `assets/lotties/` de votre thème, vous pouvez simplement indiquer le nom du fichier. Le chemin complet sera généré automatiquement.

Si vous souhaitez utiliser une URL externe ou absolue, c'est également possible :

```shortcode
[lottie_hover src="https://assets10.lottiefiles.com/packages/lf20_w51pcehl.json"]
```

## Paramètres disponibles

| Paramètre       | Description                                                                 | Valeur par défaut |
| :-------------- | :-------------------------------------------------------------------------- | :---------------- |
| `src`           | Chemin du fichier JSON (relatif à `theme/assets/lotties/` ou URL absolue).  | `''` (vide)       |
| `width`         | Largeur du conteneur en pixels. Ignoré si `full_width="true"`.              | `200`             |
| `height`        | Hauteur du conteneur en pixels. Ignoré si `full_width="true"`.              | `200`             |
| `speed`         | Vitesse de lecture (1 = normale, 2 = 2x, etc.).                             | `1`               |
| `reverse`       | Si `true`, joue à l'envers quand on quitte le survol (trigger hover).       | `true`            |
| `loop`          | Si `true`, l'animation boucle indéfiniment.                                 | `false`           |
| `autoplay`      | Si `true`, l'animation démarre toute seule au chargement.                   | `false`           |
| `class`         | Classes CSS à ajouter au conteneur.                                         | `''`              |
| `id`            | ID CSS à ajouter au conteneur.                                              | `''`              |
| `link`          | URL vers laquelle pointer si on clique sur l'animation.                     | `''`              |
| `hover_trigger` | Sélecteur CSS de l'élément qui déclenche le survol (ex: `.card`).           | `''` (lui-même)   |
| `persist_end`   | Si `true`, l'animation reste sur la dernière image à la fin (trigger hover).| `true`            |
| `trigger`       | Mode de déclenchement : `hover` ou `scroll`.                                | `hover`           |
| `full_width`    | Si `true`, le conteneur prend 100% de la largeur disponible.                | `false`           |

## Exemples avancés

### Animation avec déclencheur externe

Vous pouvez déclencher l'animation en survolant un autre élément (par exemple, le parent `.mon-card`).

```shortcode
<div class="mon-card">
  <h3>Titre de la carte</h3>
  [lottie_hover src="icon.json" hover_trigger=".mon-card"]
</div>
```

### Animation avec lien et classe CSS personnalisée

```shortcode
[lottie_hover src="icon-home.json" link="https://mon-site.com/accueil" class="my-custom-icon"]
```

### Animation rapide avec lecture inversée

```shortcode
[lottie_hover src="logo.json" width="150" height="150" speed="2" reverse="true"]
```

### Animation en boucle (sans interaction hover)

Pour une animation qui tourne en boucle sans attendre le survol :

```shortcode
[lottie_hover src="loader.json" loop="true" autoplay="true"]
```

## Fonctionnement technique

1.  **PHP** : Le shortcode (`shortcode-lotties-hover.php`) génère un conteneur `div` avec des attributs `data-*` correspondants aux paramètres.
2.  **JS** : Le script `assets/js/lottie-hover.js` est chargé (avec la librairie `lottie-web` en dépendance). Il parcourt tous les conteneurs `.lottie-hover-container`, initialise les animations Lottie et attache les écouteurs d'événements (`mouseenter`/`mouseleave`) selon la configuration.
