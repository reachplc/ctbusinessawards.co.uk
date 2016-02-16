<?php
/**
 * The template used for displaying dashboard content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

$entry = get_query_var( 'entry' );
$object_id = ( get_query_var( 'entry' ) !== '' ? $entry : 0 );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="gamma heading--main entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php #twentysixteen_post_thumbnail(); ?>

	<div class="entry-content">

<?php


function get_meta_boxes(){

	$array= array(
		'_ctba_entries_2016_common',
		'ctba-2016-categories-business',
		'ctba-2016-categories-export',
		'ctba-2016-categories-finance',
		'ctba-2016-categories-legal',
		'ctba-2016-categories-manufacturing',
		'ctba-2016-categories-sme',
		'ctba-2016-categories-professional',
		'ctba-2016-categories-people',
		'ctba-2016-categories-property',
		'ctba-2016-categories-technology',
		'ctba-entries-2016-additional',
	);

	return $array;
}


echo '<form class="cmb-form" method="post" id="ctba-2016-entries-form" enctype="multipart/form-data" encoding="multipart/form-data">
    <input type="hidden" name="object_id" value="'. $object_id .'">';

$args = array( 'form_format' => '%3$s', 'save_fields'  => false,
 );
$form;
foreach( get_meta_boxes() as $metabox ) { // loop over config array
    cmb2_metabox_form( $metabox, $object_id, $args );
}
echo '<input type="submit" name="submit-cmb" value="Submit" class="btn btn--primary"></form>';
?>


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
