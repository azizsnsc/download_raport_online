<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_model
{
	public function check_login()
	{
		if(empty($this->session->userdata('login')))
		{
			$curent_url = base_url($_SERVER['PATH_INFO']);
			$curent_url = urlencode($curent_url);
			redirect(base_url('satpam?redirect_to='.$curent_url));
		}
	}

	public function login()
	{
		$data = $this->input->post();
		$msg = [];
		if(!empty($data))
		{
			$user = $this->db->query('SELECT * FROM user WHERE username = ?',$data['username'])->row_array();
			if(!empty($user))
			{
				if(md5($data['password'])!=$user['password'])
				{
					$this->session->set_flashdata("gagal", "Maaf, Password Yang Anda Masukan Salah");
					//$msg = ['status'=>'gagal','msg'=>'password tidak sesuai'];
				}else{
					$url = @$_GET['redirect_to'];
					if(!empty($url))
					{
						$url = base_url();
					}else{
						$url = base_url('bagianadmin');
					}
					$login = array('id' => $user['id'],
									'nama_user' => $user['nama_user'],
									'username' => $user['username'],
									'akses' => $user['akses'],
									'login' => "masuk"
                        			 );
					$this->session->set_userdata($login);
					redirect($url);
				}
			}else{
				//$msg = ['status'=>'gagal','msg'=>'username tidak diketahui'];
				$this->session->set_flashdata("gagal", "Maaf, Username tidak diketahui");
			}
		}
		return $msg;
	}

}