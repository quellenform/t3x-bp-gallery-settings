<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Gallery Settings',
    'description' => 'Gallery Settings for Bootstrap Package',
    'category' => 'fe',
    'state' => 'alpha',
    'clearcacheonload' => true,
    'author' => 'Stephan Kellermayr',
    'author_email' => 'typo3@quellenform.at',
    'author_company' => 'Kellermayr KG',
    'version' => '0.0.2',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-13.9.99'
        ],
        'conflicts' => [],
        'suggests' => []
    ]
];
