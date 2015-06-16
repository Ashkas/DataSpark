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

if ( ! defined( 'WPINC' ) ) { die; } // If this file is called directly, abort.

$banner_image = get_field('banner_image');
if($banner_image): 
	$xlarge_wide = wp_get_attachment_image_src($banner_image,'featured-xlarge');
	$large_wide = wp_get_attachment_image_src($banner_image,'featured-large');
	$mobile_wide = wp_get_attachment_image_src($banner_image,'featured-medium');?>
	
	<div class="big_banner">
		<picture>
			<!--[if IE 9]><video style="display: none;"><![endif]-->
				<source srcset="<?php echo $xlarge_wide[0] ?>" media="(min-width: 1100px)">
				<source srcset="<?php echo $large_wide[0] ?>" media="(min-width: 760px)">
			<!--[if IE 9]></video><![endif]-->
			<img srcset="<?php echo $mobile_wide[0]; ?>">
			
			<div class="mobile_device">
				<?php get_template_part( 'templates/component', 'breadcrumbs' ); ?>
			</div>
			
			 <header class="banner_page_title">
				<h1 class="entry-title"><?php echo roots_title(); ?></h1>
				<?php get_template_part('templates/entry-meta'); ?>
			</header>
		</picture>		
		
		<div class="large_device">
			<?php get_template_part( 'templates/component', 'breadcrumbs' ); ?>
		</div>		
	</div>
		
<?php else: ?>
	<?php get_template_part( 'templates/component', 'breadcrumbs' ); ?>
	<div class="content">
		<header class="banner_page_title">
			<h1 class="entry-title"><?php echo roots_title(); ?></h1>
			<?php get_template_part('templates/entry-meta'); ?>
		</header>
	</div>
<?php endif; ?>