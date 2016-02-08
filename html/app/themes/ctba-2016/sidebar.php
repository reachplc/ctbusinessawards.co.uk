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
?>

<aside id="secondary" class="widget-area" role="complementary">


<article class="box separator--horizontal" itemscope itemtype="http://schema.org/Event">
  <h3 class="gamma heading--main">Awards Ceremony</h3>

  <img class="image image__responsive" src="<?php echo get_template_directory_uri(); ?>/gui/venue_ricoh-arena.jpg" alt="">

  <h4 itemprop="startDate" content="2016-06-17">Friday, 17&nbsp;June&nbsp;2016</h4>
  <p itemprop="location" itemscope itemtype="http://schema.org/Place">
  <span itemprop="streetAddress"><strong>Ricoh&nbsp;Arena</strong><br>
  Phoenix&nbsp;Way</span>, <span itemprop="addressLocality">Coventry</span>. <span itemprop="postalCode">CV6&nbsp;6GE</span></p>
  <!--<p itemprop="offers" itemscope itemtype="http://schema.org/Offer">
   <a itemprop="url" class="btn btn--primary btn__full" href="{{ site.url }}/tickets/">Book your tickets/table&nbsp;now</a>
 </p>-->
</article>


<article class="box separator--horizontal">

  <h4 class="gamma heading--main">#CTBA2016 / #PrideofCov</h4>

  <a class="twitter-timeline" data-dnt="true" href="https://twitter.com/search?q=%23CBTA2016%20OR%20%23PrideofCov%20lang%3Aen%20exclude%3Aretweets" data-widget-id="565108174064463873">Tweets about #CBTA2016 OR #PrideofCov lang:en exclude:retweets</a>
  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

</article>

</aside><!-- #secondary -->
