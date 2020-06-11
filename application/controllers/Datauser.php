<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datauser extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->login_model->check_login();
    }

	public function index()
	{
        $id = $this->session->userdata('id');
        if($this->session->userdata('akses')=='O') { 
        $data['soa'] = $this->db->get('user');
        } else {
        $data['soa'] = $this->db->get_where('user', ['id'=>$id]);
        }
		$this->load->view('datauser', $data);
	}

    public function simpan()
    {
        $pos = $this->input->post();
        if (empty($pos)) {
            redirect('bagianadmin');
        }
        if (empty($pos['id'])) {
        $a = $this->db->insert('user', ['username'=>$pos['username'], 'password'=>md5($pos['password']), 'nama_user'=>$pos['nama_user'], 'akses'=>$pos['akses']]);
        } else {
        $a = $this->db->update('user', ['username'=>$pos['username'], 'nama_user'=>$pos['nama_user'], 'akses'=>$pos['akses']], ['id'=>$pos['id']]);
        }
        if ($a) {
            echo $this->session->set_flashdata('msg','info');
            redirect('datauser');
        } else {
            echo $this->session->set_flashdata('msg','error');
            redirect('datauser');
        }
    }

    public function ubahpassword(){
        $pos = $this->input->post();
        if (empty($pos)) {
            redirect('bagianadmin');
        }
        $a = $this->db->update('user', ['username'=>$pos['username'], 'password'=>md5($pos['password'])], ['id'=>$this->session->userdata('id')]);
        echo $this->session->set_flashdata('msg','info');
        redirect('password');
    }

    public function hapus()
    {
        $pos = $this->input->post('id');
        $this->db->delete('user', ['id'=>$pos]);
        echo $this->session->set_flashdata('msg','success-hapus');
        redirect('datauser');
    }

}
