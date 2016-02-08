<?php
/**
 * The template used for displaying dashboard content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

global $current_user;
$custom_query = new WP_Query(
	array(
		'author'			=> $current_user->ID,
		'post_type'		=> 'ctba-entries',
		'post_status' => array(
			'publish',
			'pending'
		),
		'nopaging'    => true
	)
);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="gamma heading--main entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php #ctba_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

while($custom_query->have_posts()) : $custom_query->the_post(); ?>
<?php $query = site_url( '/nominate/entry/' );
$new_query = add_query_arg( array(
    'entry' => get_the_ID(),
), $query );?>
	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<h1><a href="<?php echo $new_query?>"><?php the_title(); ?></a></h1>
		<?php the_content(); ?>
	</div>

<?php endwhile; ?>
<?php wp_reset_postdata(); // reset the query ?>

	</div><!-- .entry-content -->

	<?php
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
				get_the_title()
			),
			'<footer class="entry-footer"><span class="edit-link">',
			'</span></footer><!-- .entry-footer -->'
		);
	?>

</article><!-- #post-## -->
