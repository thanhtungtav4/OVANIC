<?php
/**
 * The Template for including AMP HTML google analytics component
 *
 * This template can be overridden by copying it to yourtheme/wp-amp/google-tag-manager.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
?>
<amp-analytics
    config="https://www.googletagmanager.com/amp.json?id=<?php echo $this->get_google_tag_m() ?>&gtm.url=SOURCE_URL"
    data-credentials="include">
</amp-analytics>