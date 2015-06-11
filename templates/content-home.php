<?php
/**
 * Homepage Template
 *
 * Populated with fields set for homepage template.
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
        <?php $cover_thumb = get_image_url(get_sub_field('hp_video_cover_image'), 'featured-medium'); ?>
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
    <?php the_sub_field('hp_video_body'); ?>
    <?php endwhile; ?>
  </div><!-- .video-wrap -->
<?php endif; ?>
<?php
$args = array(
  'post_type' => 'insight',
  'meta_query' => array(
    'relation' => 'AND',
    array(
      'key' => 'insight_featured',
      'value' => '1'
    )
  )
);
?>
<?php $query = new WP_Query( $args ); ?>
<?php if ( $query->have_posts() ): ?>
  <div class="latest">
    <?php if(get_field('lp_content_title')): ?>
      <h2><?php the_field('lp_content_title'); ?></h2>
    <?php endif; ?>
    <?php while ( $query->have_posts() ): ?>
      <div class="item">
        <?php $query->the_post();
	        
	        // Get the image and clean it up
        	$image_id = get_field('post_thumbnail'); 
	        $image_mobile = wp_get_attachment_image_src($image_id, 'featured-medium');
			$image_desk = wp_get_attachment_image_src($image_id, 'featured-small');
			
			// Other variables
			$permalink = get_permalink($post->ID);
			$title = get_the_title($post->ID);
	        
			if($image_id): ?>
          <div class="graphic">
            <a href="<?php echo $permalink; ?>">
	           <picture>
					<!--[if IE 9]><video style="display: none;"><![endif]-->
						<source srcset="<?php echo $image_desk[0]; ?>" media="(min-width: 760px)">
					<!--[if IE 9]></video><![endif]-->
					<img src='<?php echo $image_mobile[0]; ?>' alt="<?php echo $title; ?>" title="<?php echo $title; ?>" />
				</picture>
            </a>
          </div>
        <?php endif; ?>
        <div class="title">
          <h3><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></h3>
        </div>
        <div class="clearfix"></div>
      </div>
    <?php endwhile; ?>
  </div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>

<?php if(get_field('header_cta', 'option')): ?>
	<div class="mobile_device">
		<?php while(has_sub_field('header_cta', 'option')): ?>
			<?php $link = get_cta_link(get_sub_field('header_cta_title'),get_sub_field('header_cta_url')); ?>
			<?php if($link): ?>
				<?php if(get_sub_field('header_cta_web_only') == TRUE): ?>
				
                <?php else: ?>
	                <?php echo $link; ?>
                <?php endif; ?>
            <?php endif; ?>
		<?php endwhile; ?>
	</div><!--.button-->
<?php endif; ?>