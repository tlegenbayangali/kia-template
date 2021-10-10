<?php 
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
        'page_title' => 'Опции главного меню',
        'menu_title' => 'Опции главного меню',
        'menu_slug' => 'menu-opt',
    ));
	
}