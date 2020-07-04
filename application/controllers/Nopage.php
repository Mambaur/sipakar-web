<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nopage extends CI_Controller {
    
    public function index(){
        $this->load->view('not-found');
    }
}