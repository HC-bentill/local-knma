<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

	}

	 public function upload()
    {
        $this->load->view('upload/upload');
    }

    public function uploadFiles(){
        // POST data
        $config['upload_path'] = 'upload/test/';
        $this->load->library('upload', $config);

        $postdata = $this->input->post();
        
        if ($this->upload->do_upload('uploadedFile'))
        {
            http_response_code(200);
            $data = ['message' => 'Upload was successful'];
            header('Content-type: Application/json');
            echo json_encode($postdata);
        }
        else
        {
            http_response_code(500);
            $data = ['message' => 'An error occured'];
            header('Content-type: Application/json');
            echo json_encode($postdata);

        }


    }

}