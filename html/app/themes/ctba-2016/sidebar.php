<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ctba-2016
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

$event_tickets = false;

?>

<aside id="secondary" class="widget-area" role="complementary">

<article class="box separator--horizontal" itemscope itemtype="http://schema.org/Event">

	<?php // @TODO allow user to change details via admin ?>

  <h3 class="gamma heading--main">Awards Ceremony</h3>

  <img class="image image__responsive" src="<?php echo esc_url( get_template_directory_uri() .'/gui/venue_ricoh-arena.jpg' ); ?>" alt="">

  <h4 itemprop="startDate" content="2016-10-20T16:30">Thursday, 20&nbsp;October&nbsp;2016</h4>
  <p itemprop="location" itemscope itemtype="http://schema.org/Place">
  <strong itemprop="name">Ricoh&nbsp;Arena</strong>, <span itemprop="streetAddress">Phoenix&nbsp;Way</span>,<br>
	<span itemprop="addressLocality">Coventry</span>. <span itemprop="postalCode">CV6&nbsp;6GE</span></p>
	<p>Champagne reception from <span itemprop="doorTime" content="18:30">6:30pm</span>.</p>
	<?php if ( true === $event_tickets ) { ?>
	<p itemprop="offers" itemscope itemtype="http://schema.org/Offer">
	<a itemprop="url" class="btn btn--primary btn__full" href="{{ site.url }}/tickets/">Book your tickets/table&nbsp;now</a>
	</p>
	<?php } ?>
</article>


<article class="box separator--horizontal">

  <h4 class="gamma heading--main">#CTBA2016 / #PrideofCov</h4>

  <a class="twitter-timeline" data-dnt="true" href="https://twitter.com/search?q=%23CTBA2016%20OR%20%23PrideofCov%20AND%20lang%3Aen%20AND%20exclude%3Aretweets" data-widget-id="750697556003450880">Tweets about #CBTA2016</a>
  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

</article>

</aside><!-- #secondary -->
