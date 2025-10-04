<?php

defined('TYPO3') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tt_content',
    [
        'imageshape' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.imageshape',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.default_value',
                        'value' => 0
                    ],
                    [
                        'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.imageshape.I.1',
                        'value' => 1
                    ],
                    [
                        'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.imageshape.I.2',
                        'value' => 2
                    ],
                    [
                        'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.imageshape.I.3',
                        'value' => 3
                    ],
                    [
                        'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.imageshape.I.4',
                        'value' => 4
                    ]
                ]
            ]
        ],
        'gallery_width' => [
            'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.gallery_width',
            'exclude' => true,
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.default_value',
                        'value' => 0
                    ],
                    [
                        'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.gallery_width.I.1',
                        'value' => 1
                    ],
                    [
                        'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.gallery_width.I.2',
                        'value' => 2
                    ],
                    [
                        'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.gallery_width.I.3',
                        'value' => 3
                    ],
                    [
                        'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.gallery_width.I.4',
                        'value' => 4
                    ],
                    [
                        'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.gallery_width.I.5',
                        'value' => 5
                    ],
                    [
                        'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.gallery_width.I.6',
                        'value' => 6
                    ],
                    [
                        'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.gallery_width.I.7',
                        'value' => 7
                    ]
                ],
                'default' => 0
            ]
        ],
        'gallery_ratio' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.gallery_ratio.I.2',
            /*
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.default_value',
                        'value' => 0
                    ],
                    [
                        'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.gallery_ratio.I.1',
                        'value' => 1
                    ],
                    [
                        'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.gallery_ratio.I.2',
                        'value' => 2
                    ],
                    [
                        'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.gallery_ratio.I.3',
                        'value' => 3
                    ],
                    [
                        'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.gallery_ratio.I.4',
                        'value' => 4
                    ],
                    [
                        'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.gallery_ratio.I.5',
                        'value' => 5
                    ]
                ],
                'default' => 0
            ]
            */
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'default' => 0
            ]
        ],
        'gallery_carousel' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.gallery_carousel',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:lang/locallang_common.xlf:disabled',
                        'value' => 0
                    ],
                    [
                        'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.gallery_carousel.I.1',
                        'value' => 1
                    ],
                    [
                        'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.gallery_carousel.I.2',
                        'value' => 2
                    ],
                    [
                        'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.gallery_carousel.I.3',
                        'value' => 3
                    ],
                    [
                        'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.gallery_carousel.I.4',
                        'value' => 4
                    ]
                ]
            ]
        ],
        'gallery_nowrap' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bp_gallery_settings/Resources/Private/Language/locallang_db.xlf:tt_content.gallery_nowrap',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
            ],
        ],
    ]
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'tt_content',
    'gallerySettingsExtended',
    'gallery_width,'
        . 'gallery_ratio,'
        . 'gallery_carousel,'
        . 'imageshape,'
        . 'gallery_nowrap,'
);

$GLOBALS['TCA']['tt_content']['types']['textpic']['showitem']
    = str_replace(
        '--palette--;;gallerySettings',
        '--palette--;;gallerySettings,--palette--;;gallerySettingsExtended',
        $GLOBALS['TCA']['tt_content']['types']['textpic']['showitem']
    );
$GLOBALS['TCA']['tt_content']['types']['textmedia']['showitem']
    = str_replace(
        '--palette--;;gallerySettings',
        '--palette--;;gallerySettings,--palette--;;gallerySettingsExtended',
        $GLOBALS['TCA']['tt_content']['types']['textmedia']['showitem']
    );

$GLOBALS['TCA']['tt_content']['columns']['imageorient']['config']['items'] = [
    [
        'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.0',
        'value' => 0,
        'icon' => 'content-beside-text-img-above-center',
    ],
    [
        'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.3',
        'value' => 8,
        'icon' => 'content-beside-text-img-below-center',
    ],
    [
        'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.6',
        'value' => 17,
        'icon' => 'content-inside-text-img-right',
    ],
    [
        'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.7',
        'value' => 18,
        'icon' => 'content-inside-text-img-left',
    ],
    [
        'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.9',
        'value' => 25,
        'icon' => 'content-beside-text-img-right',
    ],
    [
        'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.10',
        'value' => 26,
        'icon' => 'content-beside-text-img-left',
    ],
    [
        'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.imageorient.125',
        'value' => 125,
        'icon' => 'content-bootstrappackage-beside-text-img-centered-right',
    ],
    [
        'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.imageorient.126',
        'value' => 126,
        'icon' => 'content-bootstrappackage-beside-text-img-centered-left',
    ],
];
