<div class = "line BanerLinePage">
	<!-- <div class = "centerLine"> -->
		<div class = "logoLine">
			<a href = "<?php bloginfo("url")?>"><img class = "logo" src = "<?php bloginfo("template_url")?>/images/logo.png" /></a>
			<div class = "meuBtn"><i class="fa fa-bars" aria-hidden="true"></i></div>
			<div class = "logoMenu">
				<?php wp_nav_menu( array('menu' => 'Меню рядом с лого', 'container' => false )); ?>
			</div>
			<?php $options = get_option( 'wpuniq_theme_options' ); ?>
			<div class = "phoneInHead">
				<?php echo $options["phone"]; ?>
			</div>
		</div>
	<!--</div>-->
</div>