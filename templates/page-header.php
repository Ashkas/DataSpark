<?php if(!have_rows('contact_block')): ?>

	<?php get_template_part( 'templates/component', 'breadcrumbs' ); ?>
	<div class="content">
		<header class="banner_page_title">
			<h1 class="entry-title"><?php echo roots_title(); ?></h1>
			<?php get_template_part('templates/entry-meta'); ?>
		</header>
	</div>
<?php endif; ?>