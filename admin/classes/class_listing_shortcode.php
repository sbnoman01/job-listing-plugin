<?php 



class Listing_shortcode{


    public function __construct(){

    }

    public  function display_job_listing(){
        return 'test';
    }


    public function job_listing_view() {

        $path = WPR_PATH . '/public/partials/jbl_listing_view.php';
        if( file_exists($path) ){
            require $path;
            return jbl_listing_view();
        }
    }
    public function filter_jobs_list_view() {

        $path = WPR_PATH . '/public/partials/filter_jobs_view.php';
        if( file_exists($path) ){
            require $path;
            return filter_jobs_view();
        }
    }

    public function job_search_form_view() {

        $path = WPR_PATH . '/public/partials/job_search_form_view.php';
        if( file_exists($path) ){
            require $path;
            return job_search_form_view();
        }
    }
}