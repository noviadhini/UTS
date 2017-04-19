<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hero_Model extends CI_Model {

		public function __construct()
		{
			parent::__construct();
			//Do your magic here
		}	
		/*
		public function getDataPegawai()
		{
			$this->db->select("id,nama,nip,DATE_FORMAT(tanggalLahir,'%d-%m-%Y') as tanggalLahir,alamat,foto");
			$query = $this->db->get('pegawai');
			return $query->result();
		}*/
		public function getDataJenisHero()
		{
			$this->db->select("id,keterangan");
			$query = $this->db->get('jenis_hero');
			return $query->result();
		}

		
		/*public function getAnakByPegawai($idPegawai)
		{
			$this->db->select("pegawai.id as pegawaiId,pegawai.nama as namaPegawai, anak.id as idAnak, anak.nama as namaAnak,DATE_FORMAT(anak.tanggalLahir,'%d-%m-%Y') as tanggalLahir");
			$this->db->where('fk_pegawai', $idPegawai);	
			$this->db->join('pegawai', 'pegawai.id = anak.fk_pegawai', 'left');	
			$query = $this->db->get('anak');
			return $query->result();
		}*/
		public function getHeroByJenisHero($idJenis)
		{
			$this->db->select("jenis_hero.id as JenisId,jenis_hero.keterangan as keteranganJenisHero, hero.id as idHero, hero.nama as namaHero,DATE_FORMAT(hero.tanggal_lahir,'%d-%m-%Y') as tanggal_lahir, hero.foto as fotoHero");
			$this->db->where('fk_jenis', $idJenis);	
			$this->db->join('jenis_hero', 'jenis_hero.id = hero.fk_jenis', 'left');	
			$query = $this->db->get('hero');
			return $query->result();
		}


		/*

		public function insertPegawai()
		{
			$object = array('nama' => $this->input->post('nama'),
							'nip' => $this ->input->post('nip'),
							'tanggallahir' => $this ->input->post('tanggallahir'),
							'alamat' => $this ->input->post('alamat'),
							'foto' => $this->upload->data('file_name') 

			 );//name dri form view
			$this->db->insert('pegawai', $object);
			if($this->db->affected_rows()==1)
			{
				return true;
			}
			else
			{
				return false;
			}


		}*/
		public function insertJenisHero()
		{
			$object = array('id' => $this->input->post('id'),
							'keterangan' => $this ->input->post('keterangan'), 

			 );//name dri form view
			$this->db->insert('jenis_hero', $object);
			if($this->db->affected_rows()==1)
			{
				return true;
			}
			else
			{
				return false;
			}


		}


		public function getJenisHero($id)
		{

			$this->db->where('id', $id);	
			$query = $this->db->get('jenis_hero',1);
			return $query->result();

		}
		
		public function getHero($id)
		{

			$this->db->where('id', $id);	
			$query = $this->db->get('hero');
			return $query->result();

		}

		public function updateById($id)
		{
			$data = array('keterangan' => $this->input->post('keterangan'), 
							
						);

			$this->db->where('id', $id);
			$this->db->update('jenis_hero', $data);
			if($this->db->affected_rows()==1)
			{
				return true;
			}
			
			{
				return false;
			}

		}

		public function delete_peg($id)
		{
			
			$this->db->where('fk_jenis', $id);
			$this->db->delete('hero');
			 $this->db->where('id',$id);
    		 $query = $this->db->get('jenis_hero');
     		$row = $query->row();

    		// unlink("assets/uploads/$row->foto");

     		$this->db->delete('jenis_hero', array('fk_jenis' => $id));

		}
		public function delete_jab($id)
		{
			/*$this->db->where('id', $id);
			$this->db->delete('pegawai');*/
			$this->db->where('id', $id);
    		 $this->db->delete('hero');
     		
		}


		
		public function insertHero($idJenis)
		{
			
			$object = array('nama' => $this->input->post('nama'),
							'tanggal_lahir' => $this ->input->post('tanggal_lahir'),
							'foto' => $this->upload->data('file_name'),
							'fk_jenis'=> $idJenis
				);//name dri form view
			$this->db->insert('hero', $object);
			
		}
		
		public function UpdateHeroById($id)
		{

			$data = array('nama' => $this->input->post('nama'), 
							'tanggal_lahir' =>$this->input->post('tanggal_lahir'),
							'foto' =>$this->upload->data('file_name'),
						);

			$this->db->where('id', $id);
			$this->db->update('hero', $data);
			
		}	


}

/* End of file Pegawai_Model.php */
/* Location: ./application/models/Pegawai_Model.php */
 ?>