<?php

include_once('options_page.php');

add_theme_support( 'woocommerce' );

register_nav_menus( array(
	'header_menu' => 'Главное меню',
	'logo_menu' => 'Меню рядом с лого'
) );



add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 185, 185 ); 



add_post_type_support( 'page', 'excerpt' );



function shortcode_contact($atts) {

	extract(shortcode_atts(array(
		"photo" => '',
		"name" => '',
		"dolgn" => '',
		"phone" => '',
		"phone2" => '',
		"mail" => '', "mail2" => '',

		), $atts));

		

	$rez = "<div class = 'contactVCard'>";
		$rez.= "<div class = 'img'>";
			$rez.= "<img src = '".get_bloginfo("template_url")."/images/person/".$photo."' />";
		$rez.= "</div>";

		

		$rez.= "<div class = 'text'>";
			$rez.= "<h2>".$name."</h2>";
			$rez.= "<span class = 'dolgn'>".$dolgn."</span><br/>";
			$rez.= "<span class = 'phone'>".$phone."</span><br/>";
			
			if (!empty($phone2))
				$rez.= "<span class = 'phone2'>".$phone2."</span><br/>";

			$rez.= "<span class = 'mail'>".$mail."</span><br/>";

			if (!empty($mail2))
				$rez.= "<span class = 'mail'>".$mail2."</span><br/>";

		$rez.= "</div>";
	$rez.= "</div>";

	return $rez;
}
add_shortcode('contactVCard', 'shortcode_contact');



function shortcode_contactStart() { 
	return "<div class = 'contactStart'>";
}
add_shortcode('contactStart', 'shortcode_contactStart');





function shortcode_end() { 
	return "</div>";
}
add_shortcode('end', 'shortcode_end');



function adv_scripts() {
	wp_enqueue_style('slick', get_template_directory_uri() . '/css/slick.css', array(), null, 'all');
	wp_enqueue_style('slick-theme', get_template_directory_uri() . '/css/slick-theme.css', array(), null, 'all');
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick.min.js', array(), null, true);
	wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array(), null, false);
	
	wp_localize_script( 'main', 'allAjax', array(
      'ajaxurl' => admin_url( 'admin-ajax.php' ),
      'nonce'   => wp_create_nonce( 'NEHERTUTLAZIT' )
    ) );

}
add_action('wp_enqueue_scripts', 'adv_scripts');



add_action( 'wp_ajax_get_address', 'get_address' );
add_action( 'wp_ajax_nopriv_get_address', 'get_address' );


function get_address() {
  if ( empty( $_REQUEST['nonce'] ) ) {
    wp_die( '0' );
  }

  if ( check_ajax_referer( 'NEHERTUTLAZIT', 'nonce', false ) ) {

	global $wpdb;

	$address = $_POST['descr'];

	$result = $wpdb->get_results( "SELECT DISTINCT `Description` FROM `transfet_base` WHERE `Description` LIKE '%" . $address ."%' ORDER BY `transfet_base`.`Description` ASC");

	$html = '';

	if(!empty($result)) {

		foreach($result as $item) {

			$html .= '<div class="descr-form-wrap__result-item" data-address="' . $item->Description . '">' . $item->Description . '</div>';
		}

	}

	if(empty($html)) {
		$html = '<span class="not-found-result">Ничего не найдено</span>';
	}
	wp_die($html);

  } else {
    wp_die( 'НО-НО-НО!', '', 403 );
  }

}

?>