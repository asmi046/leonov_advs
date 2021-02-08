<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>> 
<head profile="http://gmpg.org/xfn/11"> 
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/fonts/font-awesome.min.css" type="text/css" media="screen" />
	<!-- <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" /> -->
	
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /> 
	<meta name="viewport" content="width=device-width">
	<meta name="cmsmagazine" content="f7245597f5b3579a3db3d69ddef2a8bf" />
	<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
	
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<!-- файл общих JavaScript функций -->
	<!-- <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/main.js"></script> -->
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/slider.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.cookie.js"></script>
	
    <link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/images/icon.png" />
    <?php wp_head(); // API Hook ?> 
	
</head> 
<body>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter46679331 = new Ya.Metrika({
                    id:46679331,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/46679331" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

	<script>
		$(document).ready(function() { 
			jQuery(".onlinePr").click(function(){ 
				jQuery("#svForm").show("slide");
			});
			

			
			jQuery(".pformWriperClose").click(function(){ 
				jQuery("#svForm").hide("slide");
			});
			
			jQuery(".zformWriperClose").click(function(){ 
				jQuery("#zayavkaForm").hide("slide");
			});
			
			$(window).scroll(function () { 
				if ($(this).scrollTop() > 70) {
					//$('.menuLine').addClass("menuLineFixed");
					$('.logoLine').addClass("logoLineFixed");
					$('.BanerLinePage').addClass("BanerLinePageMin");
					$('.logo').attr("src", "<?php bloginfo("template_url");?>/images/logo70.png");
				}
				
				if ($(this).scrollTop() < 70) {
					//$('.menuLine').removeClass("menuLineFixed");
					$('.logoLine').removeClass("logoLineFixed");
					$('.BanerLinePage').removeClass("BanerLinePageMin");
					$('.logo').attr("src", "<?php bloginfo("template_url");?>/images/logo.png");
				}
			});
		});		
	</script>

<div class = "main">

<div id="svForm" class="formFon">
	<div class="pformWriper pformWriperSmile">
	<h2>Заказать звонок</h2>
	<i class="fa fa-times-circle-o pformWriperClose" aria-hidden="true"></i>
		<div class = "obrSvForm">
			<?php echo do_shortcode('[contact-form-7 id="37" title="Обратная связь"]');?>
		</div>
	</div>
</div>

<div id="zayavkaForm" class="formFon">
	<div class="zformWriper pformWriperSmile">
	<h2>Отправить заявку</h2>
	<i class="fa fa-times-circle-o zformWriperClose" aria-hidden="true"></i>
		<div class = "obrSvForm">
			<?php echo do_shortcode('[contact-form-7 id="63" title="Заявка на рекламное место"]');?>
		</div>
	</div>
</div>

<div class = "line menuLine">
	<div class = "centerLine">
		
		<?php $options = get_option( 'wpuniq_theme_options' ); ?>
		
		<div class = "menuBlk">
				<?php wp_nav_menu( array('menu' => 'Главное меню', 'container' => false, 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s<li class = "obrSv"><a href = "'.get_the_permalink(11).'">On-Line продажи</a></li></ul>')); ?>
		</div>
		
		
		
		<!--<a href = "<?php //echo get_the_permalink(11); ?>">-->
			<div class = "onlinePr onlinePR">
				<!--<i class="fa fa-envelope-open-o" aria-hidden="true"></i>--><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $options["phone"]; ?><br/><span class = "zzText">Заказать звонок</span>
			</div>
		<!--</a>-->
		
		

	</div>
</div>

