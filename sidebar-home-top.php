<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package universal_example
 */

if ( ! is_active_sidebar( 'main-sidebar-top' ) ) {
	return;
}
?>

<aside class="sidebar-front-page">
	<?php dynamic_sidebar( 'main-sidebar-top' ); ?>
</aside><!-- #secondary -->
