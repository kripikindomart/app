<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends Frontend {
	public $mhs, $user;
	public function __construct()
	{
		parent::__construct();
		$this->landing_login();

		$this->load->model('Ujian_model', 'ujian');
		$this->mhs 	= $this->ujian->where('no_registrasi', $this->aauth->get_user()->username)->first('master_mahasiswa');
		$this->load->library('encryption');
	}

	public function index()
	{

		$data['mahasiswa'] = $this->ujian->select('master_mahasiswa.id, master_mahasiswa.no_registrasi, master_mahasiswa.nama_lengkap, master_mahasiswa.jenis_kelamin, master_mahasiswa.no_ktp, master_mahasiswa.gelar_kesarjanaan, master_mahasiswa.tempat_lahir, master_mahasiswa.tanggal_lahir, master_mahasiswa.status_kawin, master_mahasiswa.alamat_rumah, master_mahasiswa.email, master_mahasiswa.no_hp, master_mahasiswa.nama_ayah, master_mahasiswa.nama_ibu, master_mahasiswa.id_master_prodi, master_prodi.program_studi, master_mahasiswa.konsentrasi, master_mahasiswa.foto, master_mahasiswa.status, master_mahasiswa.created_at, master_mahasiswa.update_at, master_mahasiswa.created_by')
		->join('master_prodi', 'left')
		->where('no_registrasi', $this->aauth->get_user()->username)->first();
	
			$id_prodi = $this->ujian->where('id', $this->aauth->get_user()->id_master_prodi)->first('master_prodi');
			$data['page']	= 'ujian/index';



			$id_group = $this->ujian->enrollCourse($id_prodi->prodiID);	
			   
			 

			$data['encrypted_id'] = urlencode($this->encryption->encrypt($id_group->id));


			
			$data['mhs'] 		= $this->ujian->where('no_registrasi', $this->aauth->get_user()->username)->first('master_mahasiswa');

			$data['ujian']		= $this->ujian->enrollCourse($id_prodi->prodiID);


			
			$success_ujian = $this->ujian->where('id_master_mahasiswa', $data['mahasiswa']->id)->where('id_group_soal', $data['ujian']->id)->first('h_ujian');
			if ($success_ujian != null) {
				if ($success_ujian->status == 'Y') {
					
					$this->session->set_flashdata('success', 'Anda Telah logout karena telah menyelesaikan soal');
					$this->session->set_flashdata('f_type', 'success');
					
			}

			} else {
				$data['success_ujian'] = null;
			}
		$success_ujian = $this->ujian->where('id_master_mahasiswa', $data['mahasiswa']->id)->where('id_group_soal', $data['ujian']->id)->first('h_ujian');
		if ($success_ujian != null) {
			$data['success'] = $success_ujian->status;
			
		} else {
			$data['success'] = 'N';
		}
		$data['informasi'] = $this->ujian->getmahasiswa($this->aauth->get_user()->username);

		$hasilujian = $this->db->select('master_mahasiswa.*, h_ujian.*')->where('h_ujian.status = ', 'Y')->join('master_mahasiswa', 'master_mahasiswa.id = h_ujian.id_master_mahasiswa', 'left')->get('h_ujian')->row();

		
		$this->template->title('Dashboard');

		$this->render('kelas', $data);
	}

	public function cektoken()
	{
		$id = $this->input->post('id_ujian', true);
		$token = $this->input->post('token', true);
		$cek = $this->ujian->where('id', $id)->first('group_soal');
		
		$data['status'] = $token === $cek->id ? TRUE : FALSE;
		$this->response($data);
	}

	public function ujian()
	{

		
		$data['title']	= 'Dashboard';
		$data['page']	= 'kelas';
		
		$this->load->library('encryption');
		$key = $this->input->get('key', true);



		$id  		= $this->encryption->decrypt(rawurldecode($key));

		$ujian 		= $this->ujian->getGroupUjian($id);
		$soal 		= $this->ujian->getSoal($id);
		
		$mhs		= $this->mhs;
		$h_ujian 	= $this->ujian->HslUjian($id, $mhs->id);
		


		$cek_sudah_ikut = $h_ujian->num_rows();
		

		

		if ($cek_sudah_ikut < 1 || $cek_sudah_ikut != 1) {
			$soal_urut_ok 	= array();
			$i = 0;
			foreach ($soal as $s) {
				$soal_per = new stdClass();
				$soal_per->id 		= $s->id;
				$soal_per->pertanyaan 		= $s->pertanyaan;
				$soal_per->file 		= $s->file;
				$soal_per->tipe_file 	= $s->tipe_file;
				$soal_per->opsi_a 		= $s->opsi_a;
				$soal_per->opsi_b 		= $s->opsi_b;
				$soal_per->opsi_c 		= $s->opsi_c;
				$soal_per->opsi_d 		= $s->opsi_d;
				$soal_per->opsi_e 		= $s->opsi_e;
				$soal_per->jawaban 		= $s->jawaban;
				$soal_urut_ok[$i] 		= $soal_per;
				$i++;
			}
			$soal_urut_ok 	= $soal_urut_ok;
			$list_id_soal	= "";
			$list_jw_soal 	= "";
			if (!empty($soal)) {
				foreach ($soal as $d) {
					$list_id_soal .= $d->id.",";
					$list_jw_soal .= $d->id."::N,";
				}
			}
			$list_id_soal 	= substr($list_id_soal, 0, -1);
			$list_jw_soal 	= substr($list_jw_soal, 0, -1);
			$waktu_selesai 	= date('Y-m-d H:i:s', strtotime("+{$ujian->waktu_pengerjaan} minute"));
			$time_mulai		= date('Y-m-d H:i:s');

			$input = [
				'id_group_soal' 		=> $id,
				'id_master_mahasiswa'	=> $mhs->id,
				'list_soal'			=> $list_id_soal,
				'list_jawaban' 		=> $list_jw_soal,
				'jml_benar'			=> 0,
				'nilai'				=> 0,
				'nilai_bobot'		=> 0,
				'tgl_mulai'			=> $time_mulai,
				'tgl_selesai'		=> $waktu_selesai,
				'status'			=> 'N'
			];
			$this->ujian->create( $input, 'h_ujian');

			// Setelah insert wajib refresh dulu
			redirect('kelas/ujian/?key='.urlencode($key), 'location', 301);
		} 
		
		$q_soal = $h_ujian->row();
		
		$urut_soal 		= explode(",", $q_soal->list_jawaban);
		$soal_urut_ok	= array();
		for ($i = 0; $i < sizeof($urut_soal); $i++) {
			$pc_urut_soal	= explode(":",$urut_soal[$i]);
			$pc_urut_soal1 	= empty($pc_urut_soal[1]) ? "''" : "'{$pc_urut_soal[1]}'";
			$ambil_soal 	= $this->ujian->ambilSoal($pc_urut_soal1, $pc_urut_soal[0]);
			$soal_urut_ok[] = $ambil_soal; 
		}


	

		$detail_tes = $q_soal;
		$soal_urut_ok = $soal_urut_ok;

		$pc_list_jawaban = explode(",", $detail_tes->list_jawaban);
		$arr_jawab = array();
		foreach ($pc_list_jawaban as $v) {
			$pc_v 	= explode(":", $v);
			$idx 	= $pc_v[0];
			$val 	= $pc_v[1];
			$rg 	= $pc_v[2];

			$arr_jawab[$idx] = array("j"=>$val,"r"=>$rg);
		}

		$arr_opsi = array("a","b","c","d","e");
		$html = '';
		$no = 1;
		if (!empty($soal_urut_ok)) {
			foreach ($soal_urut_ok as $s) {
				// if (strstr($s->pertanyaan, '\n') == true   ) {
				// 	$pertanyaan = implode('\n', $s->pertanyaan);

				// 	$istruksi = '<p>'.$pertanyaan[0].'</p>';
				// 	$pertanyaan = '<p>'.$pertanyaan[1].'</p>';
				// 	$soal = $instruksi + $pertanyaan;
				// } else if(strstr($s->pertanyaan, '</br>') == true){
				// 	$pertanyaan = implode('</br>', $s->pertanyaan);
				// 	$istruksi = '<p>'.$pertanyaan[0].'</p>';
				// 	$pertanyaan = '<p>'.$pertanyaan[1].'</p>';
				// 	$soal = $instruksi + $pertanyaan;
				// } else {
				// 	$soal = $s->pertanyaan;
				// }
				

				$path = 'uploads/bank_soal/';
				$vrg = $arr_jawab[$s->id]["r"] == "" ? "N" : $arr_jawab[$s->id]["r"];
				$html .= '<input type="hidden" name="id_soal_'.$no.'" value="'.$s->id.'">';
				$html .= '<input type="hidden" name="rg_'.$no.'" id="rg_'.$no.'" value="'.$vrg.'">';
				$html .= '<div class="step" id="widget_'.$no.'">';

				$html .= '<div class="text-center"><div class="w-25">'.tampil_media($path.$s->file).'</div></div><p style="font-size:20px">'.str_replace('/\n', '<br>', $s->pertanyaan).'</p><div class="funkyradio">';
				for ($j = 0; $j < $this->config->item('jml_opsi'); $j++) {
					$opsi 			= "opsi_".$arr_opsi[$j];
					$file 			= "file_".$arr_opsi[$j];
					$checked 		= $arr_jawab[$s->id]["j"] == strtoupper($arr_opsi[$j]) ? "checked" : "";
					$pilihan_opsi 	= !empty($s->$opsi) ? $s->$opsi : "";
					$tampil_media_opsi = (is_file(base_url().$path.$s->$file) || $s->$file != "") ? tampil_media($path.$s->$file) : "";
					$html .= '<div class="funkyradio-success" onclick="return simpan_sementara();">
						<input type="radio" id="opsi_'.strtolower($arr_opsi[$j]).'_'.$s->id.'" name="opsi_'.$no.'" value="'.strtoupper($arr_opsi[$j]).'" '.$checked.'> <label for="opsi_'.strtolower($arr_opsi[$j]).'_'.$s->id.'"><div class="huruf_opsi">'.$arr_opsi[$j].'</div> <strong><p style="font-size : 20px">'.$pilihan_opsi.'</p><strong><div class="w-25">'.$tampil_media_opsi.'</div></label></div>';
				}
				$html .= '</div></div>';
				$no++;
			}
		}

		// Enkripsi Id Tes
		$id_tes = $this->encryption->encrypt($detail_tes->id);


		$data = [
			'mhs'		=> $this->mhs,
			'judul'		=> 'Ujian',
			'subjudul'	=> 'Lembar Ujian',
			'soal'		=> $detail_tes,
			'no' 		=> $no,
			'html' 		=> $html,
			'id_tes'	=> $id_tes,
			'informasi' => $this->ujian->getmahasiswa($this->aauth->get_user()->username)
		];

		$this->template->title('Ujian');

		$this->render('sheet', $data);
	}

	public function encrypt()
	{
		$id = $this->input->post('id', true);
		$key = urlencode($this->encryption->encrypt($id));
		// $decrypted = $this->encryption->decrypt(rawurldecode($key));
		$this->response(['key'=>$key]);
	}

	public function simpan_satu_old()
	{
		// Decrypt Id
		$id_tes = $this->input->post('id', true);
		$id_tes = $this->encryption->decrypt($id_tes);
		
		$input 	= $this->input->post(null, true);
		$list_jawaban 	= "";
		for ($i = 1; $i < $input['jml_soal']; $i++) {
			$_tjawab 	= "opsi_".$i;
			$_tidsoal 	= "id_soal_".$i;
			$_ragu 		= "rg_".$i;
			$jawaban_ 	= empty($input[$_tjawab]) ? "" : $input[$_tjawab];
			$list_jawaban	.= "".$input[$_tidsoal].":".$jawaban_.":".$input[$_ragu].",";
		}
		$list_jawaban	= substr($list_jawaban, 0, -1);
		$d_simpan = [
			'list_jawaban' => $list_jawaban
		];
		
		// Simpan jawaban
		$this->ujian->where('id', $id_tes)->update($d_simpan, 'h_ujian');
		$this->response(['status'=>true]);
	}

	public function simpan_satu()
	{

		// Decrypt Id
		$id_tes = $this->input->post('id', true);
		$id_tes = $this->encryption->decrypt($id_tes);
		$input 	= $this->input->post(null, true);
		$list_jawaban_sementara 	= "";
		for ($i = 1; $i < $input['jml_soal']; $i++) {
			$_tjawab 	= "opsi_".$i;
			$_tidsoal 	= "id_soal_".$i;
			$_ragu 		= "rg_".$i;
			$jawaban_ 	= empty($input[$_tjawab]) ? "" : $input[$_tjawab];
			$list_jawaban_sementara	.= "".$input[$_tidsoal].":".$jawaban_.":".$input[$_ragu].",";
		}
		$list_jawaban_sementara	= substr($list_jawaban_sementara, 0, -1);
		$d_simpan = [
			'list_jawaban' => $list_jawaban_sementara
		];
		$update = $this->ujian->where('id', $id_tes)->update($d_simpan, 'h_ujian');
		if ($update) {
			// Get Jawaban
			$list_jawaban = $this->ujian->getJawaban($id_tes);

			// Pecah Jawaban
			$pc_jawaban = explode(",", $list_jawaban);
			
			$jumlah_benar 	= 0;
			$jumlah_salah 	= 0;
			$jumlah_ragu  	= 0;
			$nilai_bobot 	= 0;
			$total_bobot	= 0;
			$jumlah_soal	= sizeof($pc_jawaban);

			foreach ($pc_jawaban as $jwb) {
				$pc_dt 		= explode(":", $jwb);
				$id_soal 	= $pc_dt[0];
				$jawaban 	= $pc_dt[1];
				$ragu 		= $pc_dt[2];

				$cek_jwb 	= $this->ujian->getSoalById($id_soal);
				$total_bobot = $total_bobot + $cek_jwb->bobot;

				$jawaban == $cek_jwb->jawaban ? $jumlah_benar++ : $jumlah_salah++;
			}

			$nilai = ($jumlah_benar / $jumlah_soal)  * 100;
			$nilai_bobot = ($total_bobot / $jumlah_soal)  * 100;

			$d_update = [
				'jml_benar'		=> $jumlah_benar,
				'nilai'			=> number_format(floor($nilai), 0),
				'nilai_bobot'	=> number_format(floor($nilai_bobot), 0),
				'status'		=> 'N'
			];

			$update_users = [
				'is_active' => 0
			];
			//$this->ujian->where('no_hp', $this->session->userdata('no_hp'))->update($update_users, 'users');
			$this->ujian->where('id', $id_tes)->update($d_update, 'h_ujian');
			
		}
		$this->response(['status'=>true]);
	}

	public function simpan_akhir()
	{
		// Decrypt Id
		$id_tes = $this->input->post('id', true);
		$id_tes = $this->encryption->decrypt($id_tes);
		
		// Get Jawaban
		$list_jawaban = $this->ujian->getJawaban($id_tes);

		// Pecah Jawaban
		$pc_jawaban = explode(",", $list_jawaban);
		
		$jumlah_benar 	= 0;
		$jumlah_salah 	= 0;
		$jumlah_ragu  	= 0;
		$nilai_bobot 	= 0;
		$total_bobot	= 0;
		$jumlah_soal	= sizeof($pc_jawaban);

		foreach ($pc_jawaban as $jwb) {
			$pc_dt 		= explode(":", $jwb);
			$id_soal 	= $pc_dt[0];
			$jawaban 	= $pc_dt[1];
			$ragu 		= $pc_dt[2];

			$cek_jwb 	= $this->ujian->getSoalById($id_soal);
			$total_bobot = $total_bobot + $cek_jwb->bobot;

			$jawaban == $cek_jwb->jawaban ? $jumlah_benar++ : $jumlah_salah++;
		}

		$nilai = ($jumlah_benar / $jumlah_soal)  * 100;
		$nilai_bobot = ($total_bobot / $jumlah_soal)  * 100;

		$d_update = [
			'jml_benar'		=> $jumlah_benar,
			'nilai'			=> number_format(floor($nilai), 0),
			'nilai_bobot'	=> number_format(floor($nilai_bobot), 0),
			'status'		=> 'Y'
		];

		$update_users = [
			'is_active' => 0
		];
		//$this->ujian->where('no_hp', $this->session->userdata('no_hp'))->update($update_users, 'users');
		$this->ujian->where('id', $id_tes)->update($d_update, 'h_ujian');
		$this->response(['status'=>TRUE, 'data'=>$d_update, 'id'=>$id_tes]);
	}


}

/* End of file Kelas.php */
/* Location: ./application/controllers/Kelas.php */