<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class register extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('RegisterModel', 'register');
    }

    public function index_get() {
        $result = false;

        $username = $this->get('username');
        $password = $this->get('password');

        if ($username && $password) {
            $result = $this->register->getRegister($username, $password);
            $message = [
                'result' => $result,
                'message' => 'Login success'
            ];
            $this->set_response($message, REST_Controller::HTTP_OK);
        }
        else {
            $message = [
                'result' => $result,
                'message' => 'All field should not be empty!'
            ];
    
            $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_post() {

        $result = false;

        $nama = $this->post('nama');
        $email = $this->post('email');
        $password = $this->post('password');;

        if ($nama && $email && $password) {
            if (!$this->register->isEmailExists($email)) {
                $result = $this->register->insertRegister($nama, $email, $password);

                if ($result) {
                    $message = [
                        'result' => $result,
                        'message' => 'Added a new resource'
                    ];
            
                    $this->set_response($message, REST_Controller::HTTP_CREATED);
                }
                else {
                    $message = [
                        'result' => $result,
                        'message' => 'Insert failed !'
                    ];
            
                    $this->set_response($message, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
            }
            else {
                $message = [
                    'result' => $result,
                    'message' => 'Email is exits!'
                ];
        
                $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
            }
        }
        else {
            $message = [
                'result' => $result,
                'message' => 'All field should not be empty!'
            ];
    
            $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}