<?php
/**
 * The template used for displaying dashboard content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="gamma heading--main entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php #twentysixteen_post_thumbnail(); ?>

	<div class="entry-content">

<?php $entry = get_query_var( 'entry' );?>
<h2>Entry: <?php echo (int) $entry; ?></h2>
<p><?php $value = get_post_meta( (int) $entry, $field_args[id], true); ?></p>
<?php

	function ctba_entries_set_title( $field_args, $field ){
		$entry = get_query_var( 'entry' );
		$value = get_the_title( $entry );
		return $value;
	}

	function ctba_entries_set_default( $field_args, $field ) {
		$entry = get_query_var( 'entry' );
    $value = get_post_meta( (int) $entry, $field_args[id], true );
    return $value;
}
?>

<?php echo do_shortcode( '[cmb-frontend-form]' ); ?>


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
