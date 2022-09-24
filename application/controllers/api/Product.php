<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Product extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('product_m');
        $this->load->library('form_validation');
    }

    public function index_get()
    {
     
        $id = $this->get('id');
        
        if(!empty($id)){
            $product = $this->product_m->getById($id);
        }else{
            $product = $this->product_m->getAll();
        }
        

        // If the id parameter doesn't exist return all the users

        if ($id === NULL)
        {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($product)
            {
                // Set the response and exit
                $this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No products were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.
        else {
            $id = (int) $id;

            // Validate the id.
            if ($id <= 0)
            {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the user from the array, using the id as key for retrieval.
            // Usually a model is to be used for this.

            $products = NULL;

            
            if (!empty($product))
            {
                foreach ($product as $key => $value)
                {
                    
                    if (isset($value->id) && $value->id == $id)
                    {
                        $products = $value->id ;
                    }
                }
            }


            if (!empty($products))
            {
                $this->set_response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Product could not be found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }

    public function index_post()
    {
        $name       = $this->post('name');
        $picture    = $this->post('picture');
        $qty        = $this->post('qty');
        $expiredAt  = $this->post('expiredAt');
        $isActive   = $this->post('isActive');
        $id         = $this->post('id');

        $product    = $this->product_m;
        $save       = $product->save($id,$name,$picture,$qty,$expiredAt,$isActive);
            
       if($save == true){
        $message = [
            'message' => 'Added a resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
       }else{
        $message = [
            'message' => 'Error Save Product'
        ];
        $this->response($message, REST_Controller::HTTP_BAD_REQUEST);
       }
        
    }

    public function index_delete($set,$process,$id)
    {

        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        $product    = $this->product_m;
        $delete     = $product->soft_delete($id);

        if($delete == true){
            $message = [
                'id' => $id,
                'message' => 'Deleted the resource'
            ];
    
            $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
        }else{
            $message = [
                'id' => $id,
                'message' => 'Failed Deleted the resource'
            ];
    
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

       
    }

    public function index_put(){
        $name       = $this->put('name');
        $picture    = $this->put('picture');
        $qty        = $this->put('qty');
        $expiredAt  = $this->put('expiredAt');
        $isActive   = $this->put('isActive');
        $id         = $this->put('id');
   

        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        $product    = $this->product_m;
        $update     = $product->update($id,$name,$picture,$qty,$expiredAt,$isActive);
        echo $update;

        if($update == 1){
            $message = [
                'id' => $id,
                'message' => 'Update the resource'
            ];
    
            $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
        }else{
            $message = [
                'id' => $id,
                'message' => 'Failed Update the resource'
            ];
    
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
    }

}
