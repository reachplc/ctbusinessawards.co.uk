<?php /* Template Name: Login */

if ( is_user_logged_in() ) {
  wp_redirect( home_url( '/') );
  exit;
}

get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="content__main wrapper cf" role="main">
		  <div class="wrapper__sub">
		    <article class="ss1-ss4 ms1-ms6 ls1-ls12 module login-form">

		    <?php the_title( '<h1 class="gamma heading--main page-title">', '</h1>'); ?>

				<p><?php printf( __( 'Not got an account? <a href="%1$s">Click here to register</a>.', 'ctba-2016' ), home_url( $path = 'register/' ) ); ?></p>

		    <form id="member-login" action="<?php echo home_url( 'wp-login.php' ); ?>" method="POST" enctype="multipart/form-data">
	        <fieldset id="account-details">
	          <label for="log"><?php _e( 'Username', 'ctba-2016' ); ?></label>
	          <input type="text" name="log" id="log" required>

	          <label for="pwd"><?php _e( 'Password', 'ctba-2016' ); ?></label>
	          <input type="password" name="pwd" id="pwd" required>

	          <label class="checkbox"><input type="checkbox" name="rememberme" value="forever"> <?php _e( 'Remember Me', 'ctba-2016' ); ?></label>

	          <input type="hidden" name="redirect_to" value="<?php echo home_url( 'nominate/' ); ?>">

	          <button class="btn btn__large btn--primary" type="submit" name="submit" id="submit"><?php _e( 'Login', 'ctba-2016' ); ?></button>
	        </fieldset>
		    </form>

		    </article>
		  </div>
		</main>

	</div><!-- .content-area -->

<?php get_footer(); ?>
