<?php  get_header() ?>


<?php 

/**
 * Process the form submission
 */

if(isset($_POST['apply_now']) && $_SERVER['REQUEST_METHOD'] == 'POST'){

    // Check the Security Nonce
    job_lisitng_config::check_security( 'nonce', 'apply_form');
 
		
    $data = [];
    $data['name'] 	 	= sanitize_text_field( $_POST['user_name'] );
    $data['email']      = sanitize_text_field( $_POST['email'] ) ;
    $data['experience'] = sanitize_text_field( $_POST['experience'] );
    $data['number']     = sanitize_text_field( $_POST['number'] );
    $data['hours']      = sanitize_text_field( $_POST['hours'] );
    $data['job']        = get_the_title();
    $file               = $_FILES['attachment'];

    // upload the pdf to attachment
    $upload_dir = wp_upload_dir();
    $file_name  = basename($file['name']);
    $file_path  = $upload_dir['path'] . '/' . $file_name;

    if (move_uploaded_file($file['tmp_name'], $file_path) && $file['size'] <= 5000000 ) {
            $attachment = array(
                'post_mime_type' => $file['type'],
                'post_title' => sanitize_file_name($file_name),
                'post_content' => '',
                'post_status' => 'inherit'
            );
            $attachment_id = wp_insert_attachment($attachment, $file_path);
            require_once ABSPATH . 'wp-admin/includes/image.php';
            $attachment_data = wp_generate_attachment_metadata($attachment_id, $file_path);
            wp_update_attachment_metadata($attachment_id, $attachment_data);
    }

    $data['attachment'] = wp_get_attachment_url($attachment_id) ?: 'false';

    

    // Send mail

    //$mail_to = 'sbnoman27@gmail.com';
    $mail_to = 'jobs@olympiacamps.com';
    $mail_res = job_lisitng_config::send_mail( $data, $mail_to );
	
    if( isset($mail_res['status']) == 'error' && count($mail_res['error']) > 0 ){
        echo '<div class="res_error">';
        echo '<ul>';
            foreach($mail_res['error'] as $error){
                echo "<li>{$error}</li>";
            }
        echo '</ul>';
        echo '</div>';
    }else{
        echo '<div class="res_error">';
        echo '<span>You have successfully applied to this job! We will check your eligibility and inform you sortly.</span>';
        echo '</div>';
    }
}
?>

<section class="single_job_breadcrumb">
	<div class="single_job_breadcrumb_inner">
		<h1>
			<?php the_title() ?>
		</h1>
	</div>
</section>

<?php the_content() ?>
<div class="job_apply" style="display:none">
    <a href="javasript:void" class="modal-toggle">
        Apply Now
    </a>
</div>


<div class="apply_form">
	<h3>
		Apply This job!
	</h3>
    <form action="<?php the_permalink(); ?>" method="POST" enctype="multipart/form-data">
        <input type="text" name="user_name" class="input_field" placeholder="Full Name*" >
        <input type="email" name="email" class="input_field" placeholder="Email*" >
        <input type="number" name="number" class="input_field" placeholder="Phone*" >
		<textarea name="experience" rows="4" placeholder="Experience*" ></textarea>
		<input type="text" name="hours" class="input_field" placeholder="How many hours a day can you work*" >
		<label>Attach Resume*</label>
        <input type="file" name="attachment" accept=".pdf" >
        <small>Maximum file size is 5MB</small>
        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'apply_form' ) ?>">
        <!-- submit -->
        <input type="submit" name="apply_now" value="Submit">
    </form>
</div>

<?php  get_footer() ?>
