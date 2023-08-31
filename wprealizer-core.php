<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wprealizer.com
 * @since             1.0.0
 * @package           Wprealizer_Core
 *
 * @wordpress-plugin
 * Plugin Name:       wprealizer core
 * Plugin URI:        https://wprealizer.com
 * Description:       Custom Job listing plugin
 * Version:           1.0.0
 * Author:            wprealizer
 * Author URI:        https://wprealizer.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wprealizer
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WPREALIZER_CORE_VERSION', '1.0.0' );

define( 'WPR_PATH', dirname(__FILE__) );
define( 'WPR_PLUGIN_URL', plugin_dir_url(__FILE__) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wprealizer-core-activator.php
 */
function activate_wprealizer_core() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wprealizer-core-activator.php';
	Wprealizer_Core_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wprealizer-core-deactivator.php
 */
function deactivate_wprealizer_core() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wprealizer-core-deactivator.php';
	Wprealizer_Core_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wprealizer_core' );
register_deactivation_hook( __FILE__, 'deactivate_wprealizer_core' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wprealizer-core.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wprealizer_core() {

	$plugin = new Wprealizer_Core();
	$plugin->run();

}
run_wprealizer_core();


add_action("wp_ajax_job_filter_callback", 'job_filter_callback');
add_action("wp_ajax_nopriv_job_filter_callback",  'job_filter_callback');

function job_filter_callback(){
	check_ajax_referer('nonce', 'security');
	
	
	$post_args = [
        'post_type' => 'jobs',
        'post_status' => 'publish',
        'posts_per_page' => get_option( 'posts_per_page' ),
        'tax_query' => ['relation' => 'AND'],
        'paged'=> $paged
    ];

    $get_type_term = (sanitize_text_field($_REQUEST['type'])) ? explode(',', sanitize_text_field($_REQUEST['type'])) : null;
    if( $get_type_term != null && count($get_type_term) > 0 ){
        $post_args['tax_query'][] = [
            'taxonomy' => 'job-type',
            'field'     => 'slug',
            'terms' => $get_type_term 
        ];
    }

    $get_cat_term = (sanitize_text_field($_REQUEST['cat'])) ? explode(',', sanitize_text_field($_REQUEST['cat'])) : null;
    if( $get_cat_term != null && count($get_cat_term) > 0 ){
        $post_args['tax_query'][] = [
            'taxonomy' => 'category',
            'field'     => 'slug',
            'terms' => $get_cat_term 
        ];
    }

	$get_loc_term = (sanitize_text_field($_REQUEST['location'])) ? explode(',', sanitize_text_field($_REQUEST['location'])) : null;
    if( $get_loc_term != null && count($get_loc_term) > 0 ){
        $post_args['tax_query'][] = [
            'taxonomy' => 'job-location',
            'field'     => 'slug',
            'terms' => $get_loc_term
        ];
    }

	$get_spec_term = (sanitize_text_field($_REQUEST['specific'])) ? explode(',', sanitize_text_field($_REQUEST['specific'])) : null;
    if( $get_spec_term != null && count($get_spec_term) > 0 ){
        $post_args['tax_query'][] = [
            'taxonomy' => 'job-specific',
            'field'     => 'slug',
            'terms' => $get_spec_term
        ];
    }

	$get_seas_term = (sanitize_text_field($_REQUEST['season'])) ? explode(',', sanitize_text_field($_REQUEST['season'])) : null;
    if( $get_seas_term != null && count($get_seas_term) > 0 ){
        $post_args['tax_query'][] = [
            'taxonomy' => 'job-season',
            'field'     => 'slug',
            'terms' => $get_seas_term
        ];
    }

    $search_string =  (sanitize_text_field($_REQUEST['search'])) ? sanitize_text_field($_REQUEST['search']) : null;
    if( $search_string != null && !empty($search_string) ){
        $post_args['s'] = $search_string;
    }

    $post_query = new WP_Query($post_args);

	// echo '<pre>';

	// print_r($post_query);
	// exit;

	if ($post_query->have_posts()) {
		ob_start();

		while ($post_query->have_posts()) {
			$post_query->the_post();
	
			// Display or process the post data
			include WPR_PATH . '/public/partials/job-listing-items.php';
			// You can add more code to display other post data as needed

		}
		wp_reset_postdata(); // Reset the post data to the main loop
		$content = ob_get_clean();
	}

	wp_send_json( [
		'content'		=> $content,
		'found_post'	=> $post_query->found_posts,
		'query'			=> $post_args['tax_query']
	] );

	wp_die();
}