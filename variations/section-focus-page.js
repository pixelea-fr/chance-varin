wp.domReady( function() {
    wp.blocks.registerBlockVariation(
        'core/group',
        {
            name: 'section-focus-page',
            title: 'Section Focus Page',
            description: '',
            keywords: ["up","pixelea","focus"],
            icon: "editor-ltr",
            category: 'media',
            attributes: {
    "metadata": {
        "name": "Section mise en avant | page link"
    },
    "className": "section-focus-page",
    "style": {
        "border": {
            "left": {
                "color": "var:preset|color|base-2",
                "width": "1px"
            }
        },
        "spacing": {
            "padding": {
                "left": "var:preset|spacing|2"
            },
            "blockGap": "var:preset|spacing|1"
        }
    },
    "layout": {
        "type": "constrained"
    }
},
            innerBlocks: [
    [
        "core/buttons",
        [],
        [
            [
                "core/button",
                {
                    "className": "is-style-core-button-with-arrows-no-border is-style-with-arrows-no-border"
                }
            ]
        ]
    ],
    [
        "core/paragraph",
        []
    ]
],
            example: { attributes: {
    "metadata": {
        "name": "Section mise en avant | page link"
    },
    "className": "section-focus-page",
    "style": {
        "border": {
            "left": {
                "color": "var:preset|color|base-2",
                "width": "1px"
            }
        },
        "spacing": {
            "padding": {
                "left": "var:preset|spacing|2"
            },
            "blockGap": "var:preset|spacing|1"
        }
    },
    "layout": {
        "type": "constrained"
    }
}, innerBlocks: [
    {
        "name": "core/buttons",
        "attributes": [],
        "innerBlocks": [
            {
                "name": "core/button",
                "attributes": {
                    "className": "is-style-core-button-with-arrows-no-border is-style-with-arrows-no-border",
                    "text": "Nos Locations"
                }
            }
        ]
    },
    {
        "name": "core/paragraph",
        "attributes": {
            "content": "Lorem ipsum dolor sit amet consectetur. Et eu metus tellus eget diam adipiscing feugiat natoque. Posuere mattis libero vulputate commodo purus"
        }
    }
] },
            scope: ["transform","inserter"]
        }
    );
});