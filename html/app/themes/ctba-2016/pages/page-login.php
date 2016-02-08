<?php /* Template Name: Login */

if (is_user_logged_in()) {
  wp_redirect( home_url() );
  exit;
}

get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="content__main wrapper cf" role="main">
		  <div class="wrapper__sub">
		    <article class="ss1-ss4 ms1-ms6 ls1-ls12 module login-form">

		    <h1>Log in to your account</h1>
				<p>Not ogt an account? <a href="<?php echo get_site_url(); ?>/register/">Click here to register</a>.</p>

		    <form id="member-login" action="<?php echo get_site_url(); ?>/wp-login.php" method="POST" enctype="multipart/form-data">
	        <fieldset id="account-details">
	          <label for="log">Username</label>
	          <input type="text" name="log" id="log">

	          <label for="pwd">Password</label>
	          <input type="password" name="pwd" id="log">

	          <label class="checkbox"><input type="checkbox" name="rememberme" value="forever">Remember Me</label>

	          <input type="hidden" name="redirect_to" value="<?php echo get_site_url(); ?>/nominate/">

	          <button type="submit" name="submit" id="submit">Log In</button>
	        </fieldset>
		    </form>

		    </article>
		  </div>
		</main>

	</div><!-- .content-area -->

<?php get_footer(); ?>
