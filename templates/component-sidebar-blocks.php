<?php
/**
 * Right Sidebar Component Template
 *
 * Called by either component-left-sidebar.php or component-right-sidebar.php
 * Inside a while-loop.
 *
 * @since 1.0.0
 *
 * @package Dataspark
 * @subpackage Templates
 */

if ( ! defined( 'WPINC' ) ) { die; } // If this file is called directly, abort.
	
    if( get_row_layout() == 'download' ) { ?>
      <div class="block info download single_block">
        <?php if( get_sub_field('file_upload') ): ?>
          <?php if( get_sub_field('file_link_title')): ?>
            <a href="<?php the_sub_field('file_upload'); ?>" ><?php the_sub_field('file_link_title'); ?></a>
          <?php else: ?>
            <a href="<?php the_sub_field('file_upload'); ?>" >Download File</a>
          <?php endif; ?>
        <?php endif; ?>
      </div> <!-- /.block.download -->
      
    <?php } 
	
	elseif( get_row_layout() == 'block_cta' ) { ?>
		<div class="block sidebar_block cta">
			<?php if( get_sub_field('block_cta_title')): ?>
			  <h4><?php the_sub_field('block_cta_title'); ?></h4>
			<?php endif; ?>
			<?php if( get_sub_field('block_cta_body')): ?>
			  <?php the_sub_field('block_cta_body'); ?>
			<?php endif; ?>
			
			<?php if( have_rows('block_cta_button') ): ?>
			  <?php while ( have_rows('block_cta_button') ) : the_row(); ?>
			    <?php $link = get_cta_link(get_sub_field('button_title'),get_sub_field('button_url')); ?>
			    <?php if($link): ?>
			      <?php echo $link; ?>
			    <?php endif; ?>
			  <?php endwhile; ?>
			<?php endif; ?>
		</div> <!-- /.block.cta -->

    <?php }
	    
	elseif( get_row_layout() == 'image_cta' ) { ?>

	    <div class="block image">
	      <?php //$cta_image = get_image_markup(get_sub_field('image_cta_image'),get_sub_field('image_cta_url'));
	      $thumb_id = get_sub_field('image_cta_image');
							  
		  $large_thumb = wp_get_attachment_image_src($thumb_id,'featured-medium');
		  $small_thumb = wp_get_attachment_image_src($thumb_id,'featured-small');
		  $alt = get_post_meta($article->ID, '_wp_attachment_image_alt', true);
		  if($small_thumb): ?>
		    <picture>
		    	<a href="<?php echo get_sub_field('image_cta_url'); ?>">
					<!--[if IE 9]><video style="display: none;"><![endif]-->
						<source srcset="<?php echo $large_thumb[0] ?>" media="(min-width: 480px)" alt="<?php echo $alt; ?>">
					<!--[if IE 9]></video><![endif]-->
					<img srcset="<?php echo $small_thumb[0]; ?>" alt="<?php echo $alt; ?>">
		    	</a>
			</picture>
		  <?php endif;
	      
	      if($cta_image): ?>
	        <?php echo $cta_image; ?>
	      <?php endif; ?>
	    </div> <!-- /.block.image -->

    <?php }
	
	elseif( get_row_layout() == 'menu_block' ) { ?>

	    <div class="block info menu">
	      <?php if(get_sub_field('menu_block_title')): ?>
	        <h4><?php the_sub_field('menu_block_title'); ?></h4>
	      <?php endif; ?>
	      <ul class="side-menu">
	      <?php if( have_rows('menu_block_menu') ): ?>
	        <?php while ( have_rows('menu_block_menu') ) : the_row(); ?>
	          <li><a href="<?php the_sub_field('menu_block_link'); ?>"><?php the_sub_field('menu_block_link_label'); ?></a></li>
	        <?php endwhile; ?>
	      <?php endif; ?>
	      </ul>
	    </div> <!-- /.block.menu -->

    <?php } //get_row_layout() == 'menu_block'
	 
	elseif( get_row_layout() == 'related_content_block') { ?>
      
    	<div class="block article article_sidebar">
	      
	        <?php if( get_sub_field('rcb_section_title')): ?>
	          <h3 class="sidebar_title"><?php the_sub_field('rcb_section_title'); ?></h3>
	        <?php endif; ?>
	        
		    <?php  $insight_type = get_sub_field('rcb_content_type'); 
		    
		    if($insight_type) {
			      
		      	if( get_sub_field($insight_type)):
		      	
		            $articles = get_sub_field($insight_type);
		            
		            if($articles):
			            foreach($articles as $article): ?>
			            
			            	<div class="snippet">
								<?php 		
								if(get_sub_field('display_thumbnails') == TRUE):		  
									$thumb_id = get_field('post_thumbnail',$article->ID);
									$small_thumb = wp_get_attachment_image_src($thumb_id,'thumbnail');
								    $large_thumb = wp_get_attachment_image_src($thumb_id,'featured-medium');
									  
									if($small_thumb): 
										$alt = get_post_meta($article->ID, '_wp_attachment_image_alt', true);?>
										<picture class="archive_story_left">
											<?php if($small_thumb): ?>
												<!--[if IE 9]><video style="display: none;"><![endif]-->
													<source srcset="<?php echo $small_thumb[0] ?>" media="(min-width: 768px)" alt="<?php echo $alt; ?>">
												<!--[if IE 9]></video><![endif]-->
											<?php endif; //large_thumb ?>
											<img srcset="<?php echo $large_thumb[0]; ?>" alt="<?php echo $alt; ?>">
										</picture>
									<?php endif; ?>
									 
									<?php if($small_thumb): 
										echo '<div class="archive_story_right">';
									endif; ?>
										<h4><a href="<?php echo get_permalink( $article->ID ); ?>"><?php echo $article->post_title; ?></a></h4>
									<?php if($small_thumb): 
										echo '</div>';
									endif;
								else: //display_thumbnails ?>
									<h4><a href="<?php echo get_permalink( $article->ID ); ?>"><?php echo $article->post_title; ?></a></h4>
								<?php endif; //display_thumbnails ?>
									<div class="clearfix"></div>
								<?php if(get_sub_field('show_excerpt') == TRUE): ?>
									<?php if(!empty($article->post_excerpt)): ?>
									    <p><?php echo $article->post_excerpt; ?></p>
									<?php endif; ?>
								<?php endif; ?>
								
							</div><!-- /.snippet -->
			            <?php endforeach; 
				   endif; // articles
			        
		            if( have_rows('rcb_footer_link') ): ?>
			          <?php while ( have_rows('rcb_footer_link') ) : the_row(); ?>
			            <?php $footer_link = get_cta_link_alt(get_sub_field('rcb_footer_link_title'),get_sub_field('rcb_footer_link_page_link')); ?>
			            <?php if($footer_link): ?>
			              <div class="related-footer">
			                <?php echo $footer_link; ?>
			              </div>
			            <?php endif; ?>
			          <?php endwhile; ?>
			        <?php endif;  //have_rows
				        
			        if(get_field('header_cta', 'option')): ?>
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
					<?php endif; // header_cta 
		        endif; //get_sub_field($insight_type)
			} //$insight_type ?>
    	</div> <!-- block article article_sidebar -->
	<?php $get_row_layout = get_row_layout();
		
	} //get_row_layout() == 'related_content_block'}?>