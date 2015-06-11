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

if ( ! defined( 'WPINC' ) ) { die; } // If this file is called directly, abort.

if( (have_rows('rhs_sidebar'))):
	
	$search_sidebar = get_field('rhs_sidebar');
	if($search_sidebar):
		$related_content = search_flex_content_block('related_content_block', $search_sidebar);
	endif;
		
	while ( have_rows('rhs_sidebar') ) : the_row();
		get_template_part('templates/component', 'sidebar-blocks');
	endwhile;
	
	// If the related content block is not shown then we want to show our automatic sidebar
	if($related_content === null):
		get_template_part('templates/component', 'sidebar-fallback');
	endif; // related_content
	
else:
	
	get_template_part('templates/component', 'sidebar-fallback'); 
	
endif; // have_rows ?>