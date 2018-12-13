<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mahasiswa extends CI_Controller{

	public function __construct(){
		parent::__construct();

		$this->load->model('Mod_mhs');
		$this->load->library('session');

	}
	public function index(){
		if($this->logged_id()){
			$this->load->view('view_mhs');
		}
		else{
			redirect('mahasiswa/login');
		}
	}

	public function logged_id(){
		return $this->session->userdata('username');
	} 

	public function tampil(){
		$keyword = $this->input->get('keyword');	
		$query = $this->Mod_mhs->getMhs($keyword);
		$data = $query->result_array();
		//print_r($data);exit;
	
		if($query->num_rows() > 0){

			echo "
			<table border='1px' class='list_table'>	
			 <p align=center'></p>
			 <thead align='center'>
			 	<tr>
			 		<td>NIM</td>
			 		<td>Nama</td>
			 		<td>Jurusan</td>
			 		<td>Aksi</td>
			 	</tr>
			 </thead>
			 <tbody>";
			// print_r($data);exit;
			foreach ($data as $row):
	 		echo "<tr>
		 		<td>" . $row['nim'] . "</td>
		 		<td>" . $row['nama'] . "</td>
		 		<td>" . $row['jurusan'] .  "</td>
		 		<td><a href=" . site_url('/mahasiswa/edit/' . $row['nim']). ">Edit</a> | 
		 		<a href=" . site_url('mahasiswa/hapus/'. $row['nim']) . ">Hapus</a></td>
	 		</tr>";
	 		endforeach;
	 		"</tbody>
	 		</table>";
 		}

 		else{
 				echo "<tr>
				<td>Data tidak ditemukan</td>
 				</tr>";
 		}
 	
	}

	public function tambah(){
		if($this->logged_id()){

			$this->form_validation->set_rules('nim', 'NIM', 'required');
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('jurusan', 'Jurusan', 'required');

			if($this->form_validation->run() == TRUE){
				$data['nim'] = $this->input->post('nim');
				$data['nama'] = $this->input->post('nama');
				$data['jurusan'] = $this->input->post('jurusan');

				$id = $this->Mod_mhs->tambahMhs($data);
				if($id){
					$this->session->set_flashdata('message','Data berhasil ditambah');
					redirect('/');
				}
				else{
					$this->session->set_flashdata('message','Data gagal ditambah');
					redirect('/');
				}
			} 
		}
		else{
			redirect('mahasiswa/login');
		}

		$this->load->view('view_tambahMhs');
		
	}

	public function edit($id){
		if($this->logged_id()){
			// for view edit
			$query = $this->Mod_mhs->getOneMhs('nim', $id);
			$data['mahasiswa'] = $query->row_array();

			//for update
			$this->form_validation->set_rules('nim', 'NIM', 'required');
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('jurusan', 'Jurusan', 'required');

			if($this->form_validation->run() == TRUE){
				$post['nim'] = $this->input->post('nim');
				$post['nama'] = $this->input->post('nama');
				$post['jurusan'] = $this->input->post('jurusan');
	 
				//echo "<pre>" . print_r($data). "</pre>";exit;
				$id = $this->Mod_mhs->editMhs($id, $post);
				if($id){
					$this->session->set_flashdata('message','Data berhasil ditambah');
					redirect('/');
				}
				else{
					$this->session->set_flashdata('message','Data gagal ditambah');
					redirect('/');
				}
			}
		}
		else{
			redirect('mahasiswa/login');
		}

			$this->load->view('view_editMhs', $data);
	}


	public function hapus($id){
		if($this->logged_id()){
			$id = $this->Mod_mhs->hapusMhs($id);
			if($id){
				redirect('/');
			}
			else{
				echo "Data gagal dihapus";
			}
		}
		else{
			redirect('mahasiswa/login');
		}
	}

	public function login(){

		if($this->input->post()){

			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$query = $this->Mod_mhs->login($username, $password);
			//print_r($query);exit;
			$data = $query->row_array();
			
			//$id = $this->Mod_mhs->login($username, $password);
			if($data){
				$_SESSION['username'] = $data['username'];
				$_SESSION['password'] = $data['password'];

				redirect('mahasiswa');
			}
			else{
				//redirect('mahasiswa/login');
				echo  "<script>
				alert('Maaf login gagal');
				redirect('mahasiswa/login');
				</script>";
			}
	
		}
		$this->load->view('view_login');
	
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('mahasiswa/login');
	}
}

/* End of file Mahasiswa.php */
/* Location: ./application/controllers/Mahasiswa.php */