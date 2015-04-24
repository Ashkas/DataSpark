<header class="banner container" role="banner">
  <div class="topbar">
    <div class="wrap">
      <div class="branding">
        <a class="brand" href="<?php echo home_url('/') ?>">
          <?php if(get_field('header_logo','options')): ?>
            <img src="<?php the_field('header_logo','options') ?>" alt="DataSpark Analytics - Logo"/>
          <?php endif; ?>
        </a>
      </div>
      <?php if(get_field('header_cta', 'option')): ?>
      <div class="navigation">
        <nav class="nav-secondary">
          <ul id="menu-secondary-nav" class="nav">
          <?php while(has_sub_field('header_cta', 'option')): ?>
            <?php $link = get_cta_link(get_sub_field('header_cta_title'),get_sub_field('header_cta_url')); ?>
            <?php if($link): ?>
              <?php if(get_sub_field('header_cta_web_only') == TRUE): ?>
                <li class="web-only no-button"><?php echo $link; ?></li>
                <?php else: ?>
                <li><?php echo $link; ?></li>
              <?php endif; ?>
            <?php endif; ?>
          <?php endwhile; ?>
          </ul><!--#menu-secondary-nav-->
        </nav><!--.nav-secondary-->
      </div><!--.navigation-->
      <?php endif; ?>
<!--
      <div class="menu-expand">
        <span class="menu-icon">Menu</span>
      </div>
-->
	<div class="clearfix"></div>
    </div> <!-- wrap -->
  </div> <!-- topbar -->
  
  <div class="bottombar">
    <div class="wrap">
      <nav class="nav-main" role="navigation">
        <div class="flex-menu-wrap">
          <div class="menu-button"></div>
        </div>
        <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(
            array(
              'theme_location' => 'primary_navigation',
              'menu_class' => 'flexnav',
              'items_wrap' => '<ul class="%2$s" id="%1$s" data-breakpoint="768">%3$s</ul>','container' => '',
            )
          );
        endif;
        ?>
      </nav>
    </div>
  </div>
</header>
<span class="waypoint"></span>