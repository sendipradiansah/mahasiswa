<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_mhs extends CI_Model{

	public function getMhs($keyword){
		//$filter = $this->input->get('keyword');
		if($keyword != ''){
			$this->db->like('nim', $keyword);
			$this->db->or_like('nama', $keyword);
			$this->db->or_like('jurusan', $keyword);
		}
		return $this->db->get('mahasiswa');
	}

	public function tambahMhs($data){
		$this->db->insert('mahasiswa', $data);
		return $this->db->insert_id();
	}

	public function getOneMhs($field, $value){
		$this->db->where($field, $value);
		return $this->db->get('mahasiswa');
	}

	public function editMhs($id, $data){
		$this->db->where('nim', $id);
		$this->db->update('mahasiswa', $data);
		return $this->db->affected_rows();
	}

	public function hapusMhs($id){
		$this->db->where('nim', $id);
		$this->db->delete('mahasiswa');
		return $this->db->affected_rows();
	}

	public function login($username, $password){
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));
		return $this->db->get('login');

	}

	


}