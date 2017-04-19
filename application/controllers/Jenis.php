<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller {

	public function index()
	{
		$this->load->model('hero_model');
		$data["jenis_list"] = $this->hero_model->getDataJenisHero();
		$this->load->view('jenis',$data);	
	}
	
	public function create()
	{
		// idPegawai = 1
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
		$this->load->model('hero_model');	
		if($this->form_validation->run()==FALSE){
			$this->load->view('tambah_jenis_view');
		}else
		{
			$this->hero_model->insertJenisHero();
			//$this->load->view('tambah_jenis_sukses');
			echo '<script type="text/javascript">alert("Data Berhasil di ditambahkan!!")</script>';
				redirect('jenis', 'refresh');
		}
		
	}
	//method update butuh parameter id berapa yang akan di update
	
	public function update($id)
	{
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
		$this->load->model('hero_model');
		$data['jenis']=$this->hero_model->getJenisHero($id);

		if($this->form_validation->run()==FALSE)
		{
			$this->load->view('edit_jenis_view',$data);
		}
		else
		{

			$this->hero_model->updateById($id);
			//$this->load->view('tambah_jenis_sukses');
			echo '<script type="text/javascript">alert("Data Berhasil di Update!!")</script>';
				redirect('jenis', 'refresh');
		}

	}
	public function delete_peg($id)
	{
			$this->load->model('hero_model');
			$data["jenis_list"] = $this->hero_model->delete_peg($id);
			//$this->load->view('hapus_sukses',$data);
			echo '<script type="text/javascript">alert("Hapus Berhasil!!")</script>';
			redirect('jenis', 'refresh');

	}
	
}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */

 ?>