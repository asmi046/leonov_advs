<?php get_header(); ?>
	<?php include_once("menuLine.php"); ?>
	
	<div class = "line contentAllLine contentAllPage">
		<div class = "centerLine">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class = "sidebar">
				<ul class = "leftMenu">
				
				
				<li class = "sideList <?php  if (get_the_ID() == 17) echo "sideListCurent"; ?>" ><a href = "<?php echo get_the_permalink(17);?>">Широкоформатная печать</a></li>
				
				
				<?php
					$args = array(
						'sort_order'   => 'ASC',
						'sort_column'  => 'post_date',
						'hierarchical' => 1,
						'child_of'     => 17,
						'post_type'    => 'page',
						'post_status'  => 'publish',
					); 
					$p = get_pages( $args );
					foreach( $p as $pelem ){
					
					?>
						<li class = "sideList <?php if (get_the_ID() == $pelem->ID) echo "sideListCurent"; ?>" ><a href = "<?php echo get_the_permalink($pelem->ID);?>"><?php echo $pelem->post_title;?></a></li>
					<?php
						}
					?>
					
					<li class = "sideList <?php  if (get_the_ID() == 11) echo "sideListCurent"; ?>" ><a href = "<?php echo get_the_permalink(11);?>">On-Line продажи</a></li>
				</ul>
				
				<span class = "exc" id = "excPage">Мы печатаем <br /><strong>В день заказа!</strong></span>
			</div>
			<div class = "content">
				
						<h1><?php the_title();?></h1>
						<?php the_content();?>
					
			</div>
			<?php endwhile;?>
			<?php endif; ?>
		</div>	
	</div>
	
<?php get_footer(); ?>