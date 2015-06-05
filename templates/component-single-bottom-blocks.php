<div class="block article article_sidebar">
	      
	<h3 class="sidebar_title">Read next</h3>
	
	<?php $args = array(
		'posts_per_page' => 8,
		'post_type' => 'insight',
		'tax_query' => array(
			array(
			    'taxonomy'  => 'type',
			    'field'     => 'slug',
			    'terms' => 'infographic', 
			    'operator' => 'NOT IN'
			    )
			),
	);
	
	$query = null;
	$query = get_posts( $args );
									
	foreach( $query as $post ) :	setup_postdata($post); ?>
		<div class="article_blocks">
			<?php 				  
			$thumb_id = get_field('post_thumbnail',$post->ID);
			$small_thumb = wp_get_attachment_image_src($thumb_id,'featured-small');
		    $large_thumb = wp_get_attachment_image_src($thumb_id,'featured-medium');
		   
	/*
			if($small_thumb): 
				$width_check = 300;	
				list($width, $height) = getimagesize($small_thumb[0]);
				if ($width_check == $width) {
					$small_thumb = wp_get_attachment_image_src($thumb_id, 'featured-small');
					
				} else {
					$small_thumb = false;
				}
			endif;
	*/	
							  
			if($large_thumb): 
				$alt = get_post_meta($article->ID, '_wp_attachment_image_alt', true);?>
				<picture>
					<?php if($large_thumb): ?>
						<!--[if IE 9]><video style="display: none;"><![endif]-->
							<source srcset="<?php echo $large_thumb[0] ?>" media="(min-width: 768px)" alt="<?php echo $alt; ?>">
						<!--[if IE 9]></video><![endif]-->
					<?php endif; //large_thumb ?>
					<img srcset="<?php echo $small_thumb[0]; ?>" alt="<?php echo $alt; ?>">
				</picture>
			<?php endif; ?>
			 
			<h4><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a></h4>
			
		</div><!-- /.snippet -->
	<?php endforeach; 
	echo '<div class="clearfix"></div>';
	    
	wp_reset_postdata(); ?>
        
</div> <!-- block -->