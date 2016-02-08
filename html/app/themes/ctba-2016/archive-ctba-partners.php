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
				<h1 class="gamma heading--main page-title">2016 Partners</h1>
				<h2>Become a partner:</h2>
				<p>For more information regarding sponsorship opportunities, call Craig Cooksley on <a href="tel:01212345785">0121 234 5785</a> / <a href="tel:07826893264">07826 893 264</a> or email <a href="mailto:craig.cooksley@trinitymirror.com">craig.cooksley@trinitymirror.com</a>.</p>
			</header><!-- .page-header -->

  <ul class="judges judges__columns list">

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();?>
			<?php

				get_template_part( 'content-parts/content', 'ctba-partners' );

			endwhile;
			?>
			</ul>
 <?php else :

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
