<?php 

class job_filters{

    public function __constract(){
        add_action("wp_ajax_job_filter_callback", [$this, 'job_filter_callback']);
        add_action("wp_ajax_nopriv_job_filter_callback",  [$this, 'job_filter_callback']);
    }

    public function job_filter_callback(){
        // check_ajax_referer('nonce', 'security');
        echo 'test';
        wp_die();
    }
}

// new job_filters();