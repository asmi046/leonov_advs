<?php
/*
Template Name: Контакты
*/
?>

<?php get_header(); ?>
	<?php include_once("menuLine.php"); ?>
	<div class = "line contentAllLine contentAllPage">
		<div class = "centerLine">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class = "content reklamaBlk">
				<h1><?php the_title();?></h1>
				<?php the_content();?>
				<div class="clearfix"></div>
				<div class="contacts-map">
					<div class="contacts-map__photo"></div>
					<div class="contacts-map__map" id="contacts-map__map"></div>
					<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
					<script>
					  ymaps.ready(init);

					  function init () {
						
						  var myMap = new ymaps.Map("contacts-map__map", {
								  center: [51.75939757223645,36.19868350000001],
								  zoom: 17,
								  controls: ['zoomControl']
							  }),

							myPlacemarkAdr = new ymaps.Placemark([51.75939757223645,36.19868350000001], {
								  iconContent: '',
								  balloonContent: 'Наш адрес: <b>г. Курск, ул. Хуторская д. 49</b><br/>Телефон: <b> 7 (4712) 50-03-03',
								  hintContent: 'Наш адрес: <b>г. Курск, ул. Хуторская д. 49</b><br/>Телефон: <b> 7 (4712) 50-03-03',
							  }, {
								iconLayout: 'default#image',
								iconImageHref: '<?php bloginfo("template_url"); ?>/images/logo-map.svg',
								iconImageSize: [80, 74],
								iconImageOffset: [-15, -54]
							  });
							  
							  myMap.geoObjects.add(myPlacemarkAdr);
							  
							
							
							


						myMap.behaviors.disable('scrollZoom');
					  }
					</script>
				</div>
			</div>
			<?php endwhile;?>
			<?php endif; ?>
		</div>
	</div>
<?php get_footer(); ?>