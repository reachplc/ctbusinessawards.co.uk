<?php /* Template Name: Entry */

if ( ! is_user_logged_in() ) {
  wp_redirect( home_url( $path = 'login' ) );
  exit;
}

get_header(); ?>

<div id="primary" class="content-area">

<main id="main" class="content__main wrapper cf" role="main">
  <div class="wrapper__sub">
    <article class="ss1-ss4 ms1-ms6 ls1-ls12">
      <?php
wp_nav_menu(array(
    'theme_location' => 'nominate',
));
?>

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'content-parts/content', 'entry' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;
		?>
    </article>
  </div>
</main>

</div><!-- .content-area -->

<?php get_footer(); ?>
