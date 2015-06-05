<?php while (have_posts()) : the_post(); ?>
	<div class="load-sidebar-addthis"></div>
	<article <?php post_class(); ?>>
		<!-- addthis -->
		<div class="small_device">
			<div class="addthis_sharing_toolbox"></div>
		</div>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<footer>
			<!-- addthis -->
			<div class="small_device">
				<div class="addthis_sharing_toolbox"></div>
			</div>
			<?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
			
			<?php //Get the field like normal 
			$content_form = get_field('contact_form','option');
			 
			//Apply filter to initiate shortcodes
			$content_form = apply_filters('the_content', $content_form);
			
			echo '<div class="margin_top single_block">
				<h3>Get in contact</h3>'.
				$content_form
			.'</div>';
			?>
		</footer>
		<?php //comments_template('/templates/comments.php'); ?>
	</article>
<?php endwhile; ?>
