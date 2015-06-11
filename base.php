<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

  <!--[if lt IE 8]>
    <div class="alert alert-warning">
      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
    </div>
  <![endif]-->

  <?php
    do_action('get_header');
  // Get header template part
    get_template_part('templates/header');
  ?>
 <?php
 // Either include carousel or banner image components
    if(is_page_template('template-home.php') || is_page_template('template-landing.php')) {
      get_template_part( 'templates/component', 'carousel' );
      $breadcrumb_class = "no-breadcrumbs";
    } elseif(is_single()) {
      get_template_part( 'templates/component', 'single-header' );
      // breadcrumb is included in the single header template
    } elseif(is_page()) {
      get_template_part( 'templates/page', 'header' );
      // breadcrumb is included in the header template
    } else {
      get_template_part( 'templates/component', 'banner' );
      // Breadcrumbs for all pages but home & landing templates.
      get_template_part( 'templates/component', 'breadcrumbs' );
      $breadcrumb_class = "breadcrumbs";
    }
 ?>
  <div class="wrap container <?php echo $breadcrumb_class ?>" role="document">
    <div class="content row">
      <main class="main <?php echo roots_main_class(); ?>" role="main">
        <?php include roots_template_path(); ?>
      </main><!-- /.main -->
      <?php if (get_field('lhs_sidebar')) : ?>
      <aside class="sidebar primary <?php echo roots_sidebar_class(); ?>" role="complementary">
        <?php get_template_part( 'templates/component', 'left-sidebar' ); ?>
      </aside><!-- /.sidebar -->
      <?php endif; ?>
      <?php if (get_field('rhs_sidebar') && !is_single()) : ?>
        <aside class="sidebar secondary <?php echo roots_sidebar_class(); ?>" role="complementary">
          <?php get_template_part( 'templates/component', 'right-sidebar' ); ?>
        </aside><!-- /.sidebar -->
      <?php endif; ?>
      <?php if (is_single()) : ?>
        <aside class="sidebar secondary <?php echo roots_sidebar_class(); ?>" role="complementary">
          <?php get_template_part( 'templates/component', 'right-sidebar' ); ?>
        </aside><!-- /.sidebar -->
      <?php endif; ?>
      
		<?php if (is_single()) : ?>
			<div class="clearfix"></div>
			<aside class="bottom_blocks <?php echo roots_sidebar_class(); ?>" role="complementary">
			  <?php get_template_part( 'templates/component', 'single-bottom-blocks' ); ?>
			</aside><!-- /.sidebar -->
		<?php endif; ?>
      
    </div><!-- /.content -->
  </div><!-- /.wrap -->

  <?php get_template_part('templates/footer'); ?>

</body>
</html>
