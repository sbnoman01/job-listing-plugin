<?php 


function filter_jobs_view(){ 
    ob_start(); ?>


    <div class="jbl_container">
        <div class="filter_area">
            <?php include WPR_PATH . '/public/partials/job_filters.php'; ?>
        </div>

        <div class="results_area">
            <?php 

                $args = array(
                    'post_type' => 'jobs',
                    'posts_per_page' => 10, 
                    'post_status'   => 'publish'
                );

                $get_cat_term = (sanitize_text_field($_REQUEST['job_cat'])) ? explode(',', sanitize_text_field($_REQUEST['job_cat'])) : null;
                if( $get_cat_term != null && count($get_cat_term) > 0 ){
                    $args['tax_query'][] = [
                        'taxonomy' => 'category',
                        'field'     => 'slug',
                        'terms' => $get_cat_term
                    ];
                }
            
                $search_string =  (sanitize_text_field($_REQUEST['search'])) ? sanitize_text_field($_REQUEST['search']) : null;
                if( $search_string != null && !empty($search_string) ){
                    $args['s'] = $search_string;
                }
                
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
            ?>
        </div>

    <div>

<?php return ob_get_clean();
}