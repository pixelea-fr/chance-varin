
# Doc ultra-simple – « quel fichier est chargé quand ? »

## 1. Fichiers possibles pour un même bloc/variation
*(même nom, ici `hero`)*

| Fichier | Rôle |
|---------|------|
| `hero.json` (ou `hero.js`) | ← déclencheur |
| `hero.front.css` | style **FRONT** |
| `hero.editor.css` | style **EDITEUR** |
| `hero.css` | style **PARTOUT** (front + éditeur) |

---

## 2. Règle en 1 phrase

- Si le bloc est utilisé dans la **page** → on charge `.front.css + .css`  
- Si le bloc est utilisé dans l’**éditeur** → on charge `.editor.css + .css`  
- Le fichier `.css` seul est toujours chargé (front ET éditeur)

---

## 3. Exemple rapide

| Fichiers présents | Front | Éditeur |
|------------------|-------|---------|
| `hero.front.css`  | ✅    | ❌      |
| `hero.editor.css` | ❌    | ✅      |
| `hero.css`        | ✅    | ✅      |

---

## 4. Options sources (minimum à copier)

```php
add_filter( 'up_style_sources', function ( $sources ) {
    $sources[] = [
        'base_dir'    => 'style/sections',   // où sont les .json / .js
        'css_dir'     => 'assets/css/sections',   // où sont les .css (optionnel)
        'trigger_ext' => 'json',          // json ou js
        'load_ext'    => 'css',           // css ou js
    ];
    return $sources;
} );
````

---

## 5. Utilisation

1. Mets ton déclencheur (`hero.json`) dans `mon-dossier`.
2. Mets tes CSS dans le même dossier (ou dans `css_dir`).
3. Active la source via le filtre ci-dessus.

C’est tout : WordPress charge automatiquement les bons fichiers quand le bloc est utilisé.

---

## Récap :

* `.front.css` → front uniquement
* `.editor.css` → éditeur uniquement
* `.css` → partout
* **même nom = même bloc/variation → automatique**

