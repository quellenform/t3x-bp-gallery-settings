<?php

defined('TYPO3') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tx_bootstrappackage_tab_item',
    [
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
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'default' => 0
            ]
        ],
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
        ]
    ]
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'tx_bootstrappackage_tab_item',
    'mediaposition',
    'gallery_width,'
        . 'gallery_ratio,'
        . 'imageshape,',
    'before:image_zoom'
);

$GLOBALS['TCA']['tx_bootstrappackage_tab_item']['columns']['mediaorient']['config']['items'] = [
    [
        'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.0',
        //'value' => 0,
        'value' => 'top',
        'icon' => 'content-beside-text-img-above-center',
    ],
    [
        'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.3',
        //'value' => 8,
        'value' => 'bottom',
        'icon' => 'content-beside-text-img-below-center',
    ],
    [
        'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.6',
        //'value' => 17,
        'value' => 'intext_right',
        'icon' => 'content-inside-text-img-right',
    ],
    [
        'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.7',
        //'value' => 18,
        'value' => 'intext_left',
        'icon' => 'content-inside-text-img-left',
    ],
    [
        'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.9',
        //'value' => 25,
        'value' => 'right',
        'icon' => 'content-beside-text-img-right',
    ],
    [
        'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.10',
        //'value' => 26,
        'value' => 'left',
        'icon' => 'content-beside-text-img-left',
    ],
    [
        'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.imageorient.125',
        //'value' => 125,
        'value' => 'centered_right',
        'icon' => 'content-bootstrappackage-beside-text-img-centered-right',
    ],
    [
        'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.imageorient.126',
        //'value' => 126,
        'value' => 'centered_left',
        'icon' => 'content-bootstrappackage-beside-text-img-centered-left',
    ],
];
$GLOBALS['TCA']['tx_bootstrappackage_tab_item']['columns']['mediaorient']['config']['fieldWizard'] = [
    'selectIcons' => [
        'disabled' => false,
    ]
];

$GLOBALS['TCA']['tx_bootstrappackage_tab_item']['columns']['mediaorient']['config']['default'] = 'left';
