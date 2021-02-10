<?php get_header("oneblk"); ?>


<div class = "centerLine">

	<div id="indexmap" class="indexmap">
		
	</div>
<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script> 
		<script>
ymaps.ready(init);

function init () {
    var myMap = new ymaps.Map("indexmap", {
        // Координаты центра карты
        center:[51.730361, 36.192647],
        // Масштаб карты
        zoom: 7,
        // Выключаем все управление картой
        controls: []
    }); 
            
    var myGeoObjects = [];
    
    // Указываем координаты метки
    myGeoObjects = new ymaps.Placemark([51.730361, 36.192647],{
                    balloonContentBody: '\'ЦЕНТР ЮРИДИЧЕСКОЙ ПОДДЕРЖКИ В КУРСКЕ\'',
                    },{
                    iconLayout: 'default#image',
                    // Путь до нашей картинки
                    iconImageHref: 'img/icon/mappointer.svg',  
                    // Размеры иконки
                    iconImageSize: [70, 70],
                    // Смещение верхнего угла относительно основания иконки
                    iconImageOffset: [-25, -110]
    });
                
    var clusterer = new ymaps.Clusterer({
        clusterDisableClickZoom: false,
        clusterOpenBalloonOnClick: false,
    });
    
    clusterer.add(myGeoObjects);
    myMap.geoObjects.add(clusterer);
    // Отключим zoom
    myMap.behaviors.disable('scrollZoom');

}
</script>

</div>

