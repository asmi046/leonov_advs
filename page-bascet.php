<?php
/*
Template Name: Корзина
*/
?>

<?php 
	$sending = 0;
	
	if (isset($_POST["sendmail"])) {
		
		
		
		$headers = 'From: Рекламное агентство Леонов <noreply@leonov.ru>' . "\r\n";
		
		
		
		$mailContent = "<strong>Имя: </strong>".$_POST["myName"]."<br/>";
		$mailContent .= "<strong>e-mail: </strong>".$_POST["myMail"]."<br/>";
		$mailContent .= "<br/>";
		$mailContent .= "<h2>Ваш заказ</h2>";
		
		
		$result = $wpdb->get_results( "SELECT * FROM `transfet_base`" );

		$inbascet = explode(",", $_COOKIE['plbascet']);
		
		$mailContent .= "<table class = 'bascetTable' style = 'width:100%;' border = '1' cellpadding = '2' bordercolor = '#000000'>";
		$mailContent .= "<thead>";
		$mailContent .= "<tr>";
		$mailContent .= "<th>Город</th>";
		$mailContent .= "<th class = 'cl2h'>Район</th>";
		$mailContent .= "<th class = 'cl3h'>Адрес</th>";
		$mailContent .= "<th class = 'cl4h'>Тип конструкции</th>";
		$mailContent .= "<th class = 'cl5h'>Освещение</th>";
		$mailContent .= "<th class = 'cl6h'>Код</th>";
		$mailContent .= "<th class = 'cl7h'>GRP</th>";
		//$mailContent .= "<th class = 'cl8h'>Цена</th>";
		$mailContent .= "</tr>";
		$mailContent .= "</thead>";
		$mailContent .= "<tbody>";
		
		foreach ($result as $row) {
			if (!in_array ($row->id, $inbascet) ) continue;
			
			$mailContent .= "<tr>";

				$mailContent .= "<td>".$row->Gorod."</td>";
				$mailContent .= "<td>".$row->Raion."</td>";
				$mailContent .= "<td>".$row->Description."</td>";
				$mailContent .= "<td>".$row->Type."</td>";

				$mailContent .= "<td>".$osveshenie."</td>";
				$mailContent .= "<td>".$row->Code."</td>";
				$mailContent .= "<td>".$row->GRP."</td>";
				//$mailContent .= "<td>".$row->Price."</td>";
			$mailContent .= "</tr>";
		}
		
		add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
		$sending = wp_mail(array("asmi046@gmail.com","reception@leonovadv.ru","a.karachevtseva@um46.ru","i.solodova@um46.ru","print-leonov@yandex.ru"), 'Новый заказ на сайте', $mailContent, $headers)?2:1;
		
		if ($sending == 2) {
			setcookie("plbascet", "",0,"/");
		}
	}
	
?>

<?php get_header(); ?>
	<?php include_once("menuLine.php"); ?>
	
	<div class = "line contentAllLine contentAllPage">
		<div class = "centerLine">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div class = "content reklamaBlk">
				<h1><?php the_title();?></h1>
				<?php the_content();?>
				
				<?php 
					if ($sending == 1) {
				?>
					<h2>Произошла ошибка попробуйте позднее</h2>
				<?php
					} else if ($sending == 2) {
				?>
					<h2>Ваш заказ принят, наш менеджер свяжется с Вами в ближайшее время</h2>
					<a href = "<?php echo get_the_permalink(14);?>">Назад к списку Конструкций</a>
				<?php
					} else if ($sending <= 0) {
				?>
				
				<?php 
					if (!empty($_COOKIE["plbascet"])) { 
				?>
				

				
				<script>
					function empty_form ()
					{
						
						if($("#myName").val() =='')
						{
							$("#myName").css("background-color","#fdc689");
							//console.log(1);
							return false;
						}   
						
						if($("#myMail").val() =='')
						{
							$("#myMail").css("background-color","#fdc689");
							//console.log(2);
							return false;
						}
						
						return true;
					}

					function repaintPlex() {
							myMap.geoObjects.each(function (geoObject) {
									   if (selected.indexOf(geoObject.properties.get('id')) != -1) 
									   {
										   geoObject.options.set('preset', 'islands#greenDotIcon');
										   $(".CartBtn"+geoObject.properties.get('id')).css("color", "red");
									   } else  geoObject.options.set('preset', 'islands#blueDotIcon')});
							if (selected.length == 0)
							  $(".bscetCount").html("Корзина пуста");
							 else $(".bscetCount").html("Выбрано конструкций: "+selected.length);
							 console.log(selected);
					}
					
					var selected = [];
					var selectedTmp = $.cookie('plbascet').split(',');
					
					if (selectedTmp[0] == 0) selectedTmp = [];
					
			
					for (i = 0; i<selectedTmp.length; i++)
						selected.push(Number(selectedTmp[i]));
					
					console.log(selected);
					
					
					
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
						location.reload();
					}
					
					
					
				</script>
				<div class = "mapBlk">
					
					<?php
								$mapStr = "";
								$tableStr = "<table>";
								$tableStr .= "<thead>";
								$tableStr .= "<tr>";
								$tableStr .= "<th class = 'cl1h'></th>";
								$tableStr .= "<th class = 'cl1h'>Город</th>";
								$tableStr .= "<th class = 'cl2h'>Район</th>";
								$tableStr .= "<th class = 'cl3h'>Адрес</th>";
								$tableStr .= "<th class = 'cl4h'>Тип конструкции</th>";
								$tableStr .= "<th class = 'cl5h'>Освещение</th>";
								$tableStr .= "<th class = 'cl6h'>Код</th>";
								$tableStr .= "<th class = 'cl7h'>GRP</th>";
								//$tableStr .= "<th class = 'cl8h'>Цена</th>";
								$tableStr .= "</tr>";
								$tableStr .= "</thead>";
								$tableStr .= "<tbody>";
								
								global $wpdb;
								
								$Type = isset($_POST["Type"])?$_POST["Type"]:"%";
								$Gorod = isset($_POST["Gorod"])?$_POST["Gorod"]:"%";
								$Raion = isset($_POST["Raion"])?$_POST["Raion"]:"%";
								$Description = !empty($_POST["Description"])?"%".$_POST["Description"]."%":"%";
								
								$result = $wpdb->get_results( "SELECT * FROM `transfet_base` WHERE `Type` LIKE '".$Type."' AND `Gorod` LIKE '".$Gorod."' AND `Raion` LIKE '".$Raion."' AND `Description` LIKE '".$Description."'" );
								$i =1;
								
								$inbascet = explode(",", $_COOKIE['plbascet']);
								
								foreach ($result as $row) {
									
									if (!in_array ($row->id,$inbascet) ) continue;
									
									$osveshenie = true;
									if ($row->Osveshenie === "true") $osveshenie = "Да";
									else $osveshenie = "Нет";
									
									if (!empty($row->Koordinati)) {
										$mapStr .= "myPlacemark".$row->id." = new ymaps.Placemark(".$row->Koordinati.", {";
										$mapStr .= "balloonContent: '<b>Адрес:</b> ".$row->Description."<br/> <b>Тип:</b>  ".$row->Type."  <span class = \'btnsUpr\'><i onclick = \'addPlex(".$row->id.");\'; title = \'Добавить в корзину\'class=\'toCartBtn  CartBtn CartBtn".$row->id." fa fa-shopping-cart\' aria-hidden=\'true\'></i></span>',";
										$mapStr .= "id: ".$row->id;
										
										$mapStr .= "},";
										$mapStr .= "{preset:'islands#blueDotIcon'}";
										$mapStr .= ");";
										
										$mapStr .= " myPlacemark".$row->id.".events.add('click', function (e) {";
											
											$mapStr .= " if (selected.indexOf(myPlacemark".$row->id.".properties.get('id')) < 0)";
										$mapStr .= "myPlacemark".$row->id.".properties.set('balloonContent', '<b>Адрес:</b> ".$row->Description."<br/> <b>Тип:</b>  ".$row->Type."  <span class = \'btnsUpr\'><i onclick = \'addPlex(".$row->id.");\'; title = \'Добавить в корзину\'class=\'toCartBtn  CartBtn CartBtn".$row->id." fa fa-shopping-cart\' aria-hidden=\'true\'></i></span>');";
										$mapStr .= "else ";
										$mapStr .= "myPlacemark".$row->id.".properties.set('balloonContent', '<b>Адрес:</b> ".$row->Description."<br/> <b>Тип:</b>  ".$row->Type."  <span class = \'btnsUpr\'><i onclick = \'addPlex(".$row->id.");\'; title = \'Добавить в корзину\'class=\'outCartBtn  CartBtn CartBtn".$row->id." fa fa-shopping-cart\' aria-hidden=\'true\'></i></span>');";
										
											
											$MapImg = get_bloginfo("template_url")."/images/no-photo.png";
											if (!empty($row->Img))
											{
												$MapImg = get_bloginfo("url")."/transfer/".$row->Img;
											} else 
												if (!empty($row->ImgMap))
													$MapImg = get_bloginfo("url")."/transfer/".$row->ImgMap;
											$msgText = "Код: ".$row->Code." Тип конструкции: ".$row->Type." Описание: ".$row->Description." Город: ".$row->Gorod." Район".$row->Raion;
											
											$MapImgBsk = $MapImg;
											$rowCode = $row->Code;
											$rowType = $row->Type;
											$osveshenieBsk = $osveshenie;
											$rowDescription = $row->Description;
											$rowGorod = $row->Gorod;
											$rowRaion = $row->Raion;
											$rowGRP =$row->GRP;
											$rowPrice = $row->Price;
											
											$mapStr .= "$('#mestoImg img').attr('src', '".$MapImg."');";
											$mapStr .= "$('#mestoKode').html('".$row->Code."');";
											$mapStr .= "$('#mestoType').html('".$row->Type."');";
											$mapStr .= "$('#mestoSvet').html('".$osveshenie."');";
											$mapStr .= "$('#mestoAdres').html('".$row->Description."');";
											$mapStr .= "$('#mestoGorod').html('".$row->Gorod."');";
											$mapStr .= "$('#mestoRaion').html('".$row->Raion."');";
											$mapStr .= "$('#mestoGRP').html('".$row->GRP."');";
											$mapStr .= "$('#mestoPrice').html('".$row->Price."');";
											$mapStr .= "$('#aMesto').html('".$msgText."');";
											$mapStr .= "$('.tableBlk table tbody').scrollTop($('#".$row->id."').position().top+$('.tableBlk table tbody').scrollTop()-50);  console.log($('#".$row->id."').position().top); ";
											$mapStr .= "myMap.setCenter(myPlacemark".$row->id.".geometry.getCoordinates(), 18);";
											$mapStr .= "myMap.geoObjects.each(function (geoObject) {repaintPlex();});";
											$mapStr .= "myPlacemark".$row->id.".options.set('preset', 'islands#redDotIcon');";
											
											$mapStr .= "$('.tableBlk table tbody tr').removeClass('trSelect'); ";
											$mapStr .= "$('#".$row->id."').addClass('trSelect');";
										$mapStr .= "}, this);";
										$mapStr .= " myMap.geoObjects.add(myPlacemark".$row->id."); ";
									}
									
									
									
									$tableStr .= "<tr id = '".$row->id."'>";
										$tableStr .= "<td class = 'tdDeistvie cl1'><i onclick = 'addPlex(".$row->id.");' class='fa fa-minus-circle' aria-hidden='true'></i></td>";
										$tableStr .= "<td class = 'tdGorod cl1'>".$row->Gorod."</td>";
										$tableStr .= "<td class = 'tdRaion cl2'>".$row->Raion."</td>";
										$tableStr .= "<td class = 'tdDesc cl3'>".$row->Description."</td>";
										$tableStr .= "<td class = 'tdType cl4'>".$row->Type."</td>";

										$tableStr .= "<td class = 'tdOsveshenie  cl5'>".$osveshenie."</td>";
										$tableStr .= "<td class = 'tdCode cl6'>".$row->Code."</td>";
										$tableStr .= "<td class = 'tdGRP cl7'>".$row->GRP."</td>";
										//$tableStr .= "<td class = 'tdPrice cl8'>".$row->Price."</td>";
										$tableStr .= "<td class = 'tdImg cl9'>".$MapImg."</td>";
									$tableStr .= "</tr>";
									
						
									
									$i++;
								}
								$tableStr .= "</tbody>";
								$tableStr .= "</table>";
								
							
							?>
					
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
								zoom: 8,
								class: "myMap11"
							}, {
								searchControlProvider: 'yandex#search'
							});
							
							myMap.controls.add('zoomControl');
							
						
							<?php
							
								echo $mapStr;
								
							?>
							
							/*
								myPlacemark = new ymaps.Placemark([51.734402113560286,36.19264484523003], {
								hintContent: '<b>Адрес:</b> г. Курск ул. Ленина 12 (ЦУМ, 3 этаж)',
								balloonContent: '<b>Адрес:</b> г. Курск ул. Ленина 12 (ЦУМ, 3 этаж)'
								});
								myPlacemark.options.set('preset', 'islands#blueGovernmentIcon');
								myMap.geoObjects.add(myPlacemark);
							*/
							
						}
						ymaps.load(function() {
								repaintPlex();
								
								$(".toCartBtn").click(function(){ 
								addPlex($(this).data("elemID"));
								alert("111");
							});
						});
						
						
						$("input").click(function(){ 
							$("#myName").style("bacgroun-color","white");
						});
												
						
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
											
											$('#mestoImg img').attr('src', $("#"+idpl).find(".tdImg").html());
											$('#mestoKode').html($("#"+idpl).find(".tdCode").html());
											$('#mestoType').html($("#"+idpl).find(".tdType").html());
											$('#mestoSvet').html($("#"+idpl).find(".tdOsveshenie").html());
											$('#mestoAdres').html($("#"+idpl).find(".tdDesc").html());
											$('#mestoGorod').html($("#"+idpl).find(".tdGorod").html());
											$('#mestoRaion').html($("#"+idpl).find(".tdRaion").html());
											$('#mestoGRP').html($("#"+idpl).find(".tdGRP").html());
											$('#mestoPrice').html($("#"+idpl).find(".tdPrice").html());
											
											return false;
										}
									});
							});
						
						});
						
					</script>
					
					<div id = "map" class = "map">
					
					
					</div>
					<div class = "info">
						<div id = "mestoImg"><img src = "<?php echo $MapImgBsk;?>"/></div>
						<table>
						
						
						
						<tr>
							<th>Город</th> <td><span id = "mestoGorod"><?php echo $rowGorod;?></span></td>
						</tr>
						
						<tr>
							<th>Район</th> <td> <span id = "mestoRaion"><?php echo $rowRaion;?></span></td>
						</tr>
						
						<tr>
							<th>Адрес</th> <td><span id = "mestoAdres"><?php echo $rowDescription;?></span></td>
						</tr>
						
						<tr>
							<th>Тип конструкции</th> <td> <span id = "mestoType"><?php echo $rowType;?></span></td>
						</tr>
						
						<tr>
							<th>Код</th> <td><span id = "mestoKode"><?php echo $rowCode;?></span></td>
						</tr>

						<tr>
							<th>Освещение</th> <td><span id = "mestoSvet"><?php echo $osveshenieBsk;?></span></td>
						</tr>
						
						<tr>
							<th>GRP</th> <td><span id = "mestoGRP"><?php echo $rowGRP;?></span></td>
						</tr>
						
						<tr>
							<th>Цена</th> <td><span id = "mestoPrice"><?php echo $rowPrice;?></span></td>
						</tr>


						</table>
						<div class = "bascet">
						<div class = "bscetCount"></div>
						<a title = "Перейти к списку площадок" href = "<?php echo get_the_permalink(14);?>"><div class = "zayavkaMesto"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></div></a>
						</div>
					</div>
				</div>
				<h2 id = "h2Bascet" >Ваш Заказ</h2>
				<div class = "tableBlk tableBlkBascet">
					<?php echo $tableStr;?>	
				</div>
				
				<h2 id = "h2Bascet" >Ваши данные</h2>
				<div class = "onlineProd">
					<form method = "post" action = "" onsubmit = "return empty_form();">
						
						<input type = "hidden" name = "tableStr" value = "<?php echo $tableStr;?>">
						<p><label>Имя*:</label><span><input id = "myName" type = "text" name = "myName" value = ""></span></p>
						<p><label>e-mail*:</label><span><input id = "myMail" type = "email" name = "myMail" value = ""></span></p>
						<p><label>Комментарий:</label><span><textarea name = "comment"></textarea></span></p>
						<p><label></label><span><input type = "submit" value = "Отправить" name = "sendmail"></span></p>
					</form>
				</div>
			
			<?php
					} else {
			?>
				<h2>Ваша корзина пуста</h2>
				<a href = "<?php echo get_the_permalink(14);?>">Назад к списку Конструкций</a>
			<?php			
				}
				}
			?>
			</div>
			<?php endwhile;?>
			<?php endif; ?>
		</div>	
	</div>
	
<?php get_footer(); ?>