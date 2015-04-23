<?php
/**
 * Landing Page Template
 *
 * Populated with fields set for landing page template.
 *
 * @since 1.0.0
 *
 * @package Dataspark
 * @subpackage Templates
 */

if ( ! defined( 'WPINC' ) ) { die; } // If this file is called directly, abort. ?>

<?php if(have_rows('hp_video')): ?>
  <div class="video-wrap">
    <?php  while ( have_rows('hp_video') ) : the_row(); ?>
      <?php $video_url = get_sub_field('hp_video_url'); ?>
      <?php if($video_url): ?>
        <?php $cover_thumb = get_image_url(get_sub_field('hp_video_cover_image'), 'video-cover-thumb'); ?>
        <?php if($cover_thumb): ?>
          <?php $video_thumb = get_video_thumb($video_url,$cover_thumb); ?>
        <?php else: ?>
          <?php $video_thumb = get_video_thumb($video_url); ?>
        <?php endif; ?>
          <div class="video-container">
            <?php if($video_thumb): ?>
              <?php echo $video_thumb; ?>
            <?php endif; ?>
            <?php $embed_code = wp_oembed_get($video_url,array()); ?>
            <div id="video" class="video" data-vid-target="<?php echo get_video_id($video_url); ?>">
              <?php echo $embed_code; ?>
            </div> <!-- .video -->
          </div> <!-- .video-container -->
        <?php endif; ?>
    <h2><?php the_sub_field('hp_video_title'); ?></h2>
    <p><?php the_sub_field('hp_video_body'); ?></p>
    <?php endwhile; ?>
  </div><!-- .video-wrap -->
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php the_content(); ?>