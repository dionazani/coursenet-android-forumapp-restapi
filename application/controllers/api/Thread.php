<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Thread extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ThreadModel', 'thread');
    }

    public function index_get() {
        $thread = $this->thread->getThread();
        $this->response($thread, REST_Controller::HTTP_OK);
    }

    public function index_post() {

        $result = false;

        $judul = $this->post('judul');
        $isi = $this->post('isi');
        $registerCreateId = $this->post('registerCreateId');

        if ($judul && $isi) {
            $result = $this->thread->insertThread($judul, $isi, $registerCreateId);

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

    public function index_put() {
        $result = false;

        $id = $this->put('id');
        $stars = $this->put('stars');

        $thread = $this->thread->getThread($id);

        if (empty($thread[0]["rating_star"])) {
            if ($id && $stars) {
                $result = $this->thread->giveStarToThread($id, $stars);
    
                if ($result) {
                    $message = [
                        'result' => $result,
                        'message' => 'Thank you to give Star !'
                    ];
            
                    $this->set_response($message, REST_Controller::HTTP_CREATED);
                }
                else {
                    $message = [
                        'result' => $result,
                        'message' => 'Updated star failed !'
                    ];
            
                    $this->set_response($message, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
            }
            else {
                $message = [
                    'result' => $result,
                    'message' => 'Please give at least 1 star !'
                ];
        
                $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
            }
        }
        else {
            $message = [
                'result' => $result,
                'message' => 'Star has already given !'
            ];
    
            $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}