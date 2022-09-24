<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    var $url;

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        
        $this->load->model('product_m');
        $this->load->helper(array('form', 'url','file'));
        $this->url = base_url('api/');

        // URL
        // get/product
        // get/product/id
        // post/product
        // delete/product/id
        // put/product/id

    }

    public function index()
    {
        $this->load->view('rest_server');
    }

    public function product(){
        $get_url    = file_get_contents($this->url.'get/product');
        $data_array = json_decode($get_url);

        $data['data_product'] = $data_array;

        $this->load->view('admin/product',$data);
    }

    public function product_Id(){
        $id = $this->input->post('id');
        $get_url    = file_get_contents($this->url.'get/product/'.$id);
        $data_array = json_decode($get_url);

        $response['data'] = $data_array;
        http_response_code(200);
        echo json_encode($response);
    }

    public function add_product(){
        ini_set('display_errors', 1);

        $name       = $this->input->post('name');
        $qty        = $this->input->post('qty');
        $expiredAt  = $this->input->post('expired_date');
        
        $file_name                      = rand(100000,9999999999);
		$config['upload_path']          = './uploads/pictures/';
        $config['allowed_types']        = 'png';
		$config['file_name']            = $file_name;
        $config['overwrite']            = true;
        
        // Create folder (Uploads) if not exists
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path']);
        }
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

		if (!$this->upload->do_upload('picture_product')) {
            $response['error'] = $this->upload->display_errors();
			$response['message'] = 'Upload Thumbnail Gagal.';
			http_response_code(422);
			echo json_encode($response);
			exit();
		} else {
            // $uploaded_data = $this->upload->data();
            $data = array('upload_data' => $this->upload->data());
            $filename=$data['upload_data']['file_name'];
            $pathinfo = FCPATH.'uploads/pictures/'.$filename;
            $filecontent = file_get_contents($pathinfo);

            $picture = base64_encode($filecontent);

			$new_data = [
                'id'                    => $file_name,
                'name'                  => $name,
                'picture'               => $picture,
                'qty'                   => $qty,
                'expiredAt'             => $expiredAt,
                'isActive'              => 1,
			];
	
            $data_string = json_encode($new_data);

            $curl = curl_init($this->url.'post/product');

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
            );

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  // Insert the data

            // Send the request
            $result = curl_exec($curl);

            // Free up the resources $curl is using
            curl_close($curl);

            echo $result;
		}

    }

    public function edit_product(){
        $id         = $this->input->post('id_product');
        $name       = $this->input->post('Name');
        $qty        = $this->input->post('qty');
        $expiredAt  = $this->input->post('expired_date');
        $image      = $_FILES['picture']['name'];

        if($image){
            $config['upload_path']          = './uploads/pictures/';
            $config['allowed_types']        = 'png';
            $config['file_name']            = $id;
            $config['overwrite']            = true;
        
            // Create folder (Uploads) if not exists
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path']);
            }
            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('picture')) {
                $response['error'] = $this->upload->display_errors();
                $response['message'] = 'Upload Thumbnail Gagal.';
                http_response_code(422);
                echo json_encode($response);
                exit();
            } else {
                // $uploaded_data = $this->upload->data();
                $data = array('upload_data' => $this->upload->data());
                $filename=$data['upload_data']['file_name'];
                $pathinfo = FCPATH.'uploads/pictures/'.$filename;
                $filecontent = file_get_contents($pathinfo);

                $picture = base64_encode($filecontent);

                $new_data = [
                    'id'                    => $id,
                    'name'                  => $name,
                    'qty'                   => $qty,
                    'picture'               => $picture,
                    'expiredAt'             => $expiredAt,
                    'isActive'              => 1,
                ];
        
                $data_string = json_encode($new_data);

                $curl = curl_init($this->url.'put/product');

                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");

                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
                );

                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  // Insert the data

                // Send the request
                $result = curl_exec($curl);

                // Free up the resources $curl is using
                curl_close($curl);

                echo $result;
            }
        }else{

			$new_data = [
                'id'                    => $id,
                'name'                  => $name,
                'qty'                   => $qty,
                'expiredAt'             => $expiredAt,
                'isActive'              => 1,
			];
	
            $data_string = json_encode($new_data);

            $curl = curl_init($this->url.'put/product');

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");

            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
            );

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  // Insert the data

            // Send the request
            $result = curl_exec($curl);

            // Free up the resources $curl is using
            curl_close($curl);

            echo $result;

        }

    }

    public function delete_product(){
        $id         = $this->input->post('id');
        
        $new_data = [
            'id'                  => $id,
        ];

        $data_string = json_encode($new_data);

        $curl = curl_init($this->url.'delete/product/'.$id);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");

        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string))
        );

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  // Insert the data

        // Send the request
        $result = curl_exec($curl);

        // Free up the resources $curl is using
        curl_close($curl);

        echo $result;

    }
}
