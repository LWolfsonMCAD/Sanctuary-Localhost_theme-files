<?php
/**
 * The template for displaying a static homepage with a slider of images.
 *
 * @package sanctuary
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

<?php
	// Check to make sure ACF plugin is activated
	if(!function_exists('get_field'))
		die('Error: please activate Advanced Custom Fields plugin');

	$args = array('pagename' => 'Home');
	$home = new WP_Query($args);
	while($home->have_posts()):
		$home->the_post();

	$carousel_images_max	= 5;
	$carousel_items 			= array();
	for($i=1; $i <= $carousel_images_max; $i++) {
		// Check to see if an image actually exists, if not then don't bother with caption or URL
		$img_attachment_id  = get_field('homepage-carousel-image-'.$i);
		if(!empty($img_attachment_id)) {
			$carousel_items[$i] = array(
				'image'	=> wp_get_attachment_image_src($img_attachment_id, 'full'),
				'caption'	=> (string) get_field('homepage-carousel-caption-'.$i),
				'tag'  => (string) get_field('homepage-carousel-tag-'.$i),
				'url'	=> (string) get_field('homepage-carousel-url-'.$i)
			);
		}
	}

	if(!empty($carousel_items)) {
		// check to see if we need to randomize the carousel items order
		$randomize_carousel = get_field('homepage-random-carousel-presentation');

		if((string) $randomize_carousel[0] == 'yes') {
			$carousel_items_keys = array_rand($carousel_items, count($carousel_items));
			shuffle($carousel_items_keys);
		}else
			$carousel_items_keys = array_keys($carousel_items);

?>
		<div id="image-carousel" class="flexslider">
			<ul class="slides">
<?php
		for($i=0; $i < count($carousel_items) ; $i++) {
			$image	= $carousel_items[$carousel_items_keys[$i]]['image'];
			$caption= $carousel_items[$carousel_items_keys[$i]]['caption'];
			$tag    = $carousel_items[$carousel_items_keys[$i]]['tag'];
			$url    = $carousel_items[$carousel_items_keys[$i]]['url'];

?>
			<li>
				<?php if(!empty($url)): ?>
					<a href="<?php echo $url; ?>" title="<?php echo $caption; ?>">
						<img src="<?php echo $image[0]; ?>" alt="Carousel Image" />
					</a>
				<?php else: ?>
					<img src="<?php echo $image[0]; ?>" alt="Carousel Image" />
				<?php endif; ?>
				<?php if(!empty($caption)): ?>
					<p class="flex-caption"><?php echo $caption; ?></p>
				<?php endif; ?>
				<?php if(!empty($tag)): ?>
					<p class="flex-tag"><?php echo $tag; ?></p>
				<?php endif; ?>
			</li>
<?php
		}
?>
			</ul>
		</div><!-- /#image-carousel -->
<?php
	}

	endwhile;
	wp_reset_query();
?>

		</main> <!-- #main -->
	</div>  <!-- div -->


<?php get_footer(); ?>	
