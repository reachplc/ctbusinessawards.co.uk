<?php
/**
 * Must-Use Functions
 *
 * A class filled with functions that will never go away upon theme deactivation.
 *
 * @package WordPress
 * @subpackage CTBA
 */

class CTBA_Categories {

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
			'name'                  => _x( 'Categories', 'Post Type General Name', 'ctba_categories' ),
			'singular_name'         => _x( 'Category', 'Post Type Singular Name', 'ctba_categories' ),
			'menu_name'             => __( 'Categories', 'ctba_categories' ),
			'name_admin_bar'        => __( 'Categories', 'ctba_categories' ),
			'archives'              => __( 'Category Archives', 'ctba_categories' ),
			'parent_item_colon'     => __( 'Parent Item:', 'ctba_categories' ),
			'all_items'             => __( 'All Categories', 'ctba_categories' ),
			'add_new_item'          => __( 'Add New Item', 'ctba_categories' ),
			'add_new'               => __( 'Add New', 'ctba_categories' ),
			'new_item'              => __( 'New Item', 'ctba_categories' ),
			'edit_item'             => __( 'Edit Item', 'ctba_categories' ),
			'update_item'           => __( 'Update Item', 'ctba_categories' ),
			'view_item'             => __( 'View Item', 'ctba_categories' ),
			'search_items'          => __( 'Search Item', 'ctba_categories' ),
			'not_found'             => __( 'Not found', 'ctba_categories' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'ctba_categories' ),
			'featured_image'        => __( 'Category Icon', 'ctba_categories' ),
			'set_featured_image'    => __( 'Set category icon', 'ctba_categories' ),
			'remove_featured_image' => __( 'Remove category icon', 'ctba_categories' ),
			'use_featured_image'    => __( 'Use as category icon', 'ctba_categories' ),
			'insert_into_item'      => __( 'Insert into item', 'ctba_categories' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'ctba_categories' ),
			'items_list'            => __( 'Items list', 'ctba_categories' ),
			'items_list_navigation' => __( 'Items list navigation', 'ctba_categories' ),
			'filter_items_list'     => __( 'Filter items list', 'ctba_categories' ),
		);
		$args = array(
			'label'                 => __( 'Categories', 'ctba_categories' ),
			'description'           => __( 'Post Type Description', 'ctba_categories' ),
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
			'menu_icon'							=> 'dashicons-awards',
			'rewrite'								=> array(
				'slug' => 'categories',
				'with_front' => false,
				'pages' => false,
			),
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'ctba_categories', $args );

	}

	public function print_header_scripts() {

	}
	public function print_footer_scripts() {

	}


}


function ctba_categories_init() {
	$CTBA_Categories = new CTBA_Categories();
}

add_action( 'plugins_loaded', 'ctba_categories_init' );
