<?php
/*
Template Name: Страница без сайдбара
*/
?>
<?php get_header(); ?>
	<?php include_once("menuLine.php"); ?>
	
	<div class = "line contentAllLine contentAllPage">
		<div class = "centerLine ">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
			<div id = "noBlk" class = "content ">
				
				<h1><?php the_title();?></h1>
				<?php the_content();?>
					
			</div>
			<?php endwhile;?>
			<?php endif; ?>
		</div>	
	</div>
	
<?php get_footer(); ?>