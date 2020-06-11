<?php
class Loginaplikasi extends CI_Controller{
    function __construct(){
        parent:: __construct();
    }
    function index(){
        $this->load->view('v_login');
    }
    function proses(){
        $username=strip_tags(str_replace("'", "", $this->input->post('username')));
        $password=strip_tags(str_replace("'", "", $this->input->post('password')));
        $u=$username;
        $p=$password;
        if (empty($username and $password)) {
            redirect(site_url('./'));
        }
       if ($username!=$password) {
        $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Username Atau Password Salah</div>');
         redirect('./');
       }
       $dg = $this->db->get_where('siswa',['nis'=>$password]);
       $dg1 = $dg->num_rows();
       $dg2 = $dg->row_array();
       if(!empty($dg1)) {
        $datasesi = array('nis' => $username,
                        'nama' => $dg2['NamaLengkap'],
                        'kelas' => $dg2['Kelas'],
                        'masuk' => "login"
                         );
        $this->session->set_userdata($datasesi);
        redirect('siswa');
       }else{
         echo $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Username Atau Password Salah</div>');
         redirect('./');
       }

    }

    function logout(){
        $this->session->sess_destroy();
        redirect('./');
    }

}
