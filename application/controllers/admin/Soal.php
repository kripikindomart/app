<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Soal extends Admin {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Soal_model', 'soal');
	}

	public function index($page = null)
	{

		$data['page']	= 'soal/index';
		$data['prodi'] = $this->soal->get('master_prodi');
		$this->template->title('Bank Soal');
		$this->render($data['page'], $data);
	}


	public function ajax($id_prodi=null)
	{
		return$this->response($this->soal->getData($id_prodi), false);
		
	}

	public function create()
	{
		$data['title']	= 'Add soal';
		$data['page']	= 'soal/form_soal';
		$data['prodi'] = $this->soal->get('master_prodi');
		
		$this->template->title($data['title']);
		$this->render($data['page'], $data);
	}

	public function add_save()
	{
		if (!$_POST) {
			$input = (object) $this->soal->getDefaultValues();
		} else {
			$input = (object) $this->input->post(null, true);
		}

		if ($this->soal->validate()) {
			
			$save_soal = $this->soal->run($input);
			if ($save_soal) {
				if ($this->input->post('save_type') == 'stay') {
						$response['success'] = true;
						$response['message'] = 'Berhasil menyimpan data, klik link untuk mengedit soal'.
							anchor('admin/soal/edit/' . $save_soal, ' Edit soal'). ' atau klik'.
							anchor('admin/soal', ' kemabali ke list'). ' untuk melihat seluruh data';
				} else {
					set_message('Berhasil menyimoan data '.anchor('admin/soal/edit/' . $save_soal, 'Edit soal'), 'success');
	        		$response['success'] = true;
					$response['redirect'] = site_url('admin/soal');
				} 

			} else {
				$response['success'] = false;
				$response['message'] = 'gagal menyimpan data soal';
			}
		}	else {
			$response['success'] = false;
			$response['message'] = validation_errors();
		}

		return $this->response($response);
	}

	public function edit($id)
	{
		$data['title']		= 'Edit soal';
		$data['page']		= 'soal/form_edit';
		$data['soal']		= $this->soal->where('id', $id)->first();

		$this->template->title($data['title']);
		$this->render($data['page'], $data);
	}

	public function detail($id)
	{
		$data['title']		= 'Edit soal';
		$data['page']		= 'soal/detail';
		$data['soal']		= $this->soal->where('id', $id)->first();

		$this->template->title($data['title']);
		$this->render($data['page'], $data);

	}

	public function edit_save($profile = null)
	{
		if (!$_POST) {
			$input = (object) $this->soal->getDefaultValues();
		} else {
			$input = (object) $this->input->post(null, true);
		}


		$this->load->library('form_validation');
		$validationRules = [
			[
				'field' => 'prodi_id',
				'label' => 'Program Studi',
				'rules' => 'trim|required',
			],
			[
				'field' => 'jawaban',
				'label' => 'Kunci Jawaban',
				'rules' => 'trim|required',
			],
			[
				'field' => 'bobot',
				'label' => 'Bobot Nilai',
				'rules' => 'trim|required',
			],
		];	
		$this->form_validation->set_rules($validationRules);
		if ($this->form_validation->run()) {
			$this->file_config();
			$data = [
				'id'				=> $input->id_soal,
				'id_master_prodi'				=> $input->prodi_id,
				'pertanyaan'      	=> htmlspecialchars($input->soal),
	            'jawaban'   		=> $input->jawaban,
	            'bobot'     		=> $input->bobot,
	            'opsi_a' 			=> $input->jawaban_a,
				 'opsi_b' 			=> $input->jawaban_b,
				 'opsi_c' 			=> $input->jawaban_c,
				 'opsi_d' 			=> $input->jawaban_d,
				 'opsi_e' 			=> $input->jawaban_e
			];
			$abjad = ['a', 'b', 'c', 'd', 'e'];
			$old = array();

	        $i = 0; 
	        $getsoal = $this->soal->find($input->id_soal);   
			foreach ($_FILES as $key => $val) {
		        $img_src = FCPATH.'uploads/bank_soal/';
		        
		        $error = '';
		       	
		       	if ($key === 'file_soal') {
		       		if(!empty($_FILES['file_soal']['name'])){
		       			if (!$this->upload->do_upload('file_soal')){
	                        $error = $this->upload->display_errors();
	                        show_error($error, 500, 'File Soal Error');
	                        exit();
	                    } else {
	                    	if (!empty($getsoal->file) || $getsoal->file != null) {
	                    		$old['file'] = $getsoal->file;
	                    	}
	                    	$data['file'] = $this->upload->data('file_name');
	                        $data['tipe_file'] = $this->upload->data('file_type');
	                    }
		       		}
		       	} else {
		       		$file_abj = 'file_'.$abjad[$i];
	                if(!empty($_FILES[$file_abj]['name'])){    
	                    if (!$this->upload->do_upload($key)){
	                        $error = $this->upload->display_errors();
	                        show_error($error, 500, 'File Opsi '.strtoupper($abjad[$i]).' Error');
	                        exit();
	                    }else{
	                        if (!empty($getsoal->$file_abj) || $getsoal->$file_abj != null) {
	                    		$old[$file_abj] = $getsoal->$file_abj;
	                    	}
	                        $data[$file_abj] = $this->upload->data('file_name');
	                    }
	                }
	                $i++;
		       	}
		    }
		    $data['update_at'] = time();
		    $update_soal = $this->soal->run($data,'update');
		    if ($update_soal) {
		    	foreach ($old as $row) {
		    		$path = FCPATH .'uploads/bank_soal/';
		    		if (file_exists($path.$row)) {
		    			unlink($path.$row);
		    		}
		    	}
		    	if ($this->input->post('save_type') == 'stay') {
						$response['success'] = true;
						$response['message'] = 'Berhasil menyimpan data, klik link untuk mengedit soal'.
							anchor('admin/soal/edit/' . $update_soal, ' Edit soal'). ' atau klik'.
							anchor('admin/soal', ' kemabali ke list'). ' untuk melihat seluruh data';
				} else {
					set_message('Berhasil menyimoan data '.anchor('admin/soal/edit/' . $update_soal, 'Edit soal'), 'success');
	        		$response['success'] = true;
					$response['redirect'] = site_url('admin/soal');
				} 
		    	
		    } else {
		    	$response['success'] = false;
					$response['message'] = 'gagal menyimpan data soal';
		    }
		} else {
			$response['success'] = false;
			$response['message'] = validation_errors();
		}   
	
		return $this->response($response);
		
			
			
	}


	public function delete_image()
	{
		$soal = $this->soal->find($this->input->post('id_soal'));

		$data_update = [
			$this->input->post('data_id') => null
		];
		$data_id = $this->input->post('data_id');
		$soal_find = $this->soal->find($this->input->post('id_soal'))->$data_id;
		
		if ($soal) {
			$delete_db = $this->soal->where('id', $this->input->post('id_soal'))->update($data_update);
			if ($delete_db) {
				$path = FCPATH .'uploads/bank_soal/';
	    		if (file_exists($path.$soal_find)) {
	    			unlink($path.$soal_find);
	    		}
	    		$response['success'] = true;
				$response['message'] = base_url('admin/soal/edit/');
				set_message('Berhasil menghapus data gambar');

			} else {
				$response['success'] = false;
				$response['message'] = 'gagal menghapus data gambar';	
			}
		}

		return $this->response( $response);

	}

	/**
	* delete soal
	*
	* @var $id String
	*/
	public function delete()
	{

		$id = $this->input->post(null, true);
		
		$remove = false;
		if (is_array($id['delete_id'])) {
			foreach ($id['delete_id'] as $i) {
				$remove = $this->_remove($i);
				//$response['success'] = $id['delete_id'];
				if ($remove) {
					$response['success'] = true;
					$response['message'] = "Data soal berhasil di hapus";
					set_message('Data soal berhasil di hapus', 'success');
				} else {
					$response['success'] = false;
					$response['message'] = 'Maaf gagal menghapus data';
				}
			}
		} else {
			if (! $this->soal->where('id', $id['delete_id'])->first()) {
				$response['success'] = false;
				$response['message'] = 'Maaf data tidak ditemukan';
			} else {
				$remove = $this->_remove($id['delete_id']);
				if ($remove) {
					$response['success'] = true;
					$response['message'] = "Data soal berhasil di hapus";
					set_message('Data soal berhasil di hapus', 'success');
				} else {
					$response['success'] = false;
					$response['message'] = 'Maaf gagal menghapus data';
				}
			}				
		}
		
		return $this->response($response);
	}

	

     public function delete_soal()
    {
        $chk = $this->input->post('checked', true);
        
        // Delete File
        foreach($chk as $id){
            $abjad = ['a', 'b', 'c', 'd', 'e'];
            $path = FCPATH.'uploads/bank_soal/';
            $soal = $this->soal->getSoalById($id);
            // Hapus File Soal
            if(!empty($soal->file)){
                if(file_exists($path.$soal->file)){
                    unlink($path.$soal->file);
                }
            }
            //Hapus File Opsi
            $i = 0; //index
            foreach ($abjad as $abj) {
                $file_opsi = 'file_'.$abj;
                if(!empty($soal->$file_opsi)){
                    if(file_exists($path.$soal->$file_opsi)){
                        unlink($path.$soal->$file_opsi);
                    }
                }
            }
        }

        if(!$chk){
            $this->output_json(['status'=>false]);
        }else{
            if($this->master->delete('tb_soal', $chk, 'id_soal')){
                $this->output_json(['status'=>true, 'total'=>count($chk)]);
            }
        }
    }

	

	/**
	* delete soal
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$image = $this->soal->find($id);
		$this->load->helper('file');
		
		$abjad = ['a', 'b', 'c', 'd', 'e'];
        $path = FCPATH.'uploads/bank_soal/';
		
		$delete_file = '';

		// Hapus File Soal
        if(!empty($image->file)){
            if(file_exists($path.$image->file)){
                unlink($path.$image->file);
            }
        }

        $i = 0; //index
        foreach ($abjad as $abj) {
            $file_opsi = 'file_'.$abj;
            if(!empty($image->$file_opsi)){
                if(file_exists($path.$image->$file_opsi)){
                    unlink($path.$image->$file_opsi);
                }
            }
        }

		$delete = $this->soal->where('id', $id)->delete();
		if ($delete) {
			return true;
		}

		
	}

	public function file_config()
    {
        $allowed_type 	= [
            "image/jpeg", "image/jpg", "image/png", "image/gif",
            "audio/mpeg", "audio/mpg", "audio/mpeg3", "audio/mp3", "audio/x-wav", "audio/wave", "audio/wav",
            "video/mp4", "application/octet-stream"
        ];
        $config['upload_path']      = FCPATH.'uploads/bank_soal/';
        $config['allowed_types']    = 'jpeg|jpg|png|gif|mpeg|mpg|mpeg3|mp3|wav|wave|mp4';
        $config['encrypt_name']     = TRUE;
        
        return $this->load->library('upload', $config);
    }


    public function save()
    {
    	if (!$_POST) {
			$input = (object) $this->soal->getDefaultValues();
		} else {
			$input = (object) $this->input->post(null, true);
		}
		if ($this->soal->validate()) {
			
			$save_soal = $this->soal->run($input);
			if ($save_soal) {
				if ($this->input->post('save_type') == 'stay') {
						$response['success'] = true;
						$response['message'] = 'Berhasil menyimpan data, klik link untuk mengedit prodi'.
							anchor('admin/soal/edit/' . $save_prodi, ' Edit prodi'). ' atau klik'.
							anchor('admin/soal', ' kemabali ke list'). ' untuk melihat seluruh data';
				} else {
					$response['message'] = 'Berhasil menyimpan data Prodi';
	        		$response['success'] = true;
					$response['redirect'] = site_url('admin/soal');
				} 

			} else {
				$response['success'] = false;
				$response['message'] = 'gagal menyimpan data soal';
			}
		}	else {
			$response['success'] = false;
			$response['message'] = validation_errors();
		}

		return $this->response($response);
    }
  //   public function save()
  //   {
  //       $method = $this->input->post('method', true);
  //       $this->load->library('form_validation');
  //       $this->file_config();
		// $validationRules = [
		// 	[
		// 		'field' => 'title_soal',
		// 		'label' => 'Title Soal',
		// 		'rules' => 'trim|required',
		// 	],
		// 	[
		// 		'field' => 'jawaban',
		// 		'label' => 'Kunci Jawaban',
		// 		'rules' => 'trim|required',
		// 	],
		// 	[
		// 		'field' => 'bobot',
		// 		'label' => 'Bobot Nilai',
		// 		'rules' => 'trim|required',
		// 	],

		// ];
		// $this->form_validation->set_rules($validationRules);

  //       if($this->form_validation->run() === FALSE){
  //           $method==='add'? $this->create() : $this->edit();
  //       }else{
  //           $data = [
  //               'pertanyaan'      	=> $this->input->post('soal', true),
  //               'jawaban'   		=> $this->input->post('jawaban', true),
  //               'bobot'     		=> $this->input->post('bobot', true),
  //           ];
            
  //           $abjad = ['a', 'b', 'c', 'd', 'e'];
            
  //           // Inputan Opsi
  //           foreach ($abjad as $abj) {
  //               $data['opsi_'.$abj]    = $this->input->post('jawaban_'.$abj, true);
  //           }

  //           $i = 0;
  //           foreach ($_FILES as $key => $val) {
  //               $img_src = FCPATH.'uploads/bank_soal/';
  //               //$getsoal = $this->soal->getSoalById($this->input->post('id_soal', true));
  //               $getsoal = $this->soal->find($this->input->post('id', true));
                
  //               $error = '';
  //               if($key === 'file_soal'){
  //                   if(!empty($_FILES['file_soal']['name'])){
  //                       if (!$this->upload->do_upload('file_soal')){
  //                           $error = $this->upload->display_errors();
  //                           show_error($error, 500, 'File Soal Error');
  //                           exit();
  //                       }else{
  //                           if($method === 'edit'){
  //                           	$path = FCPATH .'uploads/bank_soal/'.$getsoal->file;
  //                               if(!unlink($img_src.$getsoal->file)){
  //                                   show_error('Error saat delete gambar <br/>'.print_r($getsoal), 500, 'Error Edit Gambar');
  //                                   exit();
  //                               }
  //                           }
  //                           $data['file'] = $this->upload->data('file_name');
  //                           $data['tipe_file'] = $this->upload->data('file_type');
  //                       }
  //                   }
  //               }else{
  //                   $file_abj = 'file_'.$abjad[$i];
  //                   if(!empty($_FILES[$file_abj]['name'])){    
  //                       if (!$this->upload->do_upload($key)){
  //                           $error = $this->upload->display_errors();
  //                           show_error($error, 500, 'File Opsi '.strtoupper($abjad[$i]).' Error');
  //                           exit();
  //                       }else{
  //                           if($method === 'edit'){

  //                               if(!unlink($img_src.$getsoal->$file_abj)){
  //                                   show_error('Error saat delete gambar', 500, 'Error Edit Gambar');
  //                                   exit();
  //                               }
  //                           }
  //                           $data[$file_abj] = $this->upload->data('file_name');
  //                       }
  //                   }
  //                   $i++;
  //               }
  //           }
                
  //               // $pecah = $this->input->post('prodi_id', true);
  //               // $pecah = explode(':', $pecah);
  //               // $data['dosen_id'] = $pecah[0];
  //               // $data['matkul_id'] = end($pecah);
  //               $data['title_soal'] = $this->input->post('title_soal');
          

  //           if($method==='add'){
  //               //push array
  //               $data['created_at'] = time();
  //               $data['update_at'] = time();
  //               $data['created_by'] = $this->session->userdata('id');
  //               //insert data
  //               $this->soal->save_soal($data);
  //           }else if($method==='edit'){
  //               //push array
  //               $data['update_at'] = time();
  //               //update data
  //               $data['id'] = $this->input->post('id', true);
  //               $this->soal->run($data, 'update');
  //           }else{
  //               show_error('Method tidak diketahui', 404);
  //           }
  //           redirect('admin/soal');
  //       }
  //   }



	public function deleteImage($image)
	{
		if (!empty($image)) {
			$this->load->helper('file');
			$delete_file = '';
			$path = FCPATH . 'uploads/soal/'.$image;
			if (file_exists($path)) {
				if ($image != 'default.png') {
					$delete_file = unlink($path);
				}
			}
				
			if ($delete_file) {
				return true;
			}	
		}
	}



	/**
	* Upload Image soal
	* 
	* @return JSON
	*/
	public function upload_avatar_file()
	{
		// if (!$this->is_allowed('soal_add', false)) {
		// 	return $this->response([
		// 		'success' => false,
		// 		'message' => cclang('sorry_you_do_not_have_permission_to_access')
		// 		]);
		// }

		$uuid = $this->input->post('qquuid');

		mkdir(FCPATH . '/uploads/tmp/' . $uuid);

		$config = [
			'upload_path' 		=> './uploads/tmp/' . $uuid . '/',
			'allowed_types' 	=> 'png|jpeg|jpg|gif',
			'max_size'  		=> '1000'
		];
		
		$this->load->library('upload', $config);
		$this->load->helper('file');

		if ( ! $this->upload->do_upload('qqfile')){
			$result = [
				'success' 	=> false,
				'error' 	=>  $this->upload->display_errors()
			];

    		return $this->response($result);
		}
		else{
			$upload_data = $this->upload->data();

			$result = [
				'uploadName' 	=> $upload_data['file_name'],
				'success' 		=> true,
			];

    		return $this->response($result);
		}
	}

	/**
	* Delete Image soal
	* 
	* @return JSON
	*/
	public function delete_avatar_file($uuid)
	{
		// if (!$this->is_allowed('soal_delete', false)) {
		// 	return $this->response([
		// 		'success' => false,
		// 		'message' => cclang('sorry_you_do_not_have_permission_to_access')
		// 		]);
		// }

		if (!empty($uuid)) {
			$this->load->helper('file');

			$delete_by = $this->input->get('by');
			$delete_file = false;

			if ($delete_by == 'id') {
				$soal = $this->soal->where('id', $uuid)->first();
				$path = FCPATH . 'uploads/soal/'.$soal->foto;
				if ($soal->foto != 'default.png') {
					if (isset($uuid)) {
						if (is_file($path)) {
							$delete_file = unlink($path);
							$this->soal->where('id', $uuid)->update(['foto' => '']);
						}
					}	
				}
				

				
			} else {
				$path = FCPATH . '/uploads/tmp/' . $uuid . '/';
				$delete_file = delete_files($path, true);
			}

			if (isset($uuid)) {
				if (is_dir($path)) {
					rmdir($path);
				}
			}

			if (!$delete_file) {
				$result = [
					'error' =>  'Error delete file'
				];

	    		return $this->response($result);
			} else {
				$result = [
					'success' => true,
				];

	    		return $this->response($result);
			}
		}
	}

	/**
	* Get Image soal
	* 
	* @return JSON
	*/
	public function get_avatar_file($id)
	{

		$this->load->helper('file');
		$soal = $this->soal->where('id', $id)->first();
		if (!$soal) {
			$result = [
				'error' =>  'Error getting file'
			];

    		return $this->response($result);
		} else {
			if (!empty($soal->foto)) {
				$result[] = [
					'success' 				=> true,
					'thumbnailUrl' 			=> base_url('uploads/soal/'.$soal->foto),
					'id' 					=> 0,
					'name' 					=> $soal->foto,
					'uuid' 					=> $soal->id,
					'deleteFileEndpoint' 	=> base_url('admin/soal/delete_foto_file'),
					'deleteFileParams'		=> ['by' => 'id']
				];

	    		return $this->response($result);
			}
		} 
	}


	public function profile()
	{
		$id = $this->session->soaldata('id');
		if (!$_POST) {
			$input = (object) $this->soal->getDefaultValues();
		} else {
			$input = (object) $this->input->post(null, true);
		}
		$data['input'] = ['password' => hashEncrypt($this->input->post('password'))];	

		$validationRules = [
			[
				'field'	=> 'password',
				'label'	=> 'Password',
				'rules'	=> 'required|min_length[5]',
				'errors'	=> array('required' => ' %s harus di isi', 'min_length' => '%s harus minimal 5 karakter')
			],

			[
				'field'	=> 'password_confirmation',
				'label'	=> 'Konfirmasi Password',
				'rules'	=> 'required|matches[password]',
				'errors'	=> array('required' => '%s harus di isi', 'matches' => 'Konfirmasi password tidak benar / tidak match')
			],
		];
		$this->load->library('form_validation');
		$validate = $this->form_validation->set_rules($validationRules);

		if (!$validate->run()) {
			$data['title']	= 'Profile';
			$data['page']	= 'soal/profile';
			$data['form_action'] = base_url('admin/soal/profile/').$this->session->soaldata('id');
			$data['profile'] = $this->soal->select(
					[
						'soal.id', 'soal.soalname', 'soal.email', 'soal.fullname', 'soal.is_active', 'soal.foto', 'soal.token', 'soal.created_at', 'soal.update_at', 'soal.last_login','role.role'
					])
				->join('role','left')
				->where('soal.id', $id)
				->first();
			$this->set($data);
			$this->view($data);
			return;
		}		

  		if ($this->soal->where('id', $id)->update($data['input'])) {
			$this->session->set_flashdata('success', 'data berhasil di perbaharui');
		} else {
			$this->session->set_flashdata('error', 'gagal mengupdate data');
		}

		redirect(base_url('admin/soal/profile'));
		
	}

	public function edit_profile()
	{
		$id = $this->session->soaldata('id');
		$data['title']	= 'Profile';
		$data['page']	= 'soal/edit_profile';
		$data['input'] = $this->soal->select(
				[
					'soal.id', 'soal.soalname', 'soal.email', 'soal.fullname', 'soal.is_active', 'soal.foto', 'soal.token', 'soal.created_at', 'soal.update_at', 'soal.last_login','role.role','soal.id_role'
				])
			->join('role','left')
			->where('soal.id', $id)
			->first();

  		
		$this->set($data);
		$this->view($data);
	}


	public function import($import_data = null)
	{
		$data['title']	= 'Import Data soal';
		$data['page']	= 'soal/import';
		$data['content']	= $this->soal->get('master_prodi');
		if ($import_data != null) $data['import'] = $import_data;


		$this->template->title($data['title']);
		$this->render($data['page'], $data);
	}

	public function preview()
	{
		$config['upload_path']		= './uploads/import/';
		$config['allowed_types']	= 'xls|xlsx|csv';
		$config['max_size']			= 2048;
		$config['encrypt_name']		= true;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('upload_file')) {
			$error = $this->upload->display_errors();
			echo $error;
			die;
		} else {
			$file = $this->upload->data('full_path');
			$ext = $this->upload->data('file_ext');

			switch ($ext) {
				case '.xlsx':
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
					break;
				case '.xls':
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
					break;
				case '.csv':
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
					break;
				default:
					echo "unknown file ext";
					die;
			}

			$spreadsheet = $reader->load($file);
			$sheetData = $spreadsheet->getActiveSheet()->toArray();
			$data = [];
			for ($i = 1; $i < count($sheetData); $i++) {
				$data[] = [
					'id_prodi' => $sheetData[$i][1],
					'pertanyaan' => $sheetData[$i][2],
					'opsi_a' => $sheetData[$i][3],
					'opsi_b' => $sheetData[$i][4],
					'opsi_c' => $sheetData[$i][5],
					'opsi_d' => $sheetData[$i][6],
					'opsi_e' => $sheetData[$i][7],
					'jawaban' => $sheetData[$i][8],
					'bobot' => $sheetData[$i][9],
				];
			}

			unlink($file);

			$this->import($data);
		}
	}

	public function do_import()
	{
		$input = json_decode($this->input->post('data', true));
		$data = [];
		foreach ($input as $d) {
			$data[] = [
				'id_master_prodi' 		=> $d->id_prodi,
				'pertanyaan'	=> $d->pertanyaan,
				'opsi_a' 		=> $d->opsi_a,
				'opsi_b' 		=> $d->opsi_b,
				'opsi_c' 		=> $d->opsi_c,
				'opsi_d' 		=> $d->opsi_d,
				'opsi_e' 		=> $d->opsi_e,
				'jawaban' 		=> $d->jawaban,
				'bobot' 		=> $d->bobot,
				'created_at' => time(),
                'update_at' => time(),
                'created_by' => $this->session->userdata('id')
			];
		}

		$save = $this->soal->insert_batch($data);
		if ($save) {
			redirect('admin/soal');
		} else {
			redirect('admin/soal/import');
		}
	}





	public function group()
	{
		$data['title']	= 'Group Soal';
		$data['page']	= 'soal/group';
		$data['prodi'] = $this->soal->get('master_prodi');
		$this->set($data);
		$this->view($data);
	}



	



}

/* End of file soal.php */
/* Location: ./application/controllers/soal.php */

