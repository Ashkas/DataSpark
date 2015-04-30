<?php
/**
 * Right Sidebar Component Template
 *
 * Fields are populated by the "RHS Sidebar" options via WordPress administration.
 *
 * @since 1.0.0
 *
 * @package Dataspark
 * @subpackage Templates
 */

if ( ! defined( 'WPINC' ) ) { die; } // If this file is called directly, abort. ?>

<?php if( (have_rows('rhs_sidebar')) && !is_single() ): ?>
  <?php while ( have_rows('rhs_sidebar') ) : the_row(); ?>
    <?php get_template_part('templates/component', 'sidebar-blocks'); ?>
  <?php endwhile; ?>
<?php endif; ?>

<?php if(is_single()) :
	get_template_part('templates/component', 'sidebar-blocks');
endif; ?>