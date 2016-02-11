<?php
/**
 * Judges CPT
 *
 * @package WordPress
 * @subpackage CTBA
 */

class CTBA_Entries {

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
			'map_meta_cap',
			array( $this, 'entries_add_role_caps' ),
			10,
			4
		);

		add_filter(
			'query_vars',
			array( $this, 'add_query_vars_filter' )
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
			'name'                  => _x( 'Entries', 'Post Type General Name', 'ctba_entries' ),
			'singular_name'         => _x( 'Entry', 'Post Type Singular Name', 'ctba_entries' ),
			'menu_name'             => __( 'Entries', 'ctba_entries' ),
			'name_admin_bar'        => __( 'Entries', 'ctba_entries' ),
			'archives'              => __( 'Entry Archives', 'ctba_entries' ),
			'parent_item_colon'     => __( 'Parent Item:', 'ctba_entries' ),
			'all_items'             => __( 'All Entries', 'ctba_entries' ),
			'add_new_item'          => __( 'Add New Item', 'ctba_entries' ),
			'add_new'               => __( 'Add New', 'ctba_entries' ),
			'new_item'              => __( 'New Item', 'ctba_entries' ),
			'edit_item'             => __( 'Edit Item', 'ctba_entries' ),
			'update_item'           => __( 'Update Item', 'ctba_entries' ),
			'view_item'             => __( 'View Item', 'ctba_entries' ),
			'search_items'          => __( 'Search Item', 'ctba_entries' ),
			'not_found'             => __( 'Not found', 'ctba_entries' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'ctba_entries' ),
			'insert_into_item'      => __( 'Insert into item', 'ctba_entries' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'ctba_entries' ),
			'items_list'            => __( 'Items list', 'ctba_entries' ),
			'items_list_navigation' => __( 'Items list navigation', 'ctba_entries' ),
			'filter_items_list'     => __( 'Filter items list', 'ctba_entries' ),
		);
		$args = array(
			'label'                 => __( 'Entries', 'ctba_entries' ),
			'description'           => __( 'Post Type Description', 'ctba_entries' ),
			'public'                => false,
			'publicly_queryable'    => false,
			'exclude_from_search'   => true,
			'show_in_nav_menus'     => false,
			'show_ui'               => true,
			'show_in_admin_bar'     => false,
			'menu_position'         => 5,
			//'menu_icon'							=> '',
			'can_export'            => true,
			'delete_with_user'			=> false,
			'hierarchical'          => false,
			'has_archive'           => false,
			'query_var'           	=> true,
			'capability_type' => array(
				'entry',
				'entries'
			),
			'map_meta_cap'        	=> true,
			'capabilities' => array(
				// meta caps (don't assign these to roles)
				'edit_post'              => 'edit_entry',
				'read_post'              => 'read_entry',
				'delete_post'            => 'delete_entry',
				// primitive/meta caps
				'create_posts'           => 'create_entries',
				// primitive caps used outside of map_meta_cap()
				'edit_posts'             => 'edit_entries',
				'edit_others_posts'      => 'edit_others_entries',
				'publish_posts'          => 'publish_entries',
				'read_private_posts'     => 'read_private_entries',
				// primitive caps used inside of map_meta_cap()
				'read'                   => 'read_entry',
				'delete_posts'           => 'delete_entries',
				'delete_private_posts'   => 'delete_private_entries',
				'delete_published_posts' => 'delete_published_entries',
				'delete_others_posts'    => 'delete_others_entries',
				'edit_private_posts'     => 'edit_private_entries',
				'edit_published_posts'   => 'edit_published_entries'
			),
			'rewrite'									 => array(
				'slug'			 => 'entries',
				'with_front' => false,
				'pages' 	 	 => false,
			),
			'supports'            	   => array(
				'title',
				'revisions',
			),
			'labels'              	   => $labels,
		);

		register_post_type( 'ctba-entries', $args );

	}

	public function print_header_scripts() {

	}

	public function print_footer_scripts() {

	}

	public function entries_add_role_caps( $caps, $cap, $user_id, $args ) {

		$subRole = get_role( 'subscriber' );
		//print_r($subRole);
		//$subRole->remove_cap( 'read_entries' );
		//$subRole->remove_cap( 'create_entries' );
		//$subRole->remove_cap( 'edit_entries' );
		//$subRole->remove_cap( 'publish_entries' );

		/* If editing, deleting, or reading a entry, get the post and post type object. 		if ( 'edit_entry' == $cap || 'delete_entry' == $cap || 'read_entry' == $cap ) {
			$post = get_post( $args[0] );
			$post_type = get_post_type_object( $post->post_type );

			/* Set an empty array for the caps. */
			//$caps = array();
		//}*/


		/* If editing a entry, assign the required capability.
		if ( 'edit_entry' == $cap ) {
			if ( $user_id == $post->post_author )
				$caps[] = $post_type->cap->edit_posts;
			else
				$caps[] = $post_type->cap->edit_others_posts;
		}*/

		/* If deleting a entry, assign the required capability.
		elseif ( 'delete_entry' == $cap ) {
			if ( $user_id == $post->post_author )
				$caps[] = $post_type->cap->delete_posts;
			else
				$caps[] = $post_type->cap->delete_others_posts;
		}*/

		/* If reading a private entry, assign the required capability.
		elseif ( 'read_entry' == $cap ) {

			if ( 'private' != $post->post_status )
				$caps[] = 'read';
			elseif ( $user_id == $post->post_author )
				$caps[] = 'read';
			else
				$caps[] = $post_type->cap->read_private_posts;
		}*/

		/* Return the capabilities required by the user. */
		return $caps;
	}

	public function add_query_vars_filter( $vars ){
	  $vars[] = "entry";
	  return $vars;
	}

}


function ctba_enteries_init() {
	$CTBA_Entries = new CTBA_Entries();
}

add_action( 'plugins_loaded', 'ctba_enteries_init' );
