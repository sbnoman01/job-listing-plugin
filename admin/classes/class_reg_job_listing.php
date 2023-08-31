<?php 


/**
*
* Job board class to registering CPT
*
* @since  1.0.0
*/


class Job_listing{

    public function __construct(){
        
        //init Job Listing
        add_action( 'init', [$this, 'custom_post_type']);
        add_action( 'init', [$this, 'registering_taxonomies']);
        add_filter( 'template_include', array( $this, 'saasto_block_include' ) );

    }

    public function saasto_block_include( $template ) {
		if ( is_singular( 'jobs' ) ) {
			return $this->get_template('jbl_single-jobs.php');
		}
		return $template;
	}
	
	
	public function get_template( $template ) {
		if ( $theme_file = locate_template( array( $template ) ) ) {
			$file = $theme_file;
		} 
		else {
			$file = WPR_PATH . '/public/partials/'. $template;
		}
		return apply_filters( __FUNCTION__, $file, $template );
	}

    // Register Custom Job Listing
    public function custom_post_type() {

        $labels = array(
            'name'                  => _x( 'Job Listings', 'Job Listing General Name', 'wprealizer' ),
            'singular_name'         => _x( 'Job Listing', 'Job Listing Singular Name', 'wprealizer' ),
            'menu_name'             => __( 'Job Listings', 'wprealizer' ),
            'name_admin_bar'        => __( 'Job Listing', 'wprealizer' ),
            'archives'              => __( 'Item Archives', 'wprealizer' ),
            'attributes'            => __( 'Item Attributes', 'wprealizer' ),
            'parent_item_colon'     => __( 'Parent Item:', 'wprealizer' ),
            'all_items'             => __( 'All Items', 'wprealizer' ),
            'add_new_item'          => __( 'Add New Item', 'wprealizer' ),
            'add_new'               => __( 'Add New', 'wprealizer' ),
            'new_item'              => __( 'New Item', 'wprealizer' ),
            'edit_item'             => __( 'Edit Item', 'wprealizer' ),
            'update_item'           => __( 'Update Item', 'wprealizer' ),
            'view_item'             => __( 'View Item', 'wprealizer' ),
            'view_items'            => __( 'View Items', 'wprealizer' ),
            'search_items'          => __( 'Search Item', 'wprealizer' ),
            'not_found'             => __( 'Not found', 'wprealizer' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'wprealizer' ),
            'featured_image'        => __( 'Featured Image', 'wprealizer' ),
            'set_featured_image'    => __( 'Set featured image', 'wprealizer' ),
            'remove_featured_image' => __( 'Remove featured image', 'wprealizer' ),
            'use_featured_image'    => __( 'Use as featured image', 'wprealizer' ),
            'insert_into_item'      => __( 'Insert into item', 'wprealizer' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'wprealizer' ),
            'items_list'            => __( 'Items list', 'wprealizer' ),
            'items_list_navigation' => __( 'Items list navigation', 'wprealizer' ),
            'filter_items_list'     => __( 'Filter items list', 'wprealizer' ),
        );
        $args = array(
            'label'                 => __( 'Job Listing', 'wprealizer' ),
            'description'           => __( 'Job Listing Description', 'wprealizer' ),
            'labels'                => $labels,
            'supports'              => ['title', 'editor', 'excerpt'],
            'hierarchical'          => false,
            'public'                => true,
            'menu_icon'             => 'dashicons-businessman',
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );
        register_post_type( 'jobs', $args );
    }
    
    public function registering_taxonomies() {
        register_taxonomy( 'job-category', array(
            0 => 'jobs',
        ), array(
            'labels' => array(
                'name' => 'Job categories',
                'singular_name' => 'Job category',
                'menu_name' => 'Job categories',
                'all_items' => 'All Job categories',
                'edit_item' => 'Edit Job category',
                'view_item' => 'View Job category',
                'update_item' => 'Update Job category',
                'add_new_item' => 'Add New Job category',
                'new_item_name' => 'New Job category Name',
                'parent_item' => 'Parent Job category',
                'parent_item_colon' => 'Parent Job category:',
                'search_items' => 'Search Job categories',
                'not_found' => 'No job categories found',
                'no_terms' => 'No job categories',
                'filter_by_item' => 'Filter by job category',
                'items_list_navigation' => 'Job categories list navigation',
                'items_list' => 'Job categories list',
                'back_to_items' => '← Go to job categories',
                'item_link' => 'Job category Link',
                'item_link_description' => 'A link to a job category',
            ),
            'public' => true,
            'hierarchical' => true,
            'show_in_menu' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
        ) );
    
        register_taxonomy( 'job-type', array(
            0 => 'jobs',
        ), array(
            'labels' => array(
                'name' => 'Job Types',
                'singular_name' => 'Job Type',
                'menu_name' => 'Job Types',
                'all_items' => 'All Job Types',
                'edit_item' => 'Edit Job Type',
                'view_item' => 'View Job Type',
                'update_item' => 'Update Job Type',
                'add_new_item' => 'Add New Job Type',
                'new_item_name' => 'New Job Type Name',
                'parent_item' => 'Parent Job Type',
                'parent_item_colon' => 'Parent Job Type:',
                'search_items' => 'Search Job Types',
                'not_found' => 'No job types found',
                'no_terms' => 'No job types',
                'filter_by_item' => 'Filter by job type',
                'items_list_navigation' => 'Job Types list navigation',
                'items_list' => 'Job Types list',
                'back_to_items' => '← Go to job types',
                'item_link' => 'Job Type Link',
                'item_link_description' => 'A link to a job type',
            ),
            'public' => true,
            'hierarchical' => true,
            'show_in_menu' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
        ) );
    
        register_taxonomy( 'job-location', array(
            0 => 'jobs',
        ), array(
            'labels' => array(
                'name' => 'Locations',
                'singular_name' => 'Location',
                'menu_name' => 'Location',
                'all_items' => 'All Location',
                'edit_item' => 'Edit Location',
                'view_item' => 'View Location',
                'update_item' => 'Update Location',
                'add_new_item' => 'Add New Location',
                'new_item_name' => 'New Location Name',
                'parent_item' => 'Parent Location',
                'parent_item_colon' => 'Parent Location:',
                'search_items' => 'Search Location',
                'not_found' => 'No location found',
                'no_terms' => 'No location',
                'filter_by_item' => 'Filter by location',
                'items_list_navigation' => 'Location list navigation',
                'items_list' => 'Location list',
                'back_to_items' => '← Go to location',
                'item_link' => 'Location Link',
                'item_link_description' => 'A link to a location',
            ),
            'public' => true,
            'hierarchical' => true,
            'show_in_menu' => true,
            'show_in_rest' => true,
        ) );
    
        register_taxonomy( 'job-season', array(
            0 => 'jobs',
        ), array(
            'labels' => array(
                'name' => 'Seasons',
                'singular_name' => 'Season',
                'menu_name' => 'Seasons',
                'all_items' => 'All Seasons',
                'edit_item' => 'Edit Season',
                'view_item' => 'View Season',
                'update_item' => 'Update Season',
                'add_new_item' => 'Add New Season',
                'new_item_name' => 'New Season Name',
                'parent_item' => 'Parent Season',
                'parent_item_colon' => 'Parent Season:',
                'search_items' => 'Search Seasons',
                'not_found' => 'No seasons found',
                'no_terms' => 'No seasons',
                'filter_by_item' => 'Filter by season',
                'items_list_navigation' => 'Seasons list navigation',
                'items_list' => 'Seasons list',
                'back_to_items' => '← Go to seasons',
                'item_link' => 'Season Link',
                'item_link_description' => 'A link to a season',
            ),
            'public' => true,
            'hierarchical' => true,
            'show_in_menu' => true,
            'show_in_rest' => true,
        ) );
    
        register_taxonomy( 'job-specific', array(
            0 => 'jobs',
        ), array(
            'labels' => array(
                'name' => 'specifics',
                'singular_name' => 'specific',
                'menu_name' => 'specifics',
                'all_items' => 'All specifics',
                'edit_item' => 'Edit specific',
                'view_item' => 'View specific',
                'update_item' => 'Update specific',
                'add_new_item' => 'Add New specific',
                'new_item_name' => 'New specific Name',
                'parent_item' => 'Parent specific',
                'parent_item_colon' => 'Parent specific:',
                'search_items' => 'Search specifics',
                'not_found' => 'No specifics found',
                'no_terms' => 'No specifics',
                'filter_by_item' => 'Filter by specific',
                'items_list_navigation' => 'specifics list navigation',
                'items_list' => 'specifics list',
                'back_to_items' => '← Go to specifics',
                'item_link' => 'specific Link',
                'item_link_description' => 'A link to a specific',
            ),
            'public' => true,
            'hierarchical' => true,
            'show_in_menu' => true,
            'show_in_rest' => true,
        ) );
    }
    
    
    
}
new Job_listing();