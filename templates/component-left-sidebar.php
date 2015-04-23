<?php
/**
 * Left Sidebar Component Template
 *
 * Fields are populated by the "LHS Sidebar" options via WordPress administration.
 *
 * @since 1.0.0
 *
 * @package Dataspark
 * @subpackage Templates
 */

if ( ! defined( 'WPINC' ) ) { die; } // If this file is called directly, abort. ?>

<?php if( have_rows('lhs_sidebar') ): ?>
  <?php while ( have_rows('lhs_sidebar') ) : the_row(); ?>
    <?php get_template_part('templates/component', 'sidebar-blocks'); ?>
  <?php endwhile; ?>
<?php endif; ?>