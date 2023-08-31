<?php 

function jbl_listing_view(){
    ob_start();

    $args = array(
        'post_type' => 'jobs',
        'posts_per_page' => 10, 
        'post_status'   => 'publish'
    );
    
    $query = new WP_Query($args);
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
    
            // Display or process the post data
            include WPR_PATH . '/public/partials/job-listing-items.php';
            // You can add more code to display other post data as needed
        }
        wp_reset_postdata(); // Reset the post data to the main loop
    } else {
        echo 'Sorry, no jobs found!';
    }

    return ob_get_clean();
}
