<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datasekolah extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->login_model->check_login();
    }

	public function index()
	{
		$this->load->view('datasekolah');
	}

    public function simpan()
    {
        $pos = $this->input->post();
        if (empty($pos)) {
            redirect('bagianadmin');
        }
        if(empty($_FILES['gambar']['name'])) {
            $a = $this->db->update('sekolah', ['Judul'=>$pos['Judul'], 'NamaSekolah'=>$pos['NamaSekolah'], 'AlamatSekolah'=>$pos['AlamatSekolah']], ['id'=>1]);
        } else {
            unlink("assets/images/".$pos['logo']);
            $config['upload_path']          = 'assets/images/';  // foler upload 
            $config['allowed_types']        = 'gif|jpg|png'; // jenis file
            $config['max_size']             = 3000;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
 
            $this->load->library('upload', $config);
 
            if ( ! $this->upload->do_upload('gambar')) //sesuai dengan name pada form 
            {
                   echo 'anda belum upload logo';
            }
            else
            {
                //tampung data dari form
                $file = $this->upload->data();
                $gambar = $file['file_name'];
                $a = $this->db->update('sekolah', ['Judul'=>$pos['Judul'], 'NamaSekolah'=>$pos['NamaSekolah'], 'AlamatSekolah'=>$pos['AlamatSekolah'], 'LogoSekolah'=>$gambar], ['id'=>1]);
            }
        }

        if ($a) {
            echo $this->session->set_flashdata('msg','info');
            redirect('datasekolah');
        } else {
            echo $this->session->set_flashdata('msg','error');
            redirect('datasekolah');
        }
    }

    public function jadwal() {
        $data['jwl'] = $this->db->get_where('sekolah', ['id'=>2])->row_array();
        $this->load->view('datajadwal', $data);
    }

    public function simpanjadwal(){
        $pos=$this->input->post();
        if (empty($pos)) {
            redirect('datasekolah/jawal');
        }
        $this->db->update('sekolah', ['Judul'=>$pos['Judul'], 'NamaSekolah'=>$pos['NamaSekolah']], ['id'=>2]);
        echo $this->session->set_flashdata('msg','info');
        redirect('datasekolah/jadwal');
    }

}
