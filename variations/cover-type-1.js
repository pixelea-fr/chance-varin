wp.domReady( function() {
    wp.blocks.registerBlockVariation(
        'core/cover',
        {
            name: 'cover-type-1',
            title: 'cover-type-1',
            description: 'Bannière de type 1',
            keywords: ["pixelea","ng1","up","banner","cover","bannière"],
            icon: wp.element.createElement('span', { dangerouslySetInnerHTML: { __html: "<svg stroke-linejoin=\"round\"  stroke-linecap=\"round\"  viewBox=\"0 0 24 24\"  fill=\"currentColor\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\">\n <g id=\"style=fill\" transform=\"translate(44.263 .18533)\">\n  <g id=\"attach\">\n   <path d=\"m-42.147 4.6197c-0.80878 0-1.4599 0.65114-1.4599 1.4599v12.107c0 0.80878 0.65108 1.4599 1.4599 1.4599h19.489c0.80878 0 1.4599-0.65114 1.4599-1.4599v-12.107c0-0.80878-0.65114-1.4599-1.4599-1.4599h-19.489zm4.0878 5.8404h11.314c0.3509 0 0.6334 0.2825 0.6334 0.6334v1.6162c0 0.3509-0.2825 0.6334-0.6334 0.6334h-11.314c-0.3509 0-0.6334-0.2825-0.6334-0.6334v-1.6162c0-0.3509 0.2825-0.6334 0.6334-0.6334z\" fill=\"currentColor\" fill-rule=\"evenodd\" stroke-width=\".024566\" />\n  </g>\n </g>\n</svg>" } }),
            category: 'media',
            attributes: {
    "url": "https://chance-varin.local/wp-content/uploads/2026/01/Photo-interieur-1024x683.jpeg",
    "id": 316,
    "alt": "Photo intérieur du cabinet",
    "dimRatio": 0,
    "isUserOverlayColor": true,
    "focalPoint": {
        "x": 0.48999999999999999,
        "y": 0
    },
    "minHeight": 600,
    "isDark": false,
    "sizeSlug": "large",
    "align": "full",
    "className": "is-style-style5 cover-type-1",
    "style": {
        "color": {
            "duotone": "var:preset|duotone|blanc-noir"
        },
        "spacing": {
            "blockGap": "var:preset|spacing|2",
            "padding": {
                "right": "var:preset|spacing|2",
                "left": "var:preset|spacing|2",
                "top": "var:preset|spacing|8",
                "bottom": "var:preset|spacing|8"
            }
        }
    },
    "layout": {
        "type": "constrained",
        "contentSize": "760px"
    },
    "allowedBlocks": [
        "core/paragraph",
        "core/heading",
        "core/freeform"
    ]
},
            innerBlocks: [
    [
        "core/post-title",
        {
            "textAlign": "center",
            "level": 1,
            "style": {
                "typography": {
                    "lineHeight": "1.25"
                }
            },
            "fontSize": "xxl-b"
        }
    ],
    [
        "core/paragraph",
        {
            "align": "center",
            "placeholder": "Texte Banière",
            "metadata": {
                "name": "Intro"
            }
        }
    ]
],
            example: { attributes: {
    "url": "https://chance-varin.local/wp-content/uploads/2026/01/Photo-interieur-1024x683.jpeg",
    "id": 316,
    "alt": "Photo intérieur du cabinet",
    "dimRatio": 0,
    "isUserOverlayColor": true,
    "focalPoint": {
        "x": 0.48999999999999999,
        "y": 0
    },
    "minHeight": 600,
    "isDark": false,
    "sizeSlug": "large",
    "align": "full",
    "className": "is-style-style5 cover-type-1",
    "style": {
        "color": {
            "duotone": "var:preset|duotone|blanc-noir"
        },
        "spacing": {
            "blockGap": "var:preset|spacing|2",
            "padding": {
                "right": "var:preset|spacing|2",
                "left": "var:preset|spacing|2",
                "top": "var:preset|spacing|8",
                "bottom": "var:preset|spacing|8"
            }
        }
    },
    "layout": {
        "type": "constrained",
        "contentSize": "760px"
    },
    "allowedBlocks": [
        "core/paragraph",
        "core/heading",
        "core/freeform"
    ]
}, innerBlocks: [
    {
        "name": "core/post-title",
        "attributes": {
            "textAlign": "center",
            "level": 1,
            "style": {
                "typography": {
                    "lineHeight": "1.25"
                }
            },
            "fontSize": "xxl-b"
        }
    },
    {
        "name": "core/paragraph",
        "attributes": {
            "align": "center",
            "placeholder": "Texte Banière",
            "metadata": {
                "name": "Intro"
            },
            "content": "Lorem ipsum dolor sit amet consectetur. Et eu metus tellus eget diam adipiscing feugiat natoque. Posuere mattis libero vulputate commodo purus. Adipiscing eu faucibus nec massa. Cursus sit dis magna a tellus duis. Tincidunt cursus mi interdum ultrices ultrices malesuada risus dolor non."
        }
    }
] },
            scope: ["block","inserter","transform"]
        }
    );
});