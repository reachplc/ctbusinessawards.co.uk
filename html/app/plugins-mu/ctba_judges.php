<?php
/**
 * Judges CPT
 *
 * @package WordPress
 * @subpackage CTBA
 */

class CTBA_Judges {

	public function __construct() {

		add_action(
			'after_setup_theme',
			array(
				$this,
				'define_constants'
				),
		  1
		);

		add_action(
			'init',
			array(
				$this,
				'add_post_type'
			)
		);

	}

	public function define_constants() {
		// Path to the child theme directory
		/*$this->ctba_override_constant(
			'GRD_DIR',
			get_stylesheet_directory_uri()
		);*/

	}

	public function ctba_override_constant( $constant, $value ) {

		if ( ! defined( $constant ) ) {
			define( $constant, $value ); // Constants can be overidden via wp-config.php
		}

	}

	public function enqueue_scripts() {

	}

	public function add_post_type() {

		$labels = array(
			'name'                  => _x( 'Judges', 'Post Type General Name', 'ctba_judges' ),
			'singular_name'         => _x( 'Judge', 'Post Type Singular Name', 'ctba_judges' ),
			'menu_name'             => __( 'Judges', 'ctba_judges' ),
			'name_admin_bar'        => __( 'Judges', 'ctba_judges' ),
			'archives'              => __( 'Judge Archives', 'ctba_judges' ),
			'parent_item_colon'     => __( 'Parent Item:', 'ctba_judges' ),
			'all_items'             => __( 'All Judges', 'ctba_judges' ),
			'add_new_item'          => __( 'Add New Item', 'ctba_judges' ),
			'add_new'               => __( 'Add New', 'ctba_judges' ),
			'new_item'              => __( 'New Item', 'ctba_judges' ),
			'edit_item'             => __( 'Edit Item', 'ctba_judges' ),
			'update_item'           => __( 'Update Item', 'ctba_judges' ),
			'view_item'             => __( 'View Item', 'ctba_judges' ),
			'search_items'          => __( 'Search Item', 'ctba_judges' ),
			'not_found'             => __( 'Not found', 'ctba_judges' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'ctba_judges' ),
			'featured_image'        => __( 'Profile Image', 'ctba_judges' ),
			'set_featured_image'    => __( 'Set profile image', 'ctba_judges' ),
			'remove_featured_image' => __( 'Remove profile image', 'ctba_judges' ),
			'use_featured_image'    => __( 'Use as profile image', 'ctba_judges' ),
			'insert_into_item'      => __( 'Insert into item', 'ctba_judges' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'ctba_judges' ),
			'items_list'            => __( 'Items list', 'ctba_judges' ),
			'items_list_navigation' => __( 'Items list navigation', 'ctba_judges' ),
			'filter_items_list'     => __( 'Filter items list', 'ctba_judges' ),
		);
		$args = array(
			'label'                 => __( 'Judges', 'ctba_judges' ),
			'description'           => __( 'Post Type Description', 'ctba_judges' ),
			'labels'                => $labels,
			'supports'              => array(
				'title',
				'editor',
				'thumbnail',
				'revisions',
				'page-attributes'
			),
			'taxonomies'            => array( ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'menu_icon'							=> 'dashicons-clipboard',
			'rewrite'								=> array(
				'slug' => 'judges',
				'with_front' => false,
				'pages' => false,
			),
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'ctba-judges', $args );

	}

	public function print_header_scripts() {

	}

	public function print_footer_scripts() {

	}


}


function ctba_judges_init() {
	$CTBA_Judges = new CTBA_Judges();
}

add_action( 'plugins_loaded', 'ctba_judges_init' );
