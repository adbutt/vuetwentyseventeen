<?php
// Register Custom Post Type Restaurants
function create_restaurants_cpt()
{

	$labels = array(
		'name' => _x('Restaurant', 'Post Type General Name', 'invrestaurant'),
		'singular_name' => _x('Restaurants', 'Post Type Singular Name', 'invrestaurant'),
		'menu_name' => _x('Restaurant', 'Admin Menu text', 'invrestaurant'),
		'name_admin_bar' => _x('Restaurants', 'Add New on Toolbar', 'invrestaurant'),
		'archives' => __('Restaurants Archives', 'invrestaurant'),
		'attributes' => __('Restaurants Attributes', 'invrestaurant'),
		'parent_item_colon' => __('Parent Restaurants:', 'invrestaurant'),
		'all_items' => __('All Restaurant', 'invrestaurant'),
		'add_new_item' => __('Add New Restaurants', 'invrestaurant'),
		'add_new' => __('Add New', 'invrestaurant'),
		'new_item' => __('New Restaurants', 'invrestaurant'),
		'edit_item' => __('Edit Restaurants', 'invrestaurant'),
		'update_item' => __('Update Restaurants', 'invrestaurant'),
		'view_item' => __('View Restaurants', 'invrestaurant'),
		'view_items' => __('View Restaurant', 'invrestaurant'),
		'search_items' => __('Search Restaurants', 'invrestaurant'),
		'not_found' => __('Not found', 'invrestaurant'),
		'not_found_in_trash' => __('Not found in Trash', 'invrestaurant'),
		'featured_image' => __('Featured Image', 'invrestaurant'),
		'set_featured_image' => __('Set featured image', 'invrestaurant'),
		'remove_featured_image' => __('Remove featured image', 'invrestaurant'),
		'use_featured_image' => __('Use as featured image', 'invrestaurant'),
		'insert_into_item' => __('Insert into Restaurants', 'invrestaurant'),
		'uploaded_to_this_item' => __('Uploaded to this Restaurants', 'invrestaurant'),
		'items_list' => __('Restaurant list', 'invrestaurant'),
		'items_list_navigation' => __('Restaurant list navigation', 'invrestaurant'),
		'filter_items_list' => __('Filter Restaurant list', 'invrestaurant'),
	);
	$args = array(
		'label' => __('Restaurants', 'invrestaurant'),
		'description' => __('Restaurants Custom Post', 'invrestaurant'),
		'labels' => $labels,
		'menu_icon' => 'dashicons-location-alt',
		'supports' => array('title', 'thumbnail'),
		'taxonomies' => array('postcode'),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type('restaurants', $args);
}
add_action('init', 'create_restaurants_cpt', 0);

// Register Taxonomy Post Code
function create_postcode_tax()
{

	$labels = array(
		'name'              => _x('Post Codes', 'taxonomy general name', 'invrestaurant'),
		'singular_name'     => _x('Post Code', 'taxonomy singular name', 'invrestaurant'),
		'search_items'      => __('Search Post Codes', 'invrestaurant'),
		'all_items'         => __('All Post Codes', 'invrestaurant'),
		'parent_item'       => __('Parent Post Code', 'invrestaurant'),
		'parent_item_colon' => __('Parent Post Code:', 'invrestaurant'),
		'edit_item'         => __('Edit Post Code', 'invrestaurant'),
		'update_item'       => __('Update Post Code', 'invrestaurant'),
		'add_new_item'      => __('Add New Post Code', 'invrestaurant'),
		'new_item_name'     => __('New Post Code Name', 'invrestaurant'),
		'menu_name'         => __('Post Code', 'invrestaurant'),
	);
	$args = array(
		'labels' => $labels,
		'description' => __('Post Code Taxonomy', 'invrestaurant'),
		'hierarchical' => false,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'meta_box_cb' => false,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => false,
		'show_in_quick_edit' => true,
		'show_admin_column' => false,
		'show_in_rest' => true,
	);
	register_taxonomy('postcode', array('restaurants'), $args);
}
add_action('init', 'create_postcode_tax');

// Register Taxonomy Cuisine
function create_cuisine_tax()
{

	$labels = array(
		'name'              => _x('Cuisines', 'taxonomy general name', 'invrestaurant'),
		'singular_name'     => _x('Cuisine', 'taxonomy singular name', 'invrestaurant'),
		'search_items'      => __('Search Cuisines', 'invrestaurant'),
		'all_items'         => __('All Cuisines', 'invrestaurant'),
		'parent_item'       => __('Parent Cuisine', 'invrestaurant'),
		'parent_item_colon' => __('Parent Cuisine:', 'invrestaurant'),
		'edit_item'         => __('Edit Cuisine', 'invrestaurant'),
		'update_item'       => __('Update Cuisine', 'invrestaurant'),
		'add_new_item'      => __('Add New Cuisine', 'invrestaurant'),
		'new_item_name'     => __('New Cuisine Name', 'invrestaurant'),
		'menu_name'         => __('Cuisine', 'invrestaurant'),
	);
	$args = array(
		'labels' => $labels,
		'description' => __('Cuisine Taxonomy', 'invrestaurant'),
		'hierarchical' => false,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => false,
		'show_in_quick_edit' => true,
		'meta_box_cb' => false,
		'show_admin_column' => false,
		'show_in_rest' => true,
	);
	register_taxonomy('cuisine', array('restaurants'), $args);
}
add_action('init', 'create_cuisine_tax');
