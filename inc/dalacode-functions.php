<?php

    function getMinPriceOfModel($post_name) {
        $current_model_slug = $post_name;
        $configurations = new WP_Query([
            'post_type' => 'configs',
            'model' => $current_model_slug,
        ]);
    
        $prices_array = [];
    
        foreach ($configurations->posts as $post) :
            $prices_array[] = get_field('price', $post->ID);
        endforeach;
        $model_min_price = min(...$prices_array);
        $GLOBALS['model_min_price'] = $model_min_price;
        wp_reset_query();
    }