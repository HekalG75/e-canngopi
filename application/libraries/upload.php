<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload {

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('upload');
    }

    public function do_upload($file_input_name, $upload_path, $allowed_types, $max_size = 0, $encrypt_name = FALSE) {
        $config['upload_path']          = $upload_path;
        $config['allowed_types']        = $allowed_types;
        $config['max_size']             = $max_size; // maximum file size in KB
        $config['encrypt_name']         = $encrypt_name; // encrypt file name

        $this->CI->upload->initialize($config);

        if (!$this->CI->upload->do_upload($file_input_name)) {
            $error = array('error' => $this->CI->upload->display_errors());
            return $error;
        } else {
            $upload_data = $this->CI->upload->data();
            return $upload_data;
        }
    }

}