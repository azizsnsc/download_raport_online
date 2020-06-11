<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->login_model->check_login();
    }

	public function index()
	{
    $data['kelas'] = $this->db->query("select Kelas from siswa where NOT EXISTS(select*from password_walikelas WHERE siswa.Kelas=password_walikelas.Kelas) group by siswa.Kelas");
    $data['pass'] = $this->db->query("select*from password_walikelas");
		$this->load->view('password', $data);
	}

	public function simpan()
	{
    $pos=$this->input->post();
    if (empty($pos['password'])) {
      redirect('password');
    }
    if (empty($pos['kelas'])) {
      $this->db->insert('password_walikelas', ['Kelas'=>$pos['kel'], 'Password'=>md5($pos['password'])]);
      echo $this->session->set_flashdata('msg','success');
      redirect('password');
    } else {
      $this->db->update('password_walikelas', ['Kelas'=>$pos['kel'], 'Password'=>md5($pos['password'])], ['Kelas'=>$pos['kelas']]);
      echo $this->session->set_flashdata('msg','info');
      redirect('password');
    }
  }

}
