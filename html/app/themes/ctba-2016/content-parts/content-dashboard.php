<?php
/**
 * The template used for displaying dashboard content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

$current_user = wp_get_current_user();

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
	<p><?php printf( __( 'Welcome, %1$s (not you <a href="%2$s">logout</a>).', 'ctba-2016' ), $current_user->display_name, esc_url( home_url( $path = 'logout' ) ) ); ?></p>

	</header><!-- .entry-header -->

	<?php #ctba_post_thumbnail(); ?>

	<div class="entry-content">

	<table>
	<thead>
	<tr>
	<th>Company</th>
	<th>Categories</th>
	<th>Status</th>
	<th>Edit</th>
	</tr>
	</thead>
	<tbody>
		<?php

while($custom_query->have_posts()) : $custom_query->the_post(); ?>

<?php $query = site_url( '/nominate/entry/' );
$new_query = add_query_arg( array(
    'entry' => get_the_ID(),
), $query );?>

	<tr id="post-<?php the_ID(); ?>">
	<td><?php the_title( '<strong>', '</strong>'); ?></td>
	<td></td>
	<td></td>
	<td><a href="<?php echo $new_query; ?>">Edit</a></td>
	</tr>

<?php endwhile; ?>
</tbody>
</table>
<?php wp_reset_postdata(); // reset the query ?>

		<?php the_content(); ?>

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
