<?php

declare(strict_types=1);

namespace Quellenform\BpGallerySettings\DataProcessing;

/*
 * This file is part of the "bp_gallery_settings" Extension for TYPO3 CMS.
 *
 * Conceived and written by Stephan Kellermayr
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

final class ImageProcessor implements DataProcessorInterface
{
    /**
     * The content element's data.
     *
     * @var array
     */
    private $pData;

    /**
     * Storage for the processed data.
     *
     * @var array
     */
    private $imageConfig = [
        'parentClass' => '',
        'galleryClass' => '',
        'imgClass' => '',
        'noWrap' => false,
        'multiplier' => [],
        'gutters' => []
    ];

    /**
     * A tidied-up version of the relevant part of the processorConfiguration.
     *
     * @var array
     */
    private $settings = [];

    /**
     * The variants registered for processing.
     *
     * @var array
     */
    private $variants = [];

    /**
     * The type of the current content element.
     *
     * @var string|null
     */
    private $CType = null;

    /**
     * Process data
     *
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     * @return array the processed data as key/value store
     */
    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ) {
        if (isset($processorConfiguration['if.']) && !$cObj->checkIf($processorConfiguration['if.'])) {
            return $processedData;
        }
        if (!$this->prepareEnvironment($contentObjectConfiguration, $processorConfiguration, $processedData)) {
            return $processedData;
        }

        $orientation = $this->getOrientation();
        if (!empty($orientation)) {
            $this->setOrientation($orientation);
            $this->calculateColumns($orientation);
        }

        $this->setImageShape();
        $this->setGalleryCarousel($processedData);
        $this->setGalleryWrap();
        $this->storeImageConfig($cObj, $processorConfiguration, $processedData);

        return $processedData;
    }

    /**
     * Calculate gallery column (ratio between text and image).
     *
     * @param string $orientation
     *
     * @return void
     */
    private function calculateColumns(string $orientation): void
    {
        $isAboveBelow = ($orientation === 'top' || $orientation === 'bottom');

        // Set default gallery width
        $galleryWidth = $this->pData['gallery_width'] ?? 0;
        if (!$isAboveBelow && empty($galleryWidth)) {
            $galleryWidth = $this->settings['defaultWidth'] ?? 4;
        }
        // Get width from 'widthMap'
        $widthValue = $this->getMappedValue(
            $this->settings['widthMap'] ?? [],
            $galleryWidth
        );
        // Get column multiplier from 'resolutionMap'
        $columnMultiplier = (int) $this->getMappedValue(
            $this->valuesToArray($this->settings['resolutionMap'] ?? ''),
            $widthValue,
            null
        );

        if ($columnMultiplier) {
            $multiplierKeys = $this->getMultiplierKeys($orientation);
            $multiplier = $this->getMultiplier($columnMultiplier);
            $gutters = $isAboveBelow ? '' : $this->getGutters();

            $this->setVariants($multiplierKeys, $multiplier, $gutters);
            if ((bool) $this->pData['gallery_ratio'] ?? false) {
                $this->setVariants(['small', 'extrasmall'], $multiplier, $gutters);
                $this->addCssClass('gallery-keep-allocation');
            }
            $this->addCssClass('gallery-size-' . $widthValue);
        }
    }

    /**
     * Determine type of the current content element.
     *
     * @param string|null $CType
     *
     * @return string|null
     */
    private function determineCType(string $CType = null): string|null
    {
        if (empty($CType)) {
            $CType = $this->pData['CType'] ?? null;
        }
        if ($CType) {
            return $this->checkAllowedCType($CType);
        }
        return null;
    }

    /**
     * Check whether the current CE is contained in the array of allowed CTypes.
     *
     * @param string|null $CType
     *
     * @return string|null
     */
    private function checkAllowedCType(string $CType = null): string|null
    {
        $allowedCTypes = GeneralUtility::trimExplode(',', $this->settings['allowedCTypes'] ?? [], true);
        if (in_array($CType, $allowedCTypes)) {
            return $CType;
        }
        return null;
    }

    /**
     * Basic checks and prepare variables.
     *
     * @param array $contentObjectConfiguration
     * @param array $processorConfiguration
     * @param array $processedData
     *
     * @return bool
     */
    private function prepareEnvironment(
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ): bool {
        $this->pData = $processedData['data'];
        if (!(count($processorConfiguration) > 0)) {
            return false;
        } else {
            $this->settings = GeneralUtility::removeDotsFromTS($processorConfiguration);
        }
        $this->CType = $this->determineCType($processorConfiguration['CType'] ?? null);
        if (!$this->CType) {
            return false;
        }
        $this->variants = GeneralUtility::removeDotsFromTS(
            $contentObjectConfiguration['settings.']['responsiveimages.']['contentelements.'][$this->CType . '.'] ?? []
        );
        return true;
    }

    /**
     * Get the keys from the array that was originally defined for the respective content element.
     *
     * @param string $orientation
     *
     * @return array
     */
    private function getMultiplierKeys(string $orientation): array
    {
        $multiplier = $this->variants[$orientation]['multiplier'] ?? [];
        if (is_array($multiplier) && count($multiplier) > 0) {
            $multiplierKeys = array_keys($multiplier);
        } else {
            $multiplierKeys = [
                'default',
                'xlarge',
                'large',
                'medium'
            ];
        }
        return $multiplierKeys;
    }

    /**
     * Get the final value for multipliers.
     *
     * @param int $columnMultiplier
     *
     * @return string
     */
    private function getMultiplier(int $columnMultiplier): string
    {
        return (string) round((100 / 36 * (int) $columnMultiplier / 100), 12);
    }

    /**
     * Get the final value for gutters.
     * The value defined in TypoScript is used directly here, which may have been defined
     * with a unit of measurement (px), but only the integer value is returned here.
     *
     * @return string
     */
    private function getGutters(): string
    {
        return (string) (int) ($this->settings['gridGutterWidth'] ?? 40);
    }

    /**
     * Add CSS classes to a specific variable so that it can be added to the Fluid template later.
     *
     * @param string $cssClass
     * @param string $scope
     *
     * @return void
     */
    private function addCssClass(
        string $cssClass = '',
        string $scope = 'galleryClass'
    ): void {
        if (!empty($cssClass)) {
            if (empty($this->imageConfig[$scope])) {
                $this->imageConfig[$scope] = $cssClass;
            } else {
                $this->imageConfig[$scope] .= ' ' . $cssClass;
            }
        }
    }

    /**
     * Iterate through an array of variants and set the required values.
     *
     * @param array $keys
     * @param string $multiplier
     * @param string $gutters
     *
     * @return void
     */
    private function setVariants(
        array $keys,
        string $multiplier,
        string $gutters
    ): void {
        foreach ($keys as $key) {
            $this->setVariantItem('multiplier', $key, $multiplier);
            $this->setVariantItem('gutters', $key, $gutters);
        }
    }

    /**
     * Set the variants of a gallery element so that different
     * image sizes can be calculated for different screen sizes.
     *
     * @param string $type
     * @param string $key
     * @param string $value
     *
     * @return void
     */
    private function setVariantItem(
        string $type,
        string $key,
        string $value
    ): void {
        if (
            !empty($value)
            && $value !== '1'
            && empty($this->imageConfig[$type][$key] ?? false)
        ) {
            $this->imageConfig[$type][$key] = $value;
        }
    }

    /**
     * Set the CSS class for displaying additional shapes.
     *
     * @return void
     */
    private function setImageShape(): void
    {
        $imageShape = $this->getMappedValue(
            $this->settings['shapeMap'] ?? [],
            $this->pData['imageshape'] ?? null,
            ''
        );
        if (!empty($imageShape)) {
            $this->addCssClass($imageShape, 'imgClass');
        }
    }

    /**
     * Get the current orientation of the content element.
     * Returns values from 'orientMap':
     *   top, bottom, intext_right, intext_left, right, left, centered_left, centered_right
     *
     * @return string
     */
    private function getOrientation(): string
    {
        $orientField = $this->settings['orientField'] ?? 'imageorient';
        $orientValue = $this->pData[$orientField] ?? null;
        if (is_int($orientValue)) {
            $orientation = $this->getMappedValue(
                $this->settings['orientMap'] ?? [],
                $orientValue,
                ''
            );
        } else {
            $orientation = $orientValue ?? '';
        }
        return $orientation;
    }

    /**
     * Set the required CSS class for the given orientation (values from 'orientClassMap').
     *
     * @param string $orientation
     *
     * @return void
     */
    private function setOrientation(string $orientation): void
    {
        $orientClass = $this->getMappedValue(
            $this->settings['orientClassMap'][$this->CType] ?? [],
            $orientation,
            ''
        );
        $this->addCssClass($orientClass, 'parentClass');
    }

    /**
     * Set the value in the gallery configuration that determines
     * whether the image should be displayed inline in the text.
     *
     * @return void
     */
    private function setGalleryWrap(): void
    {
        if ((bool) ($this->pData['gallery_nowrap'] ?? false)) {
            $this->imageConfig['noWrap'] = true;
            $this->addCssClass('gallery-nowrap', 'parentClass');
        }
    }

    /**
     * Prepare carousel data by determining the number of slides required
     * and creating an array containing the corresponding file references.
     *
     * @param array $processedData Key/value store of processed data
     * @param array $map The map defined in TypoScript
     *
     * @return void
     */
    private function setGalleryCarousel(array $processedData): void
    {
        if (
            isset($processedData['files'])
            && is_array($processedData['files'])
            && count($processedData['files'])
        ) {
            $carouselConfig = $this->getMappedValue(
                $this->settings['carouselMap'] ?? [],
                (int) ($this->pData['gallery_carousel'] ?? 0)
            );
            if (
                is_array($carouselConfig)
                && count($carouselConfig)
            ) {
                $this->imageConfig['galleryCarousel'] = $carouselConfig;
                $this->imageConfig['galleryCarousel']['showIndicators']
                    = (bool) ($carouselConfig['showIndicators'] ?? true);
                $this->imageConfig['galleryCarousel']['showControls']
                    = (bool) ($carouselConfig['showControls'] ?? true);
                $slideCount = -1;
                $carouselSlides = [];
                $imageCols = (int) ($this->pData['imagecols'] ?? 1);
                foreach ($processedData['files'] as $index => $file) {
                    if ($index % $imageCols == 0) {
                        $slideCount++;
                    }
                    $carouselSlides[$slideCount][] = $file;
                }
                $this->imageConfig['galleryCarouselSlides'] = $carouselSlides;
            }
        }
    }

    /**
     * Decode an array defined in TypoScript constants so that these values can be used as a normal array in PHP.
     *
     * @param mixed $map
     *
     * @return array|null
     */
    private function valuesToArray(mixed $map): array
    {
        if (
            $map
            && !is_array($map)
        ) {
            return (array) json_decode('{' . substr($map, 1, -1) . '}');
        }
        return [];
    }

    /**
     * Get the data from the map that corresponds to the given value.
     * This is used to obtain a value from a map using a value from the database.
     *
     * @param array $map The map defined in TypoScript.
     * @param mixed $key The map key.
     * @param mixed $defaultValue The default value if the requested key is not set.
     *
     * @return mixed
     */
    private function getMappedValue(
        array $map,
        mixed $key,
        mixed $defaultValue = null
    ): mixed {
        if (
            count($map)
            && $key !== ''
            && isset($map[$key])
        ) {
            return $map[$key];
        } else {
            return $defaultValue;
        }
    }

    /**
     * Store the final gallery configuration in the processedData array.
     *
     * @param ContentObjectRenderer $cObj
     * @param array $processorConfiguration
     * @param array $processedData
     *
     * @return void
     */
    private function storeImageConfig(
        ContentObjectRenderer $cObj,
        array $processorConfiguration,
        array &$processedData
    ): void {
        $targetFieldName = (string) $cObj->stdWrapValue(
            'as',
            $processorConfiguration,
            'imageConfig'
        );

        $processedData[$targetFieldName] = $this->imageConfig;
    }
}
