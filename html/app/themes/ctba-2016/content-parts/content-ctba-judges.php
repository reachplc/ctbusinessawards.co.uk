<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ctba-2016
 */

?>

<li class="block judges-item box">
  <a href="<?php echo esc_url( get_permalink() ); ?>">
    <?php if ( has_post_thumbnail() ) { ?>
		<figure>
    <?php
    the_post_thumbnail(
    	array(300,373),
    	array(
    		'class' => 'image image__responsive'
    	)
    ); ?>
      <!--<img class="image image__responsive" src="<?php echo esc_url( get_permalink() ); ?>" alt="Profile photo of <?php the_title(); ?>">-->
      <figcaption class="gamma judge__name"><?php the_title(); ?></figcaption>
    </figure>
    <?php } ?>
  </a>
</li>
