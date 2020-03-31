<?php

/**
 * Functions to enqueue styles and scripts.
 *
 * @package WordPress
 */

/**
 * Load parent theme styles.
 */
function vuetwentyseventeen_enqueue_styles()
{

	$parent_style = 'parent-style'; // the 'twentyseventeen-style' from the Twenty Seventeen theme.

	wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
	wp_enqueue_style(
		'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array($parent_style),
		wp_get_theme()->get('Version')
	);

	// add Bootstrap to the child theme.
	wp_register_style( // Bootstrap styles.
		'vue_bootstrap_styles',
		get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css',
		array(),
		false,
		'all'
	);

	wp_register_script(  // Bootstrap scripts.
		'vue_bootstrap_script',
		get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js',
		array('jquery'),
		false,
		true
	);

	// enqueue the Bootstrap script and styles.
	wp_enqueue_style('vue_bootstrap_styles');
	wp_enqueue_style('vue_bootstrap_script');
}

/**
 * Function to conditionally enqueue the Vue Single Page App based on the WordPress Custom Page Template.
 *
 * This is done by enqueueing the Vue build script generated by Webpack.
 */
function vuetwentyseventeen_enqueue_spa_scripts()
{
	if (is_page_template('templates/vue-search-app-template.php')) {

		// register the Vue build script.
		wp_register_script( // the app build script generated by Webpack.
			'vue_search_app',
			get_stylesheet_directory_uri() . '/restfind/dist/build.js', // for development: 'http://localhost:8080/dist/build.js'.
			// 'http://localhost:8080/dist/build.js',
			array(),
			false,
			true
		);

		// make custom data available to the Vue app with wp_localize_script.
		global $post;
		wp_localize_script(
			'vue_search_app', // vue script handle.
			'wpData', // javascript object.
			array( // WordPress data to be made available to the Vue app.
				'template_directory_uri' => get_stylesheet_directory_uri(),
				'rest_url' => untrailingslashit(esc_url_raw(rest_url())), // URL to the REST endpoint.
				'app_path' => $post->post_name, // page where the custom page template is loaded.
				'post_categories' => get_terms(array( // default post categories.
					'taxonomy' => 'cuisine',
					'hide_empty' => true,
					'fields' => 'names',
				)),
				'supply_options' => ['delivery', 'pickup', 'both'],
				'sup_options' => ['delivery', 'pickup'],
			)
		);

		// enqueue the Vue app script with localized data.
		wp_enqueue_script('vue_search_app');
	}
}
