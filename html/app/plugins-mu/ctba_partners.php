<?php
/**
 * Must-Use Functions
 *
 * A class filled with functions that will never go away upon theme deactivation.
 *
 * @package WordPress
 * @subpackage CTBA
 */

class CTBA_Partners {

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
			array( $this, 'add_post_type' )
		);

		add_action(
			'init',
			array( $this, 'add_taxonomy' )
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
			'name'                  => _x( 'Partners', 'Post Type General Name', 'ctba_partners' ),
			'singular_name'         => _x( 'Partner', 'Post Type Singular Name', 'ctba_partners' ),
			'menu_name'             => __( 'Partners', 'ctba_partners' ),
			'name_admin_bar'        => __( 'Partners', 'ctba_partners' ),
			'archives'              => __( 'Partner Archives', 'ctba_partners' ),
			'parent_item_colon'     => __( 'Parent Item:', 'ctba_partners' ),
			'all_items'             => __( 'All Partners', 'ctba_partners' ),
			'add_new_item'          => __( 'Add New Item', 'ctba_partners' ),
			'add_new'               => __( 'Add New', 'ctba_partners' ),
			'new_item'              => __( 'New Item', 'ctba_partners' ),
			'edit_item'             => __( 'Edit Item', 'ctba_partners' ),
			'update_item'           => __( 'Update Item', 'ctba_partners' ),
			'view_item'             => __( 'View Item', 'ctba_partners' ),
			'search_items'          => __( 'Search Item', 'ctba_partners' ),
			'not_found'             => __( 'Not found', 'ctba_partners' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'ctba_partners' ),
			'featured_image'		=> __( 'Partner Logo', 'ctba_partners' ),
			'set_featured_image' => __( 'Set partner logo', 'ctba_partnes' ),
			'remove_featured_image' => __( 'Remove partner logo', 'ctba_partners' ),
			'use_featured_image' => __( 'Use as partner logo', 'ctba_partnes' ),
			'insert_into_item'      => __( 'Insert into item', 'ctba_partners' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'ctba_partners' ),
			'items_list'            => __( 'Items list', 'ctba_partners' ),
			'items_list_navigation' => __( 'Items list navigation', 'ctba_partners' ),
			'filter_items_list'     => __( 'Filter items list', 'ctba_partners' ),
		);
		$args = array(
			'label'                 => __( 'Partners', 'ctba_partners' ),
			'description'           => __( 'Post Type Description', 'ctba_partners' ),
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
			'menu_icon'							=> 'dashicons-networking',
			'rewrite'								=> array(
				'slug' => 'partners',
				'with_front' => false,
				'pages' => false,
			),
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'ctba-partners', $args );

	}

	public function add_taxonomy() {

	// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Partner Levels', 'taxonomy general name' ),
			'singular_name'     => _x( 'Partner Level', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Partner Levels' , 'ctba_partners'),
			'all_items'         => __( 'All Partner Levels' , 'ctba_partners'),
			'parent_item'       => __( 'Parent Partner Level' , 'ctba_partners'),
			'parent_item_colon' => __( 'Parent Partner Level:' , 'ctba_partners'),
			'edit_item'         => __( 'Edit Partner Level' , 'ctba_partners'),
			'update_item'       => __( 'Update Partner Level' , 'ctba_partners'),
			'add_new_item'      => __( 'Add New Partner Level' , 'ctba_partners'),
			'new_item_name'     => __( 'New Partner Level Name' , 'ctba_partners'),
			'menu_name'         => __( 'Partner Level' , 'ctba_partners'),
		);

		$rewrite = array(
			'slug'                       => 'partner-levels',
			'with_front'                 => false,
			'hierarchical'               => true,
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'query_var'                  => true,
			'rewrite'                    => $rewrite
		);

		register_taxonomy(
			'partner-levels',
			array('ctba-partners'),
			$args
	  );

	}

	public function print_header_scripts() {

	}
	public function print_footer_scripts() {

	}


}


function ctba_partners_init() {
	$CTBA_Partners = new CTBA_Partners();
}

add_action( 'plugins_loaded', 'ctba_partners_init' );
