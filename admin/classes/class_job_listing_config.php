<?php 


class job_lisitng_config{
    
    private static $c_instance;
    public $nonce_source;
    public static function getInstance() {
        if ( ! self::$c_instance ){
            self::$c_instance = new self;
        }
        return self::$c_instance;
    }

    /**
    *
    * check the nonce
    *
    * @since  1.0.0
    * @param  nonce_source peramiter accept the source of nocne
    * @param  nonce_name peramiter accept nonce name
    * @param  nonce_name peramiter accept nonce name
    * @param  erro_message peramiter accept error meassage
    */
    public static function check_security( $nonce_source, $nonce_name, $erro_message = ''){
        $nonce_s = $_REQUEST[$nonce_source];
        $message = __('Faild to verify Security. Please try again.', 'wprealizer');

        if( !wp_verify_nonce( $nonce_s, $nonce_name ) ):
            die( apply_filters( 'jbl_security_faild', $message ) );
        else:
            return;
        endif;

    }

    public static function send_mail( $data, $mail_to ){
        
        if(is_array($data) && !empty($mail_to)){
            $error  = [];
            $res    = [];

            foreach($data as $key => $item){
                if(!empty($item) ){
                    if($key == 'email' && !filter_var($item, FILTER_VALIDATE_EMAIL)){
                        $error[$key] = ucfirst($key) . ' is not valid';
                    }
                    if($key == 'attachment' && $item == 'false'){
                        $error[$key] = ucfirst($key) . ' upload faild, please check your file size';
                    }
                    continue;
                }else{
                    $error[$key] = ucfirst($key) . ' is Required';
                }
            }

            if(is_array($error) && (count($error) > 0)){
                $res['status'] = 'error';
                $res['error'] = $error;
                return $res;
            }else{
               
                // send the mail

                $subject = $data['name'] . ' Apply for a possition';
                $body = '
                <table style="width:50%">
                    <tr>
                        <td><strong>Apply for:</strong></td>
                        <td>'. $data['job'] .'</td>
                    </tr>
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td>'. $data['name'] .'</td>
                    </tr>
                    <tr>
                        <td><strong>Number:</strong></td>
                        <td>'. $data['number'] . '</td>
                    </tr>
                    <tr>
                        <td><strong>Experience:<strong></td>
                        <td>'. $data['experience'] . '</td>
                    </tr>
                    <tr>
                        <td><strong>Hours a day:<strong></td>
                        <td>'. $data['hour'] . '</td>
                    </tr>
                    <tr>
                        <td><strong>Attached Resume:<strong></td>
                        <td><a href="'. $data['attachment_url'] .'">Click Here</td>
                    </tr>
                </table>
                ';
                $headers = array('Content-Type: text/html; charset=UTF-8');
                wp_mail( $mail_to, $subject, $body, $headers );

                return $res['status'] = 'success';
            }
            
        }
    }
	
}