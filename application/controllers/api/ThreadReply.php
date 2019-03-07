<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class ThreadReply extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ThreadModel', 'thread');
    }

    public function index_post() {

        $result = false;

        $threadId = $this->post('threadId');
        $balasan = $this->post('balasan');

        if ($threadId && $balasan) {
            $result = $this->thread->insertThreadReply($threadId, $balasan);

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
                'message' => 'All field should not be empty!'
            ];
    
            $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}