<?php
/*
Template Name: UOG_Test
*/
?>

<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		<h2><?php the_title(); ?></h2>
			<div class="entrytext">
				<?php uog_test(); ?>
			</div>
		</div>
	  <?php endwhile; endif; ?>
	</div>


<?php get_footer(); ?>
