<?php
/**
 * Banner Component Partial
 *
 * Banner is retrieved from pages where the banner field is available.
 *
 * @since 1.0.0
 *
 * @package Dataspark
 * @subpackage Templates
 */

if ( ! defined( 'WPINC' ) ) { die; } // If this file is called directly, abort. ?>

<?php $banner_image = get_field('banner_image'); ?>
<?php if($banner_image): ?>
  <div class="image-banner">
    <div class="item image" style="background-image:url('<?php echo wp_get_attachment_url($banner_image,'full'); ?>')">
    </div>
  </div>
<?php endif; ?>