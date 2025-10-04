<?php

defined('TYPO3') || die();

// Add static typoscript configuration
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'bp_gallery_settings',
    'Configuration/TypoScript/',
    'Gallery Setting for "Bootstrap Package"'
);
