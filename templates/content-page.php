<?php while (have_posts()) : the_post(); ?>
	<?php if( (have_rows('contact_block'))):
		while ( have_rows('contact_block') ) : the_row();
			if(get_row_layout() == 'blocks'):
				
				if(get_sub_field('columns') == '1'):
					echo '<div class="full_block">';
				else:
					echo '<div class="half_block">';
				endif;
				
					if(get_sub_field('column_title')):
						echo '<h2>'.get_sub_field('column_title').'</h2>';
					endif; 
					// check if the repeater field has rows of data
					if( have_rows('column_1_content') ):
					 	// loop through the rows of data
					    while ( have_rows('column_1_content') ) : the_row();
					        // display a sub field value
					        if(get_sub_field('label')):
					        	echo '<label>'.get_sub_field('label').'</label>';
					        endif;
					        
					        // display a sub field value
					        if(get_sub_field('text')):
					        	echo '<span>'.get_sub_field('text').'</span>';
					        endif;
					    endwhile;
					endif;
					
				if(get_sub_field('columns') == '1'):
					echo '';
				else:
					echo '</div><div class="half_block">';
				endif;
					
					if(get_sub_field('column_2_title')):
						echo '<h2>'.get_sub_field('column_2_title').'</h2>';
					endif; 
					// check if the repeater field has rows of data
					if( have_rows('column_2_content') ):
					 	// loop through the rows of data
					    while ( have_rows('column_2_content') ) : the_row();
					        // display a sub field value
					        if(get_sub_field('label')):
					        	echo '<label>'.get_sub_field('label').'</label>';
					        endif;
					        
					        // display a sub field value
					        if(get_sub_field('text')):
					        	echo '<span>'.get_sub_field('text').'</span>';
					        endif;
					    endwhile;
					endif;
					
				if(get_sub_field('columns')):
					echo '</div><div class="clearfix"></div>';
				endif;
				
			endif; //get_layout_row
		endwhile;
	endif;
	
  the_content();
  
  wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>'));
endwhile; ?>

<?php if(get_field('archive_page_boolean') == TRUE): ?>
  <?php $term_id = get_field('archive_select_post_type'); ?>
  <?php if($term_id): ?>
    <?php
    $args = array(
      'post_type' => 'insight',
      'showposts' => -1,
      'tax_query' => array(
        array(
          'taxonomy' => 'type',
          'terms' => $term_id,
          'field' => 'term_id',
        )
      ),
      'orderby' => 'title',
      'order' => 'ASC'
    );
    ?>
    <?php $query = new WP_Query( $args ); ?>
    <?php if ( $query->have_posts() ): ?>
      <div class="latest">
        <?php while ( $query->have_posts() ): ?>
          <?php $query->the_post(); ?>
          <div class="item">
            <?php $news_thumb = get_field('post_thumbnail'); ?>
            <?php if($news_thumb): ?>
              <div class="graphic">
                <a href="<?php the_permalink(); ?>"><?php echo wp_get_attachment_image($news_thumb,'insight-thumb'); ?></a>
              </div>
            <?php endif; ?>
            <div class="title">
              <h2><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>
            </div>
            <?php if(has_excerpt()): ?>
              <p><?php echo wp_trim_words(get_the_content(), 10); ?></p>
            <?php else: ?>
              <p><?php echo wp_trim_words(get_the_content(), 35); ?></p>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>