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
    <?php  while ( have_rows('pillar') ) : the_row(); ?>
      <div class="single-item">
        <?php $carousel_banner_id = get_sub_field('pillar_image'); ?>
        <?php if($carousel_banner_id): 
	        
	        // Images
	        $banner = wp_get_attachment_image_src($carousel_banner_id, 'large-wide');
			
        ?>
          <div class="item image" style="background-color:<?php the_sub_field('pillar_bg_colour'); ?>; background-image:url('<?php echo $banner[0]; ?>')">
            <?php if(get_sub_field('pillar_text_colour')): ?>
            <div class="content" style="color:<?php the_sub_field('pillar_text_colour'); ?>">
              <?php else: ?>
            <div class="content">
            <?php endif; ?>
              <?php if(get_sub_field('pillar_tab_title')): ?>
                <div class="headline" data-tab-title="<?php echo wp_trim_words(get_sub_field('pillar_tab_title'), 9); ?>">
                  <?php the_sub_field('pillar_title'); ?>
                </div>
              <?php else: ?>
                <div class="headline" data-tab-title="<?php the_sub_field('pillar_title'); ?>">
                  <?php the_sub_field('pillar_title'); ?>
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
      <?php endwhile; ?>
  </div>
<?php $rows = get_field('pillar'); ?>
<?php $row_count = count($rows); ?>
<!-- <div class="carousel-pager <?php echo 'rows-'.$row_count; ?>"></div> -->
<?php endif; ?>