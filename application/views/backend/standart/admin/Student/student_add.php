<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Student extends MY_Model {

		protected $primary_key 	= 'id';
	protected $table 	= 'students';
	protected $field_search 	= ['program_studi_id', 'kelas_id', 'subkelas_id', 'total_semester', 'code', 'nik', 'nama', 'email', 'status_mahasiswa', 'status_penerimaan', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'kode_pos', 'no_hp', 'pendidikan_terakhir', 'asal_universitas_s1', 'asal_universitas_s2', 'asal_universitas_s3', 'gelar_terakhir', 'pekerjaan', 'alamat_pekerjaan', 'nama_ibu', 'photo', 'judul_thesis', 'status_akun', 'daftar_tgl', 'diterima_tgl', 'created_at', 'updated_at'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct();
	}

	
}