<?php while (have_posts()) : the_post(); ?>
  <?php the_content(); ?>
  <?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
<?php endwhile; ?>
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