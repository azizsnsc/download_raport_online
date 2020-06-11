<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datasiswa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->login_model->check_login();
    }

    public function index()
    {
        $data['soa'] = $this->db->get('siswa');
        $this->load->view('datasiswa', $data);
    }

    public function kosong() {
        $this->db->query('delete from siswa');
        $this->db->query('delete from password_walikelas');
        echo $this->session->set_flashdata('msg','success-hapus');
        redirect('datasiswa');
    }

    public function uploaddata()
    {
        include APPPATH.'third_party/PHPExcel.php';

        $config['upload_path'] = realpath('excel');
        $config['allowed_types'] = 'xlsx|xls|csv';
        $config['max_size'] = '10000';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {

            //upload gagal
            $this->session->set_flashdata('notif', '<div class="alert alert-danger"><b>PROSES IMPORT GAGAL!</b> '.$this->upload->display_errors().'</div>');
            //redirect halaman
            redirect('datasiswa/');

        } else {

            $data_upload = $this->upload->data();

            $excelreader     = new PHPExcel_Reader_Excel2007();
            $loadexcel         = $excelreader->load('excel/'.$data_upload['file_name']); // Load file yang telah diupload ke folder excel
            $sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

            $data = array();

            $numrow = 1;
            foreach($sheet as $row){
                            if($numrow > 1){
                                array_push($data, array(
                                    'ID' => $row['A'],
                                    'nis'      => $row['B'],
                                    'NamaLengkap' => $row['C'],
                                    'Kelas' => $row['D']
                                ));
                    }
                $numrow++;
            }
            $this->db->insert_batch('siswa', $data);
            //delete file from server
            unlink(realpath('excel/'.$data_upload['file_name']));

            //upload success
            $this->session->set_flashdata('notif', '<div class="alert alert-success"><b>PROSES IMPORT BERHASIL!</b> Data berhasil diimport!</div>');
            //redirect halaman
            redirect('datasiswa/');

        }
    }

    public function downloadexcel(){
        force_download('excel/tempelate/TempelateUploadSiswa.xlsx',NULL);
    }

    public function simpan(){
        $pos = $this->input->post();
        $a = $this->db->insert('siswa', ['nis'=>$pos['nis'], 'NamaLengkap'=>$pos['NamaLengkap'], 'Kelas'=>$pos['Kelas']]);
        if ($a) {
            echo $this->session->set_flashdata('msg','success');
            redirect('datasiswa');
        } else {
            echo $this->session->set_flashdata('msg','error');
            redirect('datasiswa');
        }
    }

    public function ubah(){
        $pos = $this->input->post();
        $a = $this->db->update('siswa', ['nis'=>$pos['nis'], 'NamaLengkap'=>$pos['NamaLengkap'], 'Kelas'=>$pos['Kelas']], ['ID'=>$pos['ID']]);
        if ($a) {
            echo $this->session->set_flashdata('msg','info');
            redirect('datasiswa');
        } else {
            echo $this->session->set_flashdata('msg','error');
            redirect('datasiswa');
        }
    }

    public function hapus()
    {
        $pos = $this->input->post('ID');
        $this->db->delete('siswa', ['ID'=>$pos]);
        echo $this->session->set_flashdata('msg','success-hapus');
        redirect('datasiswa');
    }

}
