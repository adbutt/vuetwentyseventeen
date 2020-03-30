<?php

/**
 * Functions to extend the WP Rest API
 *
 * @package WordPress
 */

/**
 * Register custom fields for GET requests.
 *
 * Ref: https://developer.wordpress.org/reference/functions/register_rest_field/
 */
function vuetwentyseventeen_extend_api_response()
{

	register_rest_field(
		array('post', 'restaurants'), // post types.
		'vue_meta', // name of the new key.
		array(
			'get_callback' => 'vue_get_post_meta_fields',
			'update_callback' => null,
			'schema' => null,
		)
	);
}

/**
 * GET callback for the "vue_meta" field defined above.
 *
 * @param array $post_object Details of the current post.
 * @param string $field_name Field Name set in register_rest_field().
 * @param WP_REST_Request $request Current request.
 *
 * @return mixed
 */
function vue_get_post_meta_fields($post_object, $field_name, $request)
{

	// make additional fields available in the response using an associative array.
	$additional_post_data = array();
	$terms = array();
	$term_links = array();

	$post_id = $post_object['id']; // get the post id.
	// foreach ($post_object['categories'] as $category_id) {
	// 	$term_data = get_category($category_id);
	// 	$term_name = $term_data->category_nicename;
	// 	$term_url = get_term_link($term_data->name, $term_data->taxonomy);
	// 	$term_link = "<a href=\"$term_url\">$term_name</a>";

	// 	array_push($terms, $term_name);
	// 	array_push($term_links, $term_link);
	// }
	// add categories, custom excerpt, featured image to the api response.
	$img_id  = get_post_thumbnail_id($post_id);
	$about = get_field('about', $post_id);
	$tel = get_field('phone', $post_id);
	$web = get_field('website_url', $post_id);
	$address = get_field('location_address', $post_id);
	$sup_options = get_field('supply_options', $post_id);
	$img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);
	$postcodes = wp_get_post_terms($post_id, 'postcode', array("fields" => "names"));
	$cuisines = wp_get_post_terms($post_id, 'cuisine', array("fields" => "names"));
	$pcodes = implode(", ", $postcodes);
	$additional_post_data = array(
		'custom_excerpt' => wp_trim_words(
			$post_object['excerpt']['rendered'],
			25,
			' &hellip;'
		),
		'about' => $about,
		'tel' => $tel,
		'web' => $web,
		'address' => $address,
		'terms' => $terms,
		'postcodes' => $postcodes,
		'pcodes' => $pcodes,
		'cuisines' => $cuisines,
		'term_links' => $term_links,
		'supply_options' => $sup_options,
		'featuredmedia_alt' => get_post_meta(
			$img_id,
			'_wp_attachment_image_alt',
			true
		),
		'featuredmedia_url' => get_the_post_thumbnail_url(
			$post_id,
			'full'
		),
	);

	// return data to the get_callback.
	// this data will be made available in the key "vue_meta".
	return $additional_post_data;
}
