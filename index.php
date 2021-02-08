<?php get_header(); ?>
<div class = "line banerLine">
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
		
		<div class="slider-box">
			<div class="slider">  
				<div id = "b1" class = "wrImg">
					<div class = "banerText">
						<span>Наружная</span>
						<span>Реклама</span>
						<span class = "spanBig">OUTDOOR</span>
					</div>
				</div>
				
				<div id = "b2" class = "wrImg">
					<div class = "banerText">
						<span>Наружная</span>
						<span>Реклама</span>
						<span class = "spanBig">OUTDOOR</span>
					</div>
				</div>
				
				<div id = "b3" class = "wrImg">
					<div class = "banerText">
						<span class = "spanBig">Печать</span>
						<span>Широкоформатная</span>
						<span>Интерьерная</span>
					</div>				
				</div>
				
				<div id = "b4" class = "wrImg">
					<div class = "banerText">
						<span class = "spanBig">Производство</span>
						<span>Наружной</span>
						<span>Рекламы</span>
					</div>				
				</div>
			 </div>
			<ul class="bullets"></ul>
			<div class = "banerRowBox">
				<div class="prev"></div>
				<div class="next"></div>
			</div>
		</div>

</div>

<div class = "line ukazatelLine">
	<div class = "centerLine">
		<div class = "ukazatel">
			<a href = "<?php echo the_permalink(7);?>">
				<div class = "uk">
					<div class = "iconUkazatel" id = "iu1"> </div>
					БОЛЕЕ 20 ЛЕТ<br />
					ОПЫТА УСПЕШНОЙ<br />
					РАБОТЫ<br /><br />
					<span class = "podrobnee">Подробнее >></span>
				</div>
			</a>
			
			<a href = "<?php echo the_permalink(14);?>">
				<div class = "uk">
					<div class = "iconUkazatel" id = "iu2"></div>
					ПРАВИЛЬНЫЙ<br />
					ПОДБОР РЕКЛАМНЫХ<br />
					ПОВЕРХНОСТЕЙ<br /><br />
					<span class = "podrobnee">Подробнее >></span>
				</div>
			</a>
			
			<a href = "<?php echo the_permalink(17);?>">
				<div class = "uk">
					<div class = "iconUkazatel" id = "iu3"></div>
					ОПЕРАТИВНАЯ ПЕЧАТЬ И <br />
					РАЗМЕЩЕНИЕ<br /> 
					РЕКЛАМЫ<br /><br />
					<span class = "podrobnee">Подробнее >></span>
				</div>
			</a>
			
			<a href = "http://www.xn--80aanazgicku.xn--p1ai/">
				<div class = "uk">
					<div class = "iconUkazatel" id = "iu4"></div>
					ПРОИЗВОДСТВО <br />
					ВЫВЕСОК С <br />
					ГАРАНТИЕЙ<br /><br />
					<span class = "podrobnee">Подробнее >></span>
				</div>
			</a>
		</div>
	</div>
</div>

<div class = "line mainTextLine contentAllLine">
	<div class = "centerLine">
		<div class = "columns">
			<div class = "col">
				<span class = "exc"><strong>Главный принцип в работе компания</strong> — Поиск наиболее эффективного решения задачи по размещению наружной рекламы, учитывая все особенности и пожелания клиента</span>
				<?php if( function_exists( "iinclude_page" ) ) iinclude_page( 27 ); ?>
			</div>
			
			<div class = "col">
				<?php if( function_exists( "iinclude_page" ) ) iinclude_page( 31 ); ?>
			</div>
		</div>
	</div>	
</div>	

<div class = "line grayIconLine">
	<div class = "centerLine">
		<h2>Рекламное агентство полного цикла</h2>
		<div class = "geElements">
			<div class = "geElem">
				<div class = "icon" id = "icon1"></div>
				Ваш звонок <br />или заяка <br />на сайте
			</div>
			
			<div class = "geElem">
				<div class = "icon" id = "icon2"></div>
				Подбор <br />адресной <br />программы
			</div>
			
			<div class = "geElem">
				<div class = "icon" id = "icon3"></div>
				Заключение <br />договора
			</div>
			
			<div class = "geElem">
				<div class = "icon" id = "icon4"></div>
				Согласование <br />макета
			</div>
			
			<div class = "geElem">
				<div class = "icon" id = "icon5"></div>
				Производство <br />рекламных <br />материалов
			</div>
			
			<div class = "geElem">
				<div class = "icon" id = "icon6"></div>
				Монтаж <br />рекламной <br />кампании
			</div>
		</div>
	</div>
</div>
<div class = "line slider-line">
	<div class = "centerLine">
		<div class="slider-line__head">
			<div class="slider-line__head-left">
				<div class="slider-line__head-img"></div>
				<div class="slider-line__head-left-title">Наши</div>
			</div>
			<div class="slider-line__head-right">
				<div class="">Партнеры</div>
				<div class="">Рекламодатели</div>
			</div>
		</div>
		<div class="partners-wrapper">
			<div class="partners-item" style="background-image: url(<?php echo get_template_directory_uri();?>/images/clients/bee.jpg);"></div>
			<div class="partners-item" style="background-image: url(<?php echo get_template_directory_uri();?>/images/clients/5.jpg);"></div>
			<div class="partners-item" style="background-image: url(<?php echo get_template_directory_uri();?>/images/clients/ler.jpg);"></div>
			<div class="partners-item" style="background-image: url(<?php echo get_template_directory_uri();?>/images/clients/mts.jpg);"></div>
			<div class="partners-item" style="background-image: url(<?php echo get_template_directory_uri();?>/images/clients/per.jpg);"></div>
			<div class="partners-item" style="background-image: url(<?php echo get_template_directory_uri();?>/images/clients/mvd.jpg);"></div>
			<div class="partners-item" style="background-image: url(<?php echo get_template_directory_uri();?>/images/clients/mgf.jpg);"></div>
			<div class="partners-item" style="background-image: url(<?php echo get_template_directory_uri();?>/images/clients/mnt.jpg);"></div>
			<div class="partners-item" style="background-image: url(<?php echo get_template_directory_uri();?>/images/clients/met.jpg);"></div>
		</div>
		<!-- <div class="slider-partners">
			<div class="slider-partners__item" style="background-image: url(<?php echo get_template_directory_uri();?>/images/clients/5.jpg);"></div>
			<div class="slider-partners__item" style="background-image: url(<?php echo get_template_directory_uri();?>/images/clients/bee.jpg);"></div>
			<div class="slider-partners__item" style="background-image: url(<?php echo get_template_directory_uri();?>/images/clients/ler.jpg);"></div>
			<div class="slider-partners__item" style="background-image: url(<?php echo get_template_directory_uri();?>/images/clients/met.jpg);"></div>
			<div class="slider-partners__item" style="background-image: url(<?php echo get_template_directory_uri();?>/images/clients/mgf.jpg);"></div>
			<div class="slider-partners__item" style="background-image: url(<?php echo get_template_directory_uri();?>/images/clients/mnt.jpg);"></div>
			<div class="slider-partners__item" style="background-image: url(<?php echo get_template_directory_uri();?>/images/clients/mts.jpg);"></div>
			<div class="slider-partners__item" style="background-image: url(<?php echo get_template_directory_uri();?>/images/clients/mvd.jpg);"></div>
			<div class="slider-partners__item" style="background-image: url(<?php echo get_template_directory_uri();?>/images/clients/per.jpg);"></div>
		</div> -->
	</div>
</div>
	
<?php get_footer(); ?>