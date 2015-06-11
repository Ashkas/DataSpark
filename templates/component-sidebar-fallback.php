<div class="block article article_sidebar">
			<h3 class="sidebar_title">DataSpark infographics</h3>
	        
			<?php $args = array(
				'posts_per_page' => 4,
				'post_type' => 'insight',
				'tax_query' => array(
					array(
					    'taxonomy'  => 'type',
					    'field'     => 'slug',
					    'terms' => 'infographic', 
					    )
					),
			);
			
			$query = null;
		    $query = get_posts( $args );
											
			foreach( $query as $post ) :	setup_postdata($post); ?>
				<div class="snippet">
					<?php 				  
					$thumb_id = get_field('post_thumbnail',$post->ID);
					$small_thumb = wp_get_attachment_image_src($thumb_id,'thumbnail');
				    $large_thumb = wp_get_attachment_image_src($thumb_id,'featured-medium');
					  
					if($small_thumb): 
						$alt = get_post_meta($post->ID, '_wp_attachment_image_alt', true);?>
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
						<h4><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a></h4>
					<?php if($small_thumb): 
						echo '</div>';
					endif; ?>
					<div class="clearfix"></div>
					<?php if(!empty($post->post_excerpt)): ?>
					    <p><?php echo $post->post_excerpt; ?></p>
					<?php endif; ?>
					
				</div><!-- /.snippet -->
	        <?php endforeach; 
		    echo '<div class="clearfix"></div>';
	            
	        wp_reset_postdata(); ?>
		</div>