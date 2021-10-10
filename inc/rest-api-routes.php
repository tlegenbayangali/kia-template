<?php 
function dalacode_testdrive_models() {
	$args = [
		'post_type' => 'models',
		'post_parent' => 0
	];

	$models = new WP_Query($args);

	$data = [];
	$i = 0;

	foreach($models->posts as $model) {
		$data[$i]['id'] = $model->ID;
		$data[$i]['title'] = $model->post_title;
		$data[$i]['slug'] = $model->post_name;
		$data[$i]['image'] = get_the_post_thumbnail( $model->ID, 'full' );
		$data[$i]['starting_price'] = get_field('starting_price', $model->ID);
		$i++;
	}

	return $data;
}

function dalacode_testdrive_model($request) {
    $args = [
        'name' => $request['slug'],
        'post_type' => 'models',
    ];

    $model = new WP_Query($args);

    $data = [];

    $data['id'] = $model->posts[0]->ID;
    $data['title'] = $model->posts[0]->post_title;
    $data['slug'] = $model->posts[0]->post_name;
    $data['image'] = get_the_post_thumbnail( $model->posts[0]->ID, 'full' );
    $data['starting_price'] = get_field('starting_price', $model->posts[0]->ID);

    return $data;
}

add_action('rest_api_init', function() {
	register_rest_route( 'dalacode/v1', 'test-drive/models', [
		'methods' => 'GET',
		'callback' => 'dalacode_testdrive_models',
	]);
	register_rest_route( 'dalacode/v1', 'test-drive/models/(?P<slug>[a-zA-Z0-9-]+)', [
		'methods' => 'GET',
		'callback' => 'dalacode_testdrive_model',
	]);
});