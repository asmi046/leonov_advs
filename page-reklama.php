<?php
/*
Template Name: Наружная реклама
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
				<div class = "filterBlk">
					<form method="post">
						<select name = "Type" onchange="this.form.submit()">
							<option <?php echo (strcmp($_POST["Type"], "%") ==0)?"selected":"";?> value = "%" >Все типы конструкций</option>
							<?php
								global $wpdb;
								$result = $wpdb->get_results( "SELECT DISTINCT Type FROM `transfet_base`" );
								
								foreach ($result as $row) {
									if (!empty($row->Type)){
										$selected = (strcmp($row->Type, $_POST["Type"]) ==0)?"selected":"";
										echo "<option value = '".$row->Type."' ".$selected.">".$row->Type."</option>";
									}
								}
							?>
						</select>
						
						<select name = "Gorod" onchange="this.form.submit()">
							<option <?php echo (strcmp($_POST["Gorod"], "%") ==0)?"selected":"";?> value = "%" >Все города</option>
							<?php
								global $wpdb;
								$result = $wpdb->get_results( "SELECT DISTINCT Gorod FROM `transfet_base`" );
								
								foreach ($result as $row) {
									if (!empty($row->Gorod)) {
										$selected = (strcmp($row->Gorod, $_POST["Gorod"]) ==0)?"selected":"";
										echo "<option value = '".$row->Gorod."' ".$selected.">".$row->Gorod."</option>";
									}
								}
							?>
						</select>
						
						<select name = "Raion" onchange="this.form.submit()">
							<option <?php echo (strcmp($_POST["Raion"], "%") == 0)?"selected":"";?> value = "%" >Все Районы</option>
							<?php
								global $wpdb;
								$result = $wpdb->get_results( "SELECT DISTINCT Raion FROM `transfet_base`" );
								
								foreach ($result as $row) {
									if (!empty($row->Raion)){
										$selected = (strcmp($row->Raion, $_POST["Raion"]) ==0)?"selected":"";
										echo "<option value = '".$row->Raion."' ".$selected.">".$row->Raion."</option>";
									}
								}
							?>
						</select>
						<div class="descr-form-wrap">
							<input name = "Description" autocomplete="off" id="input-descr" type = "text" value = "<?php echo $_POST["Description"]; ?>" placeholder = "Улица, сторона и т. д.">
							<div class="descr-form-wrap__result"></div>
						</div>
						<input type = "submit" name = "filterSubmit"  value = "Применить">
					</form>
				</div>
				<script>
					
					
					
					
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
					}
					
					
					
				</script>
				<div class = "mapBlk">
					
					<?php
								$mapStr = "";
								$tableStr = "<table>";
								$tableStr .= "<thead>";
								$tableStr .= "<tr>";
								$tableStr .= "<th id = 'cl0h'><i class='fa fa-search'></i></th>";
								$tableStr .= "<th id = 'cl01h'>№</th>";
								$tableStr .= "<th id = 'cl1h'>Город</th>";
								$tableStr .= "<th id = 'cl2h'>Район</th>";
								$tableStr .= "<th id = 'cl3h'>Адрес</th>";
								$tableStr .= "<th id = 'cl4h'>Тип конструкции</th>";
								$tableStr .= "<th id = 'cl5h'>Освещение</th>";
								$tableStr .= "<th id = 'cl6h'>Код</th>";
								$tableStr .= "<th id = 'cl7h'>GRP</th>";
								//$tableStr .= "<th id = 'cl8h'>Цена</th>";
								$tableStr .= "</tr>";
								$tableStr .= "</thead>";
								$tableStr .= "<tbody>";
								
								global $wpdb;
								
								$Type = isset($_POST["Type"])?$_POST["Type"]:"%";
								$Gorod = isset($_POST["Gorod"])?$_POST["Gorod"]:"%";
								$Raion = isset($_POST["Raion"])?$_POST["Raion"]:"%";
								$Description = !empty($_POST["Description"])?"%".$_POST["Description"]."%":"%";
								
								$result = $wpdb->get_results( "SELECT * FROM `transfet_base` WHERE `Type` LIKE '".$Type."' AND `Gorod` LIKE '".$Gorod."' AND `Raion` LIKE '".$Raion."' AND `Description` LIKE '".$Description."'  ORDER BY `transfet_base`.`Description` ASC" );
								$i =1;
								$ii =1;
								
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
										
										$mapStr .= "myPlacemarkBig".$row->id." = new ymaps.Placemark(".$row->Koordinati.", {\r\n";
										$mapStr .= "balloonContent: '<b>Адрес:</b> ".$row->Description."<br/> <b>Тип:</b>  ".$row->Type."  <span class = \'btnsUpr\'><i onclick = \'addPlex(".$row->id.");\'; title = \'Добавить в корзину\'class=\'toCartBtn  CartBtn CartBtn".$row->id." fa fa-shopping-cart\' aria-hidden=\'true\'></i></span>',\r\n";
										$mapStr .= "id: ".$row->id;
										
										$mapStr .= "},\r\n";
										$mapStr .= "{preset:'islands#blueDotIcon'}\r\n";
										$mapStr .= ");\r\n";
										
										$mapStr .= " myPlacemark".$row->id.".events.add('click', function (e) {\r\n";
										
										$MapImg = get_bloginfo("template_url")."/images/no-photo.png";
											if (!empty($row->Img))
											{
												$MapImg = get_bloginfo("url")."/transfer/".$row->Img;
												
												
											} else 
												if (!empty($row->ImgMap))
													$MapImg = get_bloginfo("url")."/transfer/".$row->ImgMap;										

										
										$mapStr .= " if (selected.indexOf(myPlacemark".$row->id.".properties.get('id')) < 0)\r\n";
										$mapStr .= "myPlacemark".$row->id.".properties.set('balloonContent', '<b>Адрес:</b> ".$row->Description."<br/> <b>Тип:</b>  ".$row->Type." <br><img class = \'inerMapImg\' src =\'".$MapImg."\'/><br> <span class = \'btnsUpr\'><i onclick = \'addPlex(".$row->id.");\'; title = \'Добавить в корзину\'class=\'toCartBtn  CartBtn CartBtn".$row->id." fa fa-shopping-cart\' aria-hidden=\'true\'></i></span>');\r\n";
										$mapStr .= "else \r\n";
										$mapStr .= "myPlacemark".$row->id.".properties.set('balloonContent', '<b>Адрес:</b> ".$row->Description."<br/> <b>Тип:</b>  ".$row->Type."  <br><img class = \'inerMapImg\' src =\'".$MapImg."\'/><br> <span class = \'btnsUpr\'><i onclick = \'addPlex(".$row->id.");\'; title = \'Добавить в корзину\'class=\'outCartBtn  CartBtn CartBtn".$row->id." fa fa-shopping-cart\' aria-hidden=\'true\'></i></span>');\r\n";
										
											
											
											$msgText = "Код: ".$row->Code." Тип конструкции : ".$row->Type." Описание: ".$row->Description." Город: ".$row->Gorod." Район".$row->Raion;
											
											$mapStr .= "$('#mestoImg img').attr('src', '".$MapImg."');\r\n";
											$mapStr .= "$('#mestoImg a').attr('href', '".$MapImg."');\r\n";
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
											
											$mapStr .= "myMap1.setCenter(myPlacemark".$row->id.".geometry.getCoordinates(), 18); \r\n";
											$mapStr .= "myMap1.geoObjects.each(function (geoObject) {repaintPlex();}); \r\n";
											
											$mapStr .= "myPlacemark".$row->id.".options.set('preset', 'islands#redDotIcon'); \r\n";
											
											$mapStr .= "$('.tableBlk table tbody tr').removeClass('trSelect'); \r\n";
											$mapStr .= "$('#".$row->id."').addClass('trSelect'); \r\n";
										$mapStr .= "}, this); \r\n";
										
										$mapStr .= " myPlacemarkBig".$row->id.".events.add('click', function (e) {\r\n";
										
										$MapImg = get_bloginfo("template_url")."/images/no-photo.png";
											if (!empty($row->Img))
											{
												$MapImg = get_bloginfo("url")."/transfer/".$row->Img;
												
												
											} else 
												if (!empty($row->ImgMap))
													$MapImg = get_bloginfo("url")."/transfer/".$row->ImgMap;										

										
										$mapStr .= " if (selected.indexOf(myPlacemarkBig".$row->id.".properties.get('id')) < 0)\r\n";
										$mapStr .= "myPlacemarkBig".$row->id.".properties.set('balloonContent', '<b>Адрес:</b> ".$row->Description."<br/> <b>Тип:</b>  ".$row->Type." <br><img class = \'inerMapImg\' src =\'".$MapImg."\'/><br> <span class = \'btnsUpr\'><i onclick = \'addPlex(".$row->id.");\'; title = \'Добавить в корзину\'class=\'toCartBtn  CartBtn CartBtn".$row->id." fa fa-shopping-cart\' aria-hidden=\'true\'></i></span>');\r\n";
										$mapStr .= "else \r\n";
										$mapStr .= "myPlacemarkBig".$row->id.".properties.set('balloonContent', '<b>Адрес:</b> ".$row->Description."<br/> <b>Тип:</b>  ".$row->Type."  <br><img class = \'inerMapImg\' src =\'".$MapImg."\'/><br> <span class = \'btnsUpr\'><i onclick = \'addPlex(".$row->id.");\'; title = \'Добавить в корзину\'class=\'outCartBtn  CartBtn CartBtn".$row->id." fa fa-shopping-cart\' aria-hidden=\'true\'></i></span>');\r\n";
										
											
											
											$msgText = "Код: ".$row->Code." Тип конструкции : ".$row->Type." Описание: ".$row->Description." Город: ".$row->Gorod." Район".$row->Raion;
											
											$mapStr .= "$('#mestoImg img').attr('src', '".$MapImg."');\r\n";
											$mapStr .= "$('#mestoImg a').attr('href', '".$MapImg."');\r\n";
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
											$mapStr .= "myMap.setCenter(myPlacemarkBig".$row->id.".geometry.getCoordinates(), 18); \r\n";
											$mapStr .= "myMap.geoObjects.each(function (geoObject) {repaintPlex();}); \r\n";
											
											$mapStr .= "myMap1.setCenter(myPlacemarkBig".$row->id.".geometry.getCoordinates(), 18); \r\n";
											$mapStr .= "myMap1.geoObjects.each(function (geoObject) {repaintPlex();}); \r\n";
											
											$mapStr .= "myPlacemarkBig".$row->id.".options.set('preset', 'islands#redDotIcon'); \r\n";
											
											$mapStr .= "$('.tableBlk table tbody tr').removeClass('trSelect'); \r\n";
											$mapStr .= "$('#".$row->id."').addClass('trSelect'); \r\n";
										$mapStr .= "}, this); \r\n";
										
										$mapStr .= " myMap.geoObjects.add(myPlacemark".$row->id."); \r\n";
										
										$mapStr .= " myMap1.geoObjects.add(myPlacemarkBig".$row->id."); \r\n";
									
									
									
									
									$tableStr .= "<tr data-index='".$row->id."' id = '".$row->id."'>";
										$tableStr .= "<td id = 'cl0' class = 'tdBascetT cl0'><i onclick = 'addPlex(".$row->id.");'; title = 'Добавить в корзину' class='toCartBtn  CartBtn CartBtn".$row->id." fa fa-shopping-cart' aria-hidden='true'></i></td>";
										$tableStr .= "<td id = 'cl01' class = 'tdGorod cl1'>".$ii."</td>";
										$tableStr .= "<td id = 'cl1' class = 'tdGorod cl1'>".$row->Gorod."</td>";
										$tableStr .= "<td id = 'cl2' class = 'tdRaion cl2'>".$row->Raion."</td>";
										$tableStr .= "<td id = 'cl3' class = 'tdDesc cl3'>".$row->Description."</td>";
										$tableStr .= "<td id = 'cl4' class = 'tdType cl4'>".$row->Type."</td>";

										$tableStr .= "<td id = 'cl5' class = 'tdOsveshenie  cl5'>".$osveshenie."</td>";
										$tableStr .= "<td id = 'cl6' class = 'tdCode cl6'>".$row->Code."</td>";
										$tableStr .= "<td id = 'cl7' class = 'tdGRP cl7'>".$row->GRP."</td>";
										//$tableStr .= "<td id = 'cl8' class = 'tdPrice cl8'>".$row->Price."</td>";
										$tableStr .= "<td id = 'cl9' class = 'tdImg cl9'>".$MapImg."</td>";
									$tableStr .= "</tr>";
									$ii++;
									}
									
									$i++;
								}
								$tableStr .= "</tbody>";
								$tableStr .= "</table>";
							?>
					
					<script>	
						var myMap, myMap1,
						myPlacemark;

						// Дождёмся загрузки API и готовности DOM.
						ymaps.ready(init);

						function init () {
							// Создание экземпляра карты и его привязка к контейнеру с
							// заданным id ("map").
							myMap = new ymaps.Map('map', {
								center: [51.73415798382783,36.19187236903374], 
								zoom: 7,
								class: "myMap11",
								controls: ['zoomControl', 'routeButtonControl', 'geolocationControl', 'typeSelector', 'fullscreenControl']
							}, {
								//searchControlProvider: 'yandex#search'
							});
							
							myMap1 = new ymaps.Map('map1', {
								center: [51.73415798382783,36.19187236903374], 
								zoom: 7,
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
						
						ymaps.load(function() {
								repaintPlex();
								
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

							
							$(".bigTableClose").click(function(){
								$(".bigTable").hide();
								$("body").css("overflow-y","auto");
							});
							
							$(".fa-search").click(function(){ 
								$(".bigTable").show();
								
								$('.mainBigTable').scrollTop(0);
								$('.mainBigTable').scrollTop($("tr[data-index="+idpl+"]").position().top+$('.mainBigTable').scrollTop()-$('.mainBigTable').position().top-50); 
								//$('.mainBigTable').scrollTop($(".mainBigTable table tbody .trSelect").position().top-$(".bigTable").scrollTop() ); 
								
								//$(".mainBigTable").html($(".tableBlk").html());
								
								$("body").css("overflow-y","hidden");
							});
							
							$(".mainBigTable table tbody tr, .tableBlk table tbody tr").click(function(){ 
								  idpl = $(this).attr("id");
								  
								  $(".mainBigTable table tbody tr, .tableBlk table tbody tr").removeClass('trSelect');
								  //$(this).addClass('trSelect');
								  $(".tableBlk table tbody tr[data-index="+idpl+"]").addClass('trSelect');
								  $(".mainBigTable table tbody tr[data-index="+idpl+"]").addClass('trSelect');
								  
								  console.log($(this).closest(".mainBigTable"));
								  
								  if($(this).closest(".mainBigTable").length > 0 )	 
									$('.tableBlk table tbody').scrollTop($(".tableBlk table tbody tr[data-index="+idpl+"]").position().top+$('.tableBlk table tbody').scrollTop()-50); 
								 	
								  myMap.geoObjects.each(function (geoObject) {
										geoObject.options.set('preset', 'islands#blueDotIcon');
										
										if (geoObject.properties.get('id') == idpl) {
											myMap.balloon.close();
											myMap.setCenter(geoObject.geometry.getCoordinates(), 18);
											
											geoObject.options.set('preset', 'islands#redDotIcon');
											console.log("red");
											
											$('#mestoImg img').attr('src', $("#"+idpl).find(".tdImg").html());
											$('#mestoImg a').attr('href', $("#"+idpl).find(".tdImg").html());
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
									
									myMap1.geoObjects.each(function (geoObject) {
										geoObject.options.set('preset', 'islands#blueDotIcon');
										
										if (geoObject.properties.get('id') == idpl) {
											myMap1.balloon.close();
											myMap1.setCenter(geoObject.geometry.getCoordinates(), 18);
											
											geoObject.options.set('preset', 'islands#redDotIcon');
											console.log("red");
											
											$('#mestoImg img').attr('src', $("#"+idpl).find(".tdImg").html());
											$('#mestoImg a').attr('href', $("#"+idpl).find(".tdImg").html());
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
					
						<div class = "bigTable ">
							<i class="fa fa-times-circle bigTableClose"></i>
							
							
							<div class = " mainBigImapel">
								<div id = "map1" class = "map">
					
					
								</div>
								
								<div class = "info">
									<div id = "mestoImg">
										<a rel="lightbox[rdtp]" href = "<?php echo $MapImg;?>">
											<img title = "<?php echo $row->Description;?>" src = "<?php echo $MapImg;?>"/>
										</a>
									</div>
									
									<div class = "bascet">
										<div class = "bscetCount"></div>
										<a title = "Перейти в корзину" href = "<?php echo get_the_permalink(69);?>"><div class = "zayavkaMesto"><i class="fa fa-shopping-basket" aria-hidden="true"></i></div></a>
									</div>
								</div>
							</div>
							
							<div class = " mainBigTable">
								<?php echo $tableStr;?>
							</div >
						</div>
					
					<div id = "map" class = "map">
					
					
					</div>
					<div class = "info">
						<div id = "mestoImg">
							<a rel="lightbox[rdtp]" href = "<?php echo $MapImg;?>">
								<img title = "<?php echo $row->Description;?>" src = "<?php echo $MapImg;?>"/>
							</a>
						</div>
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
						<div class = "bascet">
						<div class = "bscetCount"></div>
						<a title = "Перейти в корзину" href = "<?php echo get_the_permalink(69);?>"><div class = "zayavkaMesto"><i class="fa fa-shopping-basket" aria-hidden="true"></i></div></a>
						</div>
					</div>
				</div>
				<div class = "tableBlk">
					<?php echo $tableStr;?>	
				</div>
				
			</div>
			<?php endwhile;?>
			<?php endif; ?>
		</div>	
	</div>
	
<?php get_footer(); ?>