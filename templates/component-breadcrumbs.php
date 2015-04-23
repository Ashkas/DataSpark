<?php
/**
 * Breadcrumbs component template
 *
 * Breadcrumbs are retrieved from Yoast SEO plugin.
 *
 * @since 1.0.0
 *
 * @package Dataspark
 * @subpackage Templates
 */

if ( ! defined( 'WPINC' ) ) { die; } // If this file is called directly, abort. ?>

<div class="breadcrumbs-wrap">
  <?php if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb('<p id="breadcrumbs">','</p>');
  } ?>
</div>