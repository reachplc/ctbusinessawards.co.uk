<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ctba-2016
 */

?>

<li class="block partners-item box separator--horizontal">
  <aside class="block__aside partners-item__aside">
    <?php if ( has_post_thumbnail() ) : ?>
    <a href="<?php echo esc_url( get_permalink() ); ?>">
      <?php the_post_thumbnail(
    	array(195),
    	array(
    		'class' => 'image__responsive'
    	)
    ); ?>
    </a>
  <?php endif; ?>
  </aside>
  <articles class="block__content partners-item__content">
    <h3><?php the_title(); ?></h3>
    <!--<p>{{ partner.description }}</p>-->
    <p><a href="<?php echo esc_url( get_permalink() ); ?>">View Profile</a><?php if( get_field('ctba-partners-url')):?> | <a target="_blank" class="outbound link" href="<?php echo get_field('ctba-partners-url'); ?>" rel="nofollow">View Website</a><?php endif; ?></p>
  </articles>
</li>
