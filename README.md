[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg?style=for-the-badge)](https://www.paypal.me/quellenform)
[![Latest Stable Version](https://img.shields.io/packagist/v/quellenform/t3x-bp-gallery-settings?style=for-the-badge)](https://packagist.org/packages/quellenform/t3x-bp-gallery-settings)
[![TYPO3](https://img.shields.io/badge/TYPO3-12|13-%23f49700.svg?style=for-the-badge)](https://get.typo3.org/)
[![License](https://img.shields.io/packagist/l/quellenform/t3x-bp-gallery-settings?style=for-the-badge)](https://packagist.org/packages/quellenform/t3x-bp-gallery-settings)

# Bootstrap Package: Gallery Settings

TYPO3 CMS Extension `bp_gallery_settings`

## What does it do?

This extension adds options to the Gallery Settings that allow you to control the width of images in relation to the text more precisely. ...pixel-perfect!

In addition, the extension offers the option of embedding the images in a carousel.

![Gallery Settings](Documentation/Images/Screenshot.png?raw=true)

## Installation

1. Make sure you have installed *EXT:bootstrap_package*
2. Install this extension from TER or with Composer
3. Add the provided TypoScript (or Site Set) to your template
4. Carefully check whether any of your individual templates affect the above-mentioned content types,
   and whether any relevant parts that are necessary for the rendering of icons are being overwritten!

> **Important Note**
>
> The templates provided with this extension are used in TypoScript BEFORE your individually defined templates
> to prevent them from being accidentally overwritten. Any changes you make to those default templates manually
> must therefore take into account the above-mentioned content elements for the rendering of icons and implement
> the modifications correctly!
>
> Hint: Take a look at the provided Typoscript/Templates.
