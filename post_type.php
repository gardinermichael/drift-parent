<?php 

add_action( 'init', 'create_issues' );
function create_issues() {
  $labels = array(

    'name' => _x('Issues', 'post type general name'),

    'singular_name' => _x('Issues', 'post type singular name'),

    'add_new' => _x('Add New Issue', ''),

    'add_new_item' => __('Add New Issue'),

    'edit_item' => __('Edit Issue'),

    'new_item' => __('New Issue'),

    'view_item' => __('View Issue'),

    'search_items' => __('Search Issue'),

    'not_found' =>  __('No  found Issue'),

    'not_found_in_trash' => __('No found Issue in Trash'),

    'parent_item_colon' => ''

  );

  $supports = array('title','editor','excerpt','trackbacks','thumbnail','comments','revisions','author','page-attributes');

  

  register_post_type( 'issue', 

    array(

            'labels' => $labels,

            'public' => true,

            'supports' => $supports,

        	  'hierarchical' => true,

            'menu_position'       => 10,

        	  'rewrite' => array('slug' => 'issue', 'with_front' => false),

         )

  );

}


// Mention post type here 

add_action( 'init', 'create_mentions' );
function create_mentions() {
  $labels = array(

    'name' => _x('Mentions', 'post type general name'),

    'singular_name' => _x('Mentions', 'post type singular name'),

    'add_new' => _x('Add New Mention', ''),

    'add_new_item' => __('Add New Mention'),

    'edit_item' => __('Edit Mention'),

    'new_item' => __('New Mention'),

    'view_item' => __('View Mention'),

    'search_items' => __('Search Mention'),

    'not_found' =>  __('No  found Mention'),

    'not_found_in_trash' => __('No found Mention in Trash'),

    'parent_item_colon' => ''

  );

  $supports = array('title','editor','excerpt','trackbacks','thumbnail','comments','revisions','author','page-attributes');

  

  register_post_type( 'mention', 

    array(

            'labels' => $labels,

            'public' => true,

            'supports' => $supports,

            'hierarchical' => true,

            'menu_position'       => 10,

            'rewrite' => array('slug' => 'mention', 'with_front' => false),

         )

  );

}