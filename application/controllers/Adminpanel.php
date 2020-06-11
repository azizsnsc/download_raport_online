<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminpanel extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
       // $this->load->library('decrypt');
        //$this->akses->check_login();
    }

	public function index()
	{
		$this->load->view('login');
	}

	public function proses()
	{
       //$this->login_model->login();
       $this->load->view('login',['data'=>$this->login_model->login()]);
	}

}
