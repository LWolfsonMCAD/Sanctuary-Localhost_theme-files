<?php
/**
* Template Name: Studio Cabin
*/
?>
<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		

		<?php while ( have_posts() ) : the_post(); ?>
		
		<div class="cabin-post-background">
			<?php 
				if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				the_post_thumbnail();
			} ?>	
		</div>		

		<div class="cabin-breakdown">

			<div class="cabin-post-gallery">
				<?php if (function_exists('slideshow')) { slideshow($output = true, $gallery_id = false, $post_id = false, $params = array()); } ?>
 
			</div>

			<div class="cabin-information">

			<h1><?php the_title(); ?></h1>
			
				<div class="cabin-description">
					<?php the_field('cabin_description'); ?>
				</div>

				<div class="art-making-features">
					<h2>Art making features&#58;</h2>
					<?php the_field('art_making_features'); ?>
				</div>

				<div class="standard-cabin-features">
					<h2>Standard cabin features include&#58;</h2>
					<?php the_field('standard_cabin_features'); ?>
				</div>

				<div class="cabin-rental-cost">
					<p>Once accepted (application process)&#58;</p>
					<?php the_field('cabin_rental_cost'); ?>
				</div>

				<div class="check-availability-button">
					<?php the_field('check_availability'); ?>
				</div>
			</div>
		</div>
			<!-- <p><?php the_content(); ?></p> -->

		<?php endwhile; // end of the loop. ?>


    
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>