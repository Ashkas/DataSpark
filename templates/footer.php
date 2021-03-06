<?php // ACF variables
	$section_title = get_field('footer_section_one_title', 'option');
	$section_expert = get_field('footer_section_one_expert', 'option');	
	$section_body = get_field('footer_section_one_body', 'option');
?>

<footer class="content-info" role="contentinfo">
  <div class="container">
	  
	  <?php if($section_title || $section_expert || $section_body): ?>
	    <div class="contact-info">
	      <div class="content wrap">
	        <?php if($section_title): ?>
	          <h2><?php the_field('footer_section_one_title', 'option'); ?></h2>
	        <?php endif; ?>
	
	        <?php if($section_expert): ?>
	          <?php while(has_sub_field('footer_section_one_expert', 'option')): ?>
	            <div class="experts">
	              <div class="image-wrap">
	                <?php if(get_sub_field('profile_image')): ?>
	                  <?php $profile_id = get_sub_field('profile_image'); ?>
	                <?php endif; ?>
	                <div class="profile-image"><?php echo get_image_markup($profile_id,'','expert-profile'); ?></div>
	              </div>
	              <div class="expert-details">
	                <h4 class="name"><?php the_sub_field('expert_name'); ?></h4>
	                <div class="info"><?php the_sub_field('expert_info'); ?></div>
	                <div class="email"><?php echo get_email_markup(get_sub_field('expert_email'),get_sub_field('email_text')); ?></div>
	              </div>
	            </div>
	          <?php endwhile; ?>
	        <?php endif; ?>
	
	        <?php if($section_body): ?>
	          <div class="location">
	            <p><?php the_field('footer_section_one_body', 'option'); ?></p>
	          </div>
	        <?php endif; ?>
	      </div>
	    </div>
	<?php endif; //if $section_title || $section_expert || $section_body ?>
	
	<?php if(get_field('footer_clients', 'option')): ?>
	    <div class="clients">
	      <div class="content wrap">
	        <?php if(get_field('footer_our_clients_title', 'option')): ?>
	          <h2><?php the_field('footer_our_clients_title', 'option'); ?></h2>
	        <?php endif; ?>
	        <?php if(get_field('footer_clients', 'option')): ?>
	          <div class="client-carousel">
	            <?php while(has_sub_field('footer_clients', 'option')): ?>
	              <?php $image = get_image_markup(
	                get_sub_field('footer_client_logo'),
	                get_sub_field('footer_client_link'),
	                'full'
	              );
	              ?>
	              <?php if($image): ?>
	                <div class="client-logo">
	                  <?php echo $image; ?>
	                </div>
	              <?php endif; ?>
	            <?php endwhile; ?>
	          </div>
	        <?php endif; ?>
	      </div>
	    </div>
	<?php endif; ?>
	
    <div class="social_bar">
		<div class="content wrap">
			<!-- Go to www.addthis.com/dashboard to customize your tools -->
			<div class="addthis_horizontal_follow_toolbox"></div>
		</div>
    </div>
	
    <div class="bottom-bar">
      <div class="content wrap">
        <?php if(get_field('footer_links', 'option')): ?>
         <ul class="footer-links">
          <?php while(has_sub_field('footer_links', 'option')): ?>
              <?php if((get_sub_field('footer_link_title')) && (get_sub_field('footer_link_url'))): ?>
                <li><a href="<?php the_sub_field('footer_link_url'); ?>"><?php the_sub_field('footer_link_title'); ?></a></li>
              <?php endif; ?>
          <?php endwhile; ?>
          </ul>
        <?php endif; ?>

        <div class="disclaimer">
          <div class="content">
        <?php if(get_field('footer_logo_repeater', 'option')): ?>
          <?php while(has_sub_field('footer_logo_repeater', 'option')): ?>
            <?php $image = get_image_markup(
              get_sub_field('footer_logo'),
              get_sub_field('footer_logo_url')
            );
            ?>
            <?php if($image): ?>
              <div class="footer-logo">
                <?php echo $image; ?>
              </div>
            <?php endif; ?>
          <?php endwhile; ?>
        <?php endif; ?>
        <?php $copyright_text = get_field('footer_copyright_text', 'option'); ?>
        <?php if($copyright_text): ?>
            <p><?php echo str_replace('%s', get_the_time('Y'), $copyright_text ); ?></p>
        <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="brand-bar"></div>
</footer>

<script>
// Picture element HTML5 shiv
document.createElement( "picture" );
</script>

<?php wp_footer(); ?>

<?php if(is_single()): ?>
<script>
	
	// Only load the add.This sidebar once past the top image if the featured image is set
	$('.load-sidebar-addthis').waypoint(function(direction) {        
	    if (direction == 'down') {
			$('.addthis-smartlayers-desktop').fadeIn( "slow", function() {});
			$('.addthis-smartlayers-desktop').removeClass('display_none');
	    }
	    if (direction == 'up') {
		    //$( ".addthis-smartlayers-desktop" ).fadeOut( "slow", function() {});
			$('.addthis-smartlayers-desktop').addClass('display_none');
			$('.addthis-smartlayers-desktop').fadeOut( "slow", function() {});
	    }
       
	});

</script>

<?php endif; ?>