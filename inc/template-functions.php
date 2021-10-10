<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package kia
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function kia_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'kia_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function kia_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'kia_pingback_header' );

/**
 * Функция для очистки телефона
 */
function cleanPhone($string) {
	return str_replace([' ', '(', ')', '-'], "", $string);
}

/**
 * Счетчик обратного отсчета
 *
 * @param mixed $date
 * @return
 */
function downcounter($date, $args = [
	'days' => false,
	'hours' => false,
	'minutes' => false,
	'seconds' => false
]) {
	$check_time = strtotime($date) - time();
	if($check_time <= 0) {
		return 0;
	}

	$days = floor($check_time/86400);
	$hours = floor(($check_time%86400)/3600);
	$minutes = floor(($check_time%3600)/60);
	$seconds = $check_time%60; 

	$str = '';
	if (isset($args['days']) && $args['days']) if($days > 0) $str .= declension($days,array('день','дня','дней')).' ';
	if (isset($args['hours']) && $args['hours']) if($hours > 0) $str .= declension($hours,array('час','часа','часов')).' ';
	if (isset($args['minutes']) && $args['minutes']) if($minutes > 0) $str .= declension($minutes,array('минута','минуты','минут')).' ';
	if (isset($args['seconds']) && $args['seconds']) if($seconds > 0) $str .= declension($seconds,array('секунда','секунды','секунд'));

	return $str;
}


/**
 * Функция склонения слов
 *
 * @param mixed $digit
 * @param mixed $expr
 * @param bool $onlyword
 * @return
 */
function declension($digit,$expr,$onlyword=false){
	if(!is_array($expr)) $expr = array_filter(explode(' ', $expr));
	if(empty($expr[2])) $expr[2]=$expr[1];
	$i=preg_replace('/[^0-9]+/s','',$digit)%100;
	if($onlyword) $digit='';
	if($i>=5 && $i<=20) $res=$digit.' '.$expr[2];
	else
	{
		$i%=10;
		if($i==1) $res=$digit.' '.$expr[0];
		elseif($i>=2 && $i<=4) $res=$digit.' '.$expr[1];
		else $res=$digit.' '.$expr[2];
	}
	return trim($res);
}

function toInt($str) {
	return (int)preg_replace('/\s/', '', $str);
}

function price_for_month($field_name, $id, $months) {
	return number_format(toInt(get_field($field_name, $id)) / $months, 0, ' ', ' ');
}