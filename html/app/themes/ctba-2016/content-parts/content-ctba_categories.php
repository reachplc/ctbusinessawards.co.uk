<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ctba-2016
 */

?>

<li class="block category-item">
  <aside class="block__aside category-item__aside">
  <a href="<?php echo esc_url( get_permalink() ); ?>">
    <span class="icon sprite__category sprite__category--<?php echo get_post( get_the_ID() )->post_name; ?>"></span>
  </a>
  </aside>
  <p class="block__content category-item__title">
    <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
  </p>
</li>

