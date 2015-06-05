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
<?php if($banner_image): 
	$large_wide = wp_get_attachment_image_src($banner_image,'large-wide');
	$mobile_wide = wp_get_attachment_image_src($banner_image,'large-wide-mobile');
	?>
	
	<div class="image-banner">
		<picture>
			<!--[if IE 9]><video style="display: none;"><![endif]-->
				<source srcset="<?php echo $large_wide[0] ?>" media="(min-width: 760px)">
			<!--[if IE 9]></video><![endif]-->
			<img srcset="<?php echo $mobile_wide[0]; ?>">
		</picture>
	</div>
	
	
	
<?php endif; ?>