<?php /* Template Name: Dashboard */

/**
 * Check the user is logged in
 */
if ( ! is_user_logged_in() ) {
	wp_redirect( home_url( $path = 'login' ) );
	exit;
}

/**
 * Get the users details
 */
//global $current_user;
//$current_user_info = get_currentuserinfo();

get_header(); ?>

<div id="primary" class="content-area">

<?php

function get_entry( $user_id ) {

	$custom_query = new WP_Query(
		array(
			'author'			=> $user_id,
			'post_type'		=> 'ctba-entries',
			'post_status' => array(
				'publish',
				'pending',
			),
			'nopaging'    => true,
		)
	);

	return $custom_query;

}

$get_entry = get_entry( $current_user->ID );

$current_user = wp_get_current_user();

?>


	<main id="main" class="box__large content__main wrapper cf" role="main">
	  <div class="wrapper__sub">
	    <article class="content__main ss1-ss4 ms1-ms6 ls1-ls12">
		<?php wp_nav_menu( array( 'theme_location' => 'nominate', ) ); ?>

		<header class="entry-header">
			<?php printf( '<h1 class="gamma heading--main entry-title">%1$s</h1>', __( 'Dashboard', 'ctba-2016' ) ); ?>
		<p><?php printf( __( 'Welcome, %1$s (not you <a href="%2$s">logout</a>).', 'ctba-2016' ), $current_user->display_name, esc_url( home_url( $path = 'logout' ) ) ); ?></p>

		</header><!-- .entry-header -->

		<div class="entry-content">

		<?php the_content(); ?>

		<?php if ( $get_entry->have_posts() ) : ?>
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

		<?php while ( $get_entry->have_posts() ) : $get_entry->the_post(); ?>

	<?php $query = site_url( '/nominate/entry/' );
	$new_query = add_query_arg( array(
	    'entry' => get_the_ID(),
	), $query );?>

		<tr id="entry-<?php the_ID(); ?>">
		<td><?php the_title( '<strong>', '</strong>' ); ?></td>
		<td></td>
		<td></td>
		<td><a href="<?php echo esc_url( $new_query ); ?>">Edit</a></td>
		</tr>

	<?php endwhile; ?>
	</tbody>
	</table>
	<?php wp_reset_postdata(); // reset the query ?>

<?php else : ?>
	<?php printf( '<button>%1$s</button>', esc_html__( 'Nominate your business', 'ctba-2016' ) ); ?>
<?php endif; ?>
		</div><!-- .entry-content -->


	    </article>

	  </div>
	</main>

</div><!-- .content-area -->

<?php get_footer(); ?>
