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

<article id="entry-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="gamma heading--main entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php #twentysixteen_post_thumbnail(); ?>

	<div class="entry-content">
		<p>Please use the questions below as a guide and feel free to expand on these by providing supporting documents as you wish.</p>
<?php

function get_meta_boxes(){

	/**
	 * This is the metabox id, and array of options to be used in styling the metabox
	 * Add metabox to be outputted must be listed here.
	 */

	$array = array(
		'_ctba_entries_2016_common' => array(
			'title' => 'Common Questions',
			'js-id' => '_ctba_entries_2016_common',
		),
		'_ctba_entries_2016_notforprofit' => array(
			'title' => 'Not-for-profit Organisation',
			'js-id' => '_ctba_entries_2016_notforprofit',
		),
		'_ctba_entries_2016_community' => array(
			'title' => 'Contribution to the Community',
			'js-id' => '_ctba_entries_2016_community',
		),
		'_ctba_entries_2016_trade' => array(
			'title' => 'International Trade',
			'js-id' => '_ctba_entries_2016_trade',
		),
		'_ctba_entries_2016_creative' => array(
			'title' => 'Creative Industries Business of the Year',
			'js-id' => '_ctba_entries_2016_creative',
		),
		'_ctba_entries_2016_retail' => array(
			'title' => 'Retail Business of the Year',
			'js-id' => '_ctba_entries_2016_retail',
		),
		'_ctba_entries_2016_technology' => array(
			'title' => 'Excellence in Science and Technology',
			'js-id' => '_ctba_entries_2016_technology',
		),
		'_ctba_entries_2016_manufacturing' => array(
			'title' => 'Excellence in Manufacturing',
			'js-id' => '_ctba_entries_2016_manufacturing',
		),
		'_ctba_entries_2016_marketing' => array(
			'title' => 'Sales and Marketing',
			'js-id' => '_ctba_entries_2016_marketing',
		),
		'_ctba_entries_2016_services' => array(
			'title' => 'Services',
			'js-id' => '_ctba_entries_2016_services',
		),
		'_ctba_entries_2016_entrepreneur' => array(
			'title' => 'Business Entrepreneur of the Year',
			'js-id' => '_ctba_entries_2016_entrepreneur',
		),
		'_ctba_entries_2016_newbusiness' => array(
			'title' => 'New Business of the Year',
			'js-id' => '_ctba_entries_2016_newbusiness',
		),
		'_ctba_entries_2016_smallbusiness' => array(
			'title' => 'Small Business of the Year',
			'js-id' => '_ctba_entries_2016_smallbusiness',
		),
		'_ctba_entries_2016_companyyear' => array(
			'title' => 'Company of the Year',
			'js-id' => '_ctba_entries_2016_companyyear',
		),
		'_ctba_entries_2016_additional' => array(
			'title' => 'Additional Information',
			'js-id' => '_ctba_entries_2016_additional',
		),
	);

	return $array;
}


echo '<form class="cmb-form" method="post" id="ctba-2016-entries-form" enctype="multipart/form-data" encoding="multipart/form-data">
    <input type="hidden" name="object_id" value="'. esc_attr( $object_id ) .'">';

$args = array(
	'form_format' => '%3$s',
	'save_fields' => false,
);


//$form;
foreach ( get_meta_boxes() as $metabox => $options ) { // loop over config array ?>
	<?php $category_status = ( ! in_array( $metabox, array( '_ctba_entries_2016_common', '_ctba_entries_2016_additional' ) ) ) ? 'data-state="visible"' : null; ?>
	<div id="<?php echo esc_attr( $options['js-id'] ); ?>" class="entry-category form-table" <?php echo esc_html( $category_status ); ?>>
	<h2 class="gamma heading--main"><?php echo esc_html( $options['title'] ); ?></h2>
	<?php cmb2_metabox_form( $metabox, $object_id, $args ); ?>
	<button type="submit" name="submit-cmb" value="Submit" class="btn btn--primary">Save</button>
	</div>
<?php } ?>

<input type="submit" name="submit-cmb" value="Submit" class="btn btn--primary">

</form>



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

</article><!-- #entry-<?php the_ID(); ?> -->
