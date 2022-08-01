<?php 
/**
 * The Template for including AMP HTML google analytics component
 *
 * This template can be overridden by copying it to yourtheme/wp-amp/facebook-pixel.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
?>
<amp-pixel
    src="https://www.facebook.com/tr?id=<?php echo $this->get_facebook_pixel() ?>&ev=PageView&noscript=1"></amp-pixel>