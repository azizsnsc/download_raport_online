<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bagianadmin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    if ($this->session->userdata('masuk')!="login_walikelas") {
        redirect('walikelas/login');
    }  
    }

	public function index()
	{
        $uri3 = $this->session->userdata('Kelas');
        $data['sisw'] = $this->db->query("select*from siswa where Kelas='".$uri3."' AND NOT EXISTS(select*from file where siswa.nis=file.nis) order by nis ASC");
        $data['fil'] = $this->db->query("select*from file,siswa where file.nis=siswa.nis AND siswa.Kelas='".$uri3."' order by file.nis ASC");
		$this->load->view('walikelas/untukadmin', $data);
	}

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('walikelas/login');
    }

    public function simpan(){
            $d2 = $this->input->post('NamaLengkap', TRUE);
            $dacak = $this->input->post('nis', TRUE);
            if (empty($d2 && $dacak)) {
            redirect('walikelas/bagianadmin');
            }
            $config['upload_path']          = APPPATH. '../raport/';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 1000;
            $config['file_name']            = $dacak."_".$d2;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('file')){
                $fl = $this->upload->display_errors();
                $this->session->set_flashdata('notif', '<div class="alert alert-danger"><b>PROSES UPLOAD GAGAL! (Max Ukuran File 1 MB dan Berformat PDF)</b>'.$fl.'</div>');
                redirect('walikelas/bagianadmin');
            }else{
                $upload_data = $this->upload->data();
                $data['file'] = $upload_data['file_name'];
                $filenya = $data['file'];
                $this->db->insert('file', ['nis'=>$dacak, 'LinkRaport'=>$filenya, 'StatusDownload'=>'B']);
                $this->session->set_flashdata('notif', '<div class="alert alert-success"><b>PROSES UPLOAD BERHASIL!</b> <br/>Raport Atas Nama <B>'.$d2.'<B/> berhasil di Upload!</div>');
                echo $this->session->set_flashdata('msg','success');
                redirect('walikelas/bagianadmin');
            }
    }

    public function update(){

            $d2 = $this->input->post('NamaLengkap', TRUE);
            $dacak = $this->input->post('nis', TRUE);
            $hps = $this->input->post('link', TRUE);
            $tm = time();

            if (empty($d2 && $dacak)) {
            redirect('walikelas/bagianadmin');
            }

            $config['upload_path']          = APPPATH. '../raport/';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 1000;
            $config['file_name']            = $dacak."_".$d2."_".$tm;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('file')){
                $fl = $this->upload->display_errors();
                $this->session->set_flashdata('notif', '<div class="alert alert-danger"><b>PROSES UPDATE GAGAL! (Max Ukuran File 1 MB dan Berformat PDF)</b>'.$fl.'</div>');
                redirect('walikelas/bagianadmin');
            }else{
                $path = './raport/';
                @unlink($path.$hps);
                $upload_data = $this->upload->data();
                $data['file'] = $upload_data['file_name'];
                $filenya = $data['file'];
                $this->db->update('file', ['LinkRaport'=>$filenya], ['nis'=>$dacak]);
                $this->session->set_flashdata('notif', '<div class="alert alert-info"><b>PROSES UPDATE BERHASIL!</b> <br/>Raport Atas Nama <B>'.$d2.'<B/> berhasil di Update!</div>');
                echo $this->session->set_flashdata('msg','info');
                redirect('walikelas/bagianadmin');
            }
    }

    public function download(){
        $down = "raport/".$this->uri->segment('4');
        force_download($down, NULL);
    }

}
