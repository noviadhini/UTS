
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hero extends CI_Controller
 {

	public function index($idJenis)
	{
		
		$this->load->model('hero_model');
		$data["hero_list"] = $this->hero_model->getHeroByJenisHero($idJenis);
		$this->load->view('hero',$data);	
	
	}
	public function create($idJenis)
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama'/**/, 'Nama'/*nama harus diisi*/, /*merupakan syarat*/'trim|required');
		
		$this->load->model('hero_model');	
		if($this->form_validation->run()==FALSE)
		{

			$this->load->view('tambah_hero_view');

		}
		else{
			    $config['upload_path']          = './assets/uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 1000000000;
                $config['max_width']            = 10240;
                $config['max_height']           = 7680;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());
						$this->load->view('tambah_hero_view',$error);
                }
                else{

                	$this->hero_model->insertHero($idJenis);
						redirect('jenis/index');
                }
               
						
               
		}
		
	}
	
	public function update($id)
	{
		//load library
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		//sebelum update data harus ambil data lama yang akan di update
		$this->load->model('hero_model');
		$data['hero']=$this->hero_model->getHero($id);
		$data2=$this->hero_model->getHero($id);
		//$namaFile=$data['pegawai']->foto;
		
		$nama = $data2[0]->foto;
		//skeleton code
		if($this->form_validation->run()==FALSE)
		{

		//setelah load data dikirim ke view
			$this->load->view('edit_hero_view',$data);

		}else
		{
			$config['upload_path'] = './assets/uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']  = '1000';
			$config['max_width']  = '10240';
			$config['max_height']  = '7680';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload()){
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('tambah_hero_view',$error);
			}
		

			else
		{
			$image_data = $this->upload->data();
			$this->hero_model->UpdateHeroById($id);
			unlink('assets/uploads/'.$nama);
			//$this->load->view('edit_hero_sukses');
			echo '<script type="text/javascript">alert("Data Berhasil di Update!!")</script>';
				redirect('jenis', 'refresh');
		

		}
	}
	}

	public function delete($id)
	{
			$id = $this->uri->segment(3);
			$this->load->model('hero_model');
			$this->hero_model->delete_jab($id);
			redirect('jenis/index');
			
			echo '<script type="text/javascript">alert("Hapus Berhasil!!")</script>';
			redirect('jenis', 'refresh');
			//}
			//else
			//{
			//	echo '<script type="text/javascript">alert("Hapus Gagal!!")</script>';
			//	redirect('jenis', 'refresh');
			//}
			//redirect('pegawai');
	}

}

/* End of file Hero.php */
/* Location: ./application/controllers/Hero.php */