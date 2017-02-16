<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ctba-2016
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="box__large content__main wrapper cf" role="main">
		  <div class="wrapper__sub">
		    <article class="content__main ss1-ss4 ms1-ms6 ls1-ls8 separator">
				<?php
				if ( have_posts() ) : ?>

							<header class="page-header">
								<?php
									the_archive_title( '<h1 class="page-title">', '</h1>' );
									the_archive_description( '<div class="taxonomy-description">', '</div>' );
								?>
							</header><!-- .page-header -->

							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'content-parts/content', get_post_format() );

							endwhile;

							the_posts_navigation();

		else :

			get_template_part( 'content-parts/content', 'none' );

		endif; ?>
		    </article>

		    <aside class="content__aside ss1-ss4 ms1-ms6 ls9-ls12">
				<?php get_sidebar(); ?>
		    <aside>

		  </div>
		</main>

	</div><!-- #primary -->

<?php

get_footer();
