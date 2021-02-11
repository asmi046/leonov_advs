<?php
/*
Template Name: Просмотр рекламного блока
*/
?>
<?php get_header("oneblk"); ?>


<div class = "line contentAllLine contentAllPage">
	<div class = "centerLine">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div class = "content reklamaBlk one-reklamaBlk">

				<?php
				//global $wpdb;
				$wpdb_main = new wpdb( 'leonovadv_asmi', 'JfxnYyFums', 'leonovadv_asmi', 'localhost' );
				$Ref = !empty($_REQUEST["a"])?"%".$_REQUEST["a"]."%":"%";			
				$result = $wpdb_main->get_results( "SELECT * FROM `transfet_base` WHERE `Ref` LIKE '".$Ref."' ORDER BY `transfet_base`.`Description` ASC" );
				?>

				<h1><?php the_title(); ?>: <span style = "color:black; text-transform:none;"><?php echo $result[0]->Description;?></span></h1>

				<?php the_content();?>
				<!-- 	</script> -->
				<script> 

					// function repaintPlex() {
					// 	myMap.geoObjects.each(function (geoObject) {
					// 		if (selected.indexOf(geoObject.properties.get('id')) != -1) 
					// 		{
					// 			geoObject.options.set('preset', 'islands#greenDotIcon');
					// 			$(".CartBtn"+geoObject.properties.get('id')).css("color", "red");
					// 		} else  geoObject.options.set('preset', 'islands#blueDotIcon')});
					// 	if (selected.length == 0)
					// 		$(".bscetCount").html("Корзина пуста");
					// 	else $(".bscetCount").html("Выбрано конструкций: "+selected.length);
					// }

					// var selected = [];
					// var selectedTmp = $.cookie('plbascet').split(',');

					// if (selectedTmp[0] == 0) selectedTmp = [];

					// for (i = 0; i<selectedTmp.length; i++)
					// 	selected.push(Number(selectedTmp[i]));

					// console.log(selected);

					function addPlex(index) {

						if (selected.indexOf(index) < 0)
						{
							selected.push(index);
							console.log(selected);
							$(".CartBtn"+index).css("color", "red");
						} else {
							selected.splice(selected.indexOf(index),1);
							console.log(selected);
							$(".CartBtn"+index).css("color", "green");
						}

						$.cookie('plbascet', selected, {path: '/'});

						repaintPlex();
					}

				</script>

				<div class = "mapBlk mapBlk-oneBlk">
					<?php

					$mapStr = "";
					// // $tableStr .= "<div>";
					// // $tableStr .= "<tr>";
					// // $tableStr .= "<th style = 'border-left: 1px solid lightgray;' id = 'cl0h'>&nbsp;</th>";

					// $tableStr .= "<th id = 'cl3h'>Адрес</th>";
					// $tableStr .= "<th id = 'cl4h'>Тип конструкции</th>";
					// $tableStr .= "<th id = 'cl5h'>Освещение</th>";
					// $tableStr .= "<th id = 'cl6h'>Код</th>";
					// $tableStr .= "<th id = 'cl7h'>GRP</th>";
								//$tableStr .= "<th id = 'cl8h'>Цена</th>";
					// $tableStr .= "</div";
					// $tableStr .= "</div>";
					// $tableStr .= "<tbody style = 'width: 98.5%;     height: 40vh;'>";


					$i =1;

					foreach ($result as $row) {
						$osveshenie = true;
						if ($row->Osveshenie === "true") $osveshenie = "Да";
						else $osveshenie = "Нет";

						if (!empty($row->Koordinati)) {
							$mapStr .= "myPlacemark".$row->id." = new ymaps.Placemark(".$row->Koordinati.", {\r\n";
							$mapStr .= "balloonContent: '<b>Адрес:</b> ".$row->Description."<br/> <b>Тип:</b>  ".$row->Type."  <span class = \'btnsUpr\'><i onclick = \'addPlex(".$row->id.");\'; title = \'Добавить в корзину\'class=\'toCartBtn  CartBtn CartBtn".$row->id." fa fa-shopping-cart\' aria-hidden=\'true\'></i></span>',\r\n";
							$mapStr .= "id: ".$row->id;

							$mapStr .= "},\r\n";
							$mapStr .= "{preset:'islands#blueDotIcon'}\r\n";
							$mapStr .= ");\r\n";

							$mapStr .= " myPlacemark".$row->id.".events.add('click', function (e) {\r\n";

							$mapStr .= " if (selected.indexOf(myPlacemark".$row->id.".properties.get('id')) < 0)\r\n";
							$mapStr .= "myPlacemark".$row->id.".properties.set('balloonContent', '<b>Адрес:</b> ".$row->Description."<br/> <b>Тип:</b>  ".$row->Type."  <span class = \'btnsUpr\'><i onclick = \'addPlex(".$row->id.");\'; title = \'Добавить в корзину\'class=\'toCartBtn  CartBtn CartBtn".$row->id." fa fa-shopping-cart\' aria-hidden=\'true\'></i></span>');\r\n";
							$mapStr .= "else \r\n";
							$mapStr .= "myPlacemark".$row->id.".properties.set('balloonContent', '<b>Адрес:</b> ".$row->Description."<br/> <b>Тип:</b>  ".$row->Type."  <span class = \'btnsUpr\'><i onclick = \'addPlex(".$row->id.");\'; title = \'Добавить в корзину\'class=\'outCartBtn  CartBtn CartBtn".$row->id." fa fa-shopping-cart\' aria-hidden=\'true\'></i></span>');\r\n";

							$pictureSiteUrl = "//leonovadv.ru/";
							$MapImg = $pictureSiteUrl."/images/no-photo.png";
							if (!empty($row->Img))
							{
								$MapImg = $pictureSiteUrl."/transfer/".$row->Img;


							} else 
							if (!empty($row->ImgMap))
								$MapImg = get_bloginfo("url")."/transfer/".$row->ImgMap;
							$msgText = "Код: ".$row->Code." Тип конструкции : ".$row->Type." Описание: ".$row->Description." Город: ".$row->Gorod." Район".$row->Raion;

							$mapStr .= "$('#mestoImg img').attr('src', '".$MapImg."');\r\n";
							$mapStr .= "$('#mestoKode').html('".$row->Code."');\r\n";
							$mapStr .= "$('#mestoType').html('".$row->Type."');\r\n";
							$mapStr .= "$('#mestoSvet').html('".$osveshenie."');\r\n";
							$mapStr .= "$('#mestoAdres').html('".$row->Description."');\r\n";
							$mapStr .= "$('#mestoGorod').html('".$row->Gorod."');\r\n";
							$mapStr .= "$('#mestoRaion').html('".$row->Raion."');\r\n";
							$mapStr .= "$('#mestoGRP').html('".$row->GRP."');\r\n";
							$mapStr .= "$('#mestoPrice').html('".$row->Price."');\r\n";
							$mapStr .= "$('#aMesto').html('".$msgText."');\r\n";
							$mapStr .= "$('.tableBlk table tbody').scrollTop($('#".$row->id."').position().top+$('.tableBlk table tbody').scrollTop()-50);  console.log($('#".$row->id."').position().top); \r\n";
							$mapStr .= "myMap.setCenter(myPlacemark".$row->id.".geometry.getCoordinates(), 18); \r\n";
							$mapStr .= "myMap.geoObjects.each(function (geoObject) {repaintPlex();}); \r\n";
							$mapStr .= "myPlacemark".$row->id.".options.set('preset', 'islands#redDotIcon'); \r\n";

							$mapStr .= "$('.tableBlk table tbody tr').removeClass('trSelect'); \r\n";
							$mapStr .= "$('#".$row->id."').addClass('trSelect'); \r\n";
							$mapStr .= "}, this); \r\n";
							$mapStr .= " myMap.geoObjects.add(myPlacemark".$row->id."); \r\n";
						}


					$tableStr .= "<div class='tabl-flex'>";
					$tableStr .= "<div id = 'cl1h' class='tabl-flex__1 tabl-flex__gr'>Город</div>";
					$tableStr .= "<div id = 'cl1' class='tabl-flex__2 tabl-flex__gr'>".$row->Gorod."</div>";
					$tableStr .= "</div>";

					$tableStr .= "<div class='tabl-flex'>";
					$tableStr .= "<div id = 'cl2h' class='tabl-flex__1'>Район</div>";
					$tableStr .= "<div id = 'cl2' class='tabl-flex__2'>".$row->Raion."</div>";
					$tableStr .= "</div>";

					$tableStr .= "<div class='tabl-flex'>";
					$tableStr .= "<div id = 'cl3h' class='tabl-flex__1 tabl-flex__gr'>Адрес</div>";
					$tableStr .= "<div id = 'cl3' class='tabl-flex__2 tabl-flex__gr'>".$row->Description."</div>";
					$tableStr .= "</div>";

					$tableStr .= "<div class='tabl-flex'>";
					$tableStr .= "<div id = 'cl4h' class='tabl-flex__1'>Тип конструкции</div>";
					$tableStr .= "<div id = 'cl4' class='tabl-flex__2'>".$row->Type."</div>";
					$tableStr .= "</div>";

					$tableStr .= "<div class='tabl-flex'>";
					$tableStr .= "<div id = 'cl5h' class='tabl-flex__1 tabl-flex__gr'>Освещение</div>";
					$tableStr .= "<div id = 'cl5' class='tabl-flex__2 tabl-flex__gr'>".$osveshenie."</div>";
					$tableStr .= "</div>";

					$tableStr .= "<div class='tabl-flex'>";
					$tableStr .= "<div id = 'cl6h' class='tabl-flex__1'>Код</div>";
					$tableStr .= "<div id = 'cl6' class='tabl-flex__2'>".$row->Code."</div>";
					$tableStr .= "</div>";

					$tableStr .= "<div class='tabl-flex'>";
					$tableStr .= "<div id = 'cl7h' class='tabl-flex__1 tabl-flex__gr'>GRP</div>";
					$tableStr .= "<div id = 'cl7' class='tabl-flex__2 tabl-flex__gr'>".$row->GRP."</div>";
					$tableStr .= "</div>";

						// $tableStr .= "<td id = 'cl3' class = 'tdDesc cl3'>".$row->Description."</td>";
						// $tableStr .= "<td id = 'cl4' class = 'tdType cl4'>".$row->Type."</td>";

						// $tableStr .= "<td id = 'cl5' class = 'tdOsveshenie  cl5'>".$osveshenie."</td>";
						// $tableStr .= "<td id = 'cl6' class = 'tdCode cl6'>".$row->Code."</td>";
						// $tableStr .= "<td id = 'cl7' class = 'tdGRP cl7'>".$row->GRP."</td>";
						// 				//$tableStr .= "<td id = 'cl8' class = 'tdPrice cl8'>".$row->Price."</td>";
						// $tableStr .= "<td id = 'cl9' class = 'tdImg cl9'>".$MapImg."</td>";
						// $tableStr .= "</tr>";


						$i++;
					}

					$tableStr .= "</div>";
					$tableStr .= "</div>";
					?>
					<script>	

						$(document).ready(function() { 
							jQuery(".zayavkaMesto111111").click(function(){ 
								jQuery("#zayavkaForm").show("slide");
								msgText = "";
								for (var i = 0; i < selected.length; i++)
								{
									msgText += "Код: "+$(".tableBlk #"+selected[i]+" .tdCode").html()
									+" Тип конструкции: "+$(".tableBlk #"+selected[i]+" .tdType").html()
									+" Описание: "+$(".tableBlk #"+selected[i]+" .tdDesc").html()
									+" Город: "+$(".tableBlk #"+selected[i]+" .tdGorod").html()
									+" Район: "+$(".tableBlk #"+selected[i]+" .tdRaion").html()+"\n\r";
									$('#aMesto').html(msgText);
								}
							});

							
							$(".tableBlk table tbody tr").click(function(){ 
								idpl = $(this).attr("id");

								$(".tableBlk table tbody tr").removeClass('trSelect');
								$(this).addClass('trSelect');

								myMap.geoObjects.each(function (geoObject) {
									geoObject.options.set('preset', 'islands#blueDotIcon');

									if (geoObject.properties.get('id') == idpl) {
										myMap.balloon.close();
										myMap.setCenter(geoObject.geometry.getCoordinates(), 18);

										geoObject.options.set('preset', 'islands#redDotIcon');
										console.log("red");

										$('#mestoImg img').attr('src', $("#"+idpl).find(".tdImg").html());
										$('#mestoKode').html($("#"+idpl).find(".tdCode").html());
										$('#mestoType').html($("#"+idpl).find(".tdType").html());
										$('#mestoSvet').html($("#"+idpl).find(".tdOsveshenie").html());
										$('#mestoAdres').html($("#"+idpl).find(".tdDesc").html());
										$('#mestoGorod').html($("#"+idpl).find(".tdGorod").html());
										$('#mestoRaion').html($("#"+idpl).find(".tdRaion").html());
										$('#mestoGRP').html($("#"+idpl).find(".tdGRP").html());
										$('#mestoPrice').html($("#"+idpl).find(".tdPrice").html());
									}
								});
							});

						});
						
					</script>
					
					<div class = "info">
						<!-- <div id = "mestoImg"><img src = "<?php echo get_template_directory_uri();?>/images/no-photo.png"/></div> -->
						<div id = "mestoImg"><img src = "<?php echo $MapImg;?>"/></div>
						<table>
							<tr>
								<th>Город / Район</th> <td><span id = "mestoGorod"><?php echo $row->Gorod;?></span> / <span id = "mestoRaion"><?php echo $row->Raion;?></span></td>
							</tr>
							<tr>
								<th>Адрес</th> <td><span id = "mestoAdres"><?php echo $row->Description;?></span></td>
							</tr>
							<tr>
								<th>Тип / Код / Освещение</th> <td> <span id = "mestoType"><?php echo $row->Type;?></span> / <span id = "mestoKode"><?php echo $row->Code;?></span> / <span id = "mestoSvet"><?php echo $osveshenie;?></span></td>
							</tr>
							<tr>
								<th>GRP</th> <td><span id = "mestoGRP"><?php echo $row->GRP;?></span></td>
							</tr>
							<tr>
								<th>Цена</th> <td><span id = "mestoPrice"><?php echo $row->Price;?></span></td>
							</tr>
						</table>
<!-- 						<div class = "bascet">
							<div class = "bscetCount"></div>
							<a title = "Перейти в корзину" href = "<?php echo get_the_permalink(69);?>"><div class = "zayavkaMesto"><i class="fa fa-shopping-basket" aria-hidden="true"></i></div></a>
						</div> -->
					</div>

					<div style = "border:none;" class = "tableBlk one-tableBlk">
						<?php echo $tableStr;?>	


				<div id = "map" class = "map">
					<script>
						var myMap,
						myPlacemark;

						// Дождёмся загрузки API и готовности DOM.
						ymaps.ready(init);

						function init () {
							// Создание экземпляра карты и его привязка к контейнеру с
							// заданным id ("map").
							myMap = new ymaps.Map('map', {
								center: [51.73415798382783,36.19187236903374], 
								zoom: 13,
								class: "myMap11",
								controls: ['zoomControl', 'routeButtonControl', 'geolocationControl', 'typeSelector', 'fullscreenControl']
							}, {
								//searchControlProvider: 'yandex#search'
							});
							
							//myMap.controls.add('zoomControl');
							

							<?php
							
							echo $mapStr;

							?>
						}

						// ymaps.load(function() {
						// 	repaintPlex();

						// });
					</script>
				</div>

					</div>

				</div>

				</div>
			</div>
		<?php endwhile;?>
	<?php endif; ?>
</div>	

</div>

