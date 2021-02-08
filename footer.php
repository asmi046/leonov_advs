<div class = "line footerline">
	<div class = "centerLine">
		<div class = "footerElems">
			<div class = "fElem">
				<h2>О компании</h2>
				<a href = "#">История</a>
				<a href = "#">Руководство</a>
				<a href = "#">Социальные пректы</a>
				<a href = "#">Вакансии</a>
			</div>
			
			<div class = "fElem">
				<h2>Наружная реклама OUTDOOR</h2>
				<a href = "<?php echo get_the_permalink(14); ?>">Билборды</a>
				<a href = "<?php echo get_the_permalink(14); ?>">Призматроны</a>
				<a href = "<?php echo get_the_permalink(14); ?>">Сити-постеры</a>
				<a href = "<?php echo get_the_permalink(14); ?>">Перетяжки</a>
			</div>
			
			<div class = "fElem">
				<h2>Печать</h2>
				<a href = "<?php echo get_the_permalink(17); ?>">Широкоформатная</a>
				<a href = "<?php echo get_the_permalink(40); ?>">Интерьерная</a>
			</div>
			
			<div class = "fElem">
				<h2>Производство наружной рекламы</h2>
				<a href = "http://www.неореклама.рф/uslugi">Вывески</a>
				<a href = "http://www.неореклама.рф/uslugi/77-kryshnye-ustanovki">Крышные установки</a>
				<a href = "http://www.неореклама.рф/uslugi">Указатели</a>
				<a href = "http://www.неореклама.рф/uslugi/388-adresnye-tablichki">Таблички</a>
			</div>
			
			<div class = "fElem">
				<h2>Тех. Требования</h2>
				<a href = "<?php echo get_the_permalink(72); ?>">Технические требования к плакатам для размещения</a>
				<a href = "<?php echo get_the_permalink(74); ?>">Технические требования к файлам для печати</a>
			</div>
			
			<div class = "fElem">
				<h2>Контакты</h2>
				<?php $options = get_option( 'wpuniq_theme_options' ); ?>
				<strong>Адрес:</strong> <?php echo $options["adres"]; ?><br/>
				<strong>Телефон:</strong> <?php echo $options["phone"]; ?><br/>
				<strong>e-mail:</strong> <?php echo $options["mail"]; ?><br/>
			</div>
		</div>
	</div>
</div>
	<div class = "line footerLineAutor"> 
		Разработка сайта <a href = "https://asmi-studio.ru/">Asmi-Studio</a>
	</div>
</div>
	

<?php wp_footer(); ?>
</body>
</html>