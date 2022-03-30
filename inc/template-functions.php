<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package kia
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param  array  $classes  Classes for the body element.
 * @return array
 */
function kia_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}

add_filter('body_class', 'kia_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function kia_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}

add_action('wp_head', 'kia_pingback_header');

/**
 * Функция для очистки телефона
 */
function cleanPhone($string)
{
    return preg_replace('/[^0-9\+]/', '', $string);
//	return str_replace([' ', '(', ')', '-'], "", $string);
}

function toInt($str)
{
    return (int) preg_replace('/\s/', '', $str);
}

function price_for_month($field_name, $id, $months)
{
    return number_format(toInt(get_field($field_name, $id)) / $months, 0, ' ', ' ');
}