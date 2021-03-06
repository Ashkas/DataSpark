<?php
/**
 * Carousel Component Partial
 *
 * Carousel fields are populated by fields on the homepage.
 *
 * @since 1.0.0
 *
 * @package Dataspark
 * @subpackage Templates
 */

if ( ! defined( 'WPINC' ) ) { die; } // If this file is called directly, abort. ?>

<?php if(have_rows('pillar')): ?>
  <div class="carousel">
    <?php  $counter = 0;
	    while ( have_rows('pillar') ) : the_row(); ?>
	      <div class="single-item">
	        <?php $carousel_banner_id = get_sub_field('pillar_image'); ?>
	        <?php if($carousel_banner_id): 
		        
		        // Images
		        $banner = wp_get_attachment_image_src($carousel_banner_id, 'large-wide');?>
		        
	        	<style type="text/css">
				    .item_image_<?php echo $counter; ?> {
				        background-image: none;
				        background-color: <?php the_sub_field('pillar_bg_colour'); ?>
				    }
				    @media only screen and (min-width: 768px) { /* Change to whatever media query you require */
				        .item_image_<?php echo $counter; ?> {
				             background: url(<?php echo $banner[0]; ?>);
				        }
				    }
				
				</style>
	          <div class="item image item_image_<?php echo $counter; ?>">
	            <?php if(get_sub_field('pillar_text_colour')): ?>
	            <div class="content" style="color:<?php the_sub_field('pillar_text_colour'); ?>">
	              <?php else: ?>
	            <div class="content">
	            <?php endif; ?>
	              <?php if(get_sub_field('pillar_tab_title')): ?>
	                <div data-tab-title="<?php echo wp_trim_words(get_sub_field('pillar_tab_title'), 9); ?>">
	                	<h2 class="headline"><?php the_sub_field('pillar_title'); ?></h2>
	                </div>
	              <?php else: ?>
	                <div data-tab-title="<?php the_sub_field('pillar_title'); ?>">
	                  <h2 class="headline"><?php the_sub_field('pillar_title'); ?></h2>
	                </div>
	              <?php endif; ?>
	              <div class="body">
	                <?php the_sub_field('pillar_body'); ?>
	              </div>
	              <?php if(have_rows('pillar_link')): ?>
	                <?php while (have_rows('pillar_link')) : the_row(); ?>
	                  <?php echo get_cta_link( get_sub_field('pillar_link_title'), get_sub_field('pillar_link_url')); ?>
	                <?php endwhile; ?>
	              <?php endif; ?>
	            </div>
	          </div>
	        <?php endif; ?>
	      </div>
	      <?php $counter++;
      endwhile; ?>
  </div>
<?php $rows = get_field('pillar'); ?>
<?php $row_count = count($rows); ?>
<!-- <div class="carousel-pager <?php echo 'rows-'.$row_count; ?>"></div> -->
<?php endif; ?>