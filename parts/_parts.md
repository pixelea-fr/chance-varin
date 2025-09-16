# Documentation - Dossier Parts d'un thème FSE

## Vue d'ensemble

Le dossier `parts/` contient les parties de template réutilisables d'un thème Full Site Editing (FSE) WordPress. Ces fichiers permettent de modulariser les composants du thème pour une meilleure organisation et réutilisabilité.

## Structure des fichiers

### Extension et format
- **Extension** : `.html`
- **Emplacement** : Racine du dossier `parts/`
- **Format** : HTML avec patterns WordPress

### Utilisation dans les templates

Les fichiers parts peuvent être appelés dans différentes parties de templates, notamment :
- `index.html`
- `page.html`
- Tout autre template du thème

### Édition en back-office

Ces fichiers sont **éditables directement depuis l'interface d'administration WordPress**, permettant aux utilisateurs de personnaliser les parties de template sans accéder au code.

## Intégration des patterns

Dans les fichiers parts, on utilise des patterns WordPress via la syntaxe suivante :

```html
<!-- wp:pattern {"slug":"ng1-base/header"} /-->
```
## Intégration dans les templates


```html
<!-- wp:template-part {"slug":"header"} /-->
```
```html
<!-- wp:template-part {"slug":"ng1-base/header-fixed"} /-->
```
```html
<!-- wp:template-part {"slug":"footer"} /-->
```

Cette syntaxe permet d'intégrer des patterns prédéfinis dans les parties de template.

## Configuration dans theme.json

### Affichage automatique
Les fichiers présents dans le dossier `parts/` sont automatiquement détectés par WordPress.

### Personnalisation des libellés
Pour modifier l'affichage du nom des template parts dans l'interface d'administration, ajoutez-les dans la section `templateParts` du fichier `theme.json` :

```json
{
  "templateParts": [
    {
      "area": "header",
      "name": "header",
      "title": "Header"
    },
    {
      "area": "header",
      "name": "vertical-header",
      "title": "Vertical site header"
    }
  ]
}
```

### Cas particuliers
- **Header et Footer** : Bien que non obligatoires techniquement, ces template parts sont standards pour la plupart des sites web
- **Autres parts** : Peuvent fonctionner sans être listés dans `theme.json`, mais l'enregistrement améliore l'expérience utilisateur
- **Dossier alternatif** : WordPress reconnaît aussi le dossier `/template-parts` pour la rétrocompatibilité

## Bonnes pratiques

1. **Nommage** : Utilisez des noms descriptifs pour vos fichiers parts
2. **Organisation** : Gardez une structure logique dans le dossier `parts/`
3. **Documentation** : Commentez vos patterns pour faciliter la maintenance
4. **Test** : Vérifiez toujours le bon fonctionnement des parts dans l'éditeur WordPress