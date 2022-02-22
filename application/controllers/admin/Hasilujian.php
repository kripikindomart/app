<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hasilujian extends Admin {
	public $mhs, $user;
	 
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Hasilujian_model', 'hasilujian');

		
	}

	public function index()
	{

		$data['title']	= 'Dashboard';
		$data['page']	= 'hasilujian/index';
		$data['prodi'] = $this->hasilujian->where('prodiID !=', 'ADM')->get('master_prodi');
		$this->template->title($data['title']);
		$this->render($data['page'], $data);
	}




	public function ajax($data = null)
	{

		$this->response($this->hasilujian->getData($data), false);
	}


	public function NilaiMhs($id)
	{
		$this->response($this->hasilujian->HslUjianById($id, true), false);
	}


	public function detail_hasil($prodiID, $idGroup)
	{
		$ujian = $this->hasilujian->getUjianById($prodiID);
		$nilai = $this->hasilujian->bandingNilai($idGroup);

		$data = [
			'judul'	=> 'Ujian',
			'subjudul'=> 'Detail Hasil Ujian',
			'ujian'	=> $ujian,
			'nilai'	=> $nilai
		];


		$data['title'] = "Nilai prodi";
		$data['page']	= 'hasilujian/detail_hasil';
		$this->template->title($data['title']);
		$this->render($data['page'], $data);
	}

	public function nilai_perprodi($id_prodi, $id_group =null)
	{
		$this->response($this->hasilujian->hasil_ujian_prodi($id_prodi, true), false);
	}

	//1
	public function detail_prodi()
	{
		$data['title']	= 'Detail Ujian Prodi ';
		$data['page']	= 'hasilujian/detail_soal_prodi';
		$id = $this->uri->segment(4);
		$data['prodi'] = $this->hasilujian->where('prodiID', $id)->first('master_prodi');
		$data['group'] = $this->hasilujian->where('id', $id)->get('group_soal');
		$data['prodi_data'] = $this->hasilujian->get('master_prodi');
		$this->template->title($data['title']);
		$this->render($data['page'], $data);
	}

	//2
	public function detail_ajax($id_prodi)
	{
		return$this->response($this->hasilujian->getDataUjian($id_prodi), false);
		
	}



	function detail_prodi_ajax($id_group = null)
	{
		return $this->response($this->hasilujian->getDataUjian($id_group), false);
	}

	public function detail_kelas_prodi($id)
	{
		$ujian = $this->hasilujian->getUjianById($id);
		$nilai = $this->hasilujian->bandingNilai($id);

		$data = [
			'judul'	=> 'Ujian',
			'subjudul'=> 'Detail Hasil Ujian',
			'ujian'	=> $ujian,
			'nilai'	=> $nilai
		];


		$data['title'] = "Nilai prodi";
		$data['page']	= 'hasilujian/detail_hasil';
		$this->template->title($data['title']);
		$this->render($data['page'], $data);
	}

	public function cetak($id)
	{
		$this->load->library('Pdf');

		$mhs 	= $this->hasilujian->getIdMahasiswa($this->user->username);
		$hasil 	= $this->hasilujian->HslUjian($id, $mhs->id_mahasiswa)->row();
		$ujian 	= $this->hasilujian->getUjianById($id);
		
		$data = [
			'ujian' => $ujian,
			'hasil' => $hasil,
			'mhs'	=> $mhs
		];
		
		$this->load->view('ujian/cetak', $data);
	}

	public function cetak_detail($id)
	{
		$this->load->library('Pdf');

		$ujian = $this->hasilujian->getUjianById($id);
		$nilai = $this->hasilujian->bandingNilai($id);
		$hasil = $this->hasilujian->hasil_ujian_prodi($id)->result();

		$data = [
			'ujian'	=> $ujian,
			'nilai'	=> $nilai,
			'hasil'	=> $hasil
		];

		$data['page']	= 'hasilujian/cetak_detail';
		$this->template->title($data['title']);
		$this->render($data['page'], $data);
	}


	

	public function delete()
	{
		$id = $this->input->post('delete_id');
		$data = $this->hasilujian->where('id', $id)->cek_data();

		if ($data) {
			$remove = $this->hasilujian->where('id', $id)->delete();
			if ($remove) {
				$response['success'] = true;
				$response['message'] = "Berhasil menghapus data";
			} else {
				$response['success'] = false;
				$response['message'] = "Gagal menghapus data";
			}
		} else {
				$response['success'] = false;
				$response['message'] = "Data tida ditemukan";
		}
		return $this->response($response);
	}

	public function export($id)
	{
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		$excel = new PHPExcel();
		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
	    $ujian = $this->hasilujian->getUjianById($id);
		$nilai = $this->hasilujian->bandingNilai($id);
		$hasil = $this->hasilujian->hasil_ujian_prodi($id)->result();

		 $excel->getProperties()->setCreator('PPSUIKA - ADMIN - REPORTING')
                 ->setLastModifiedBy('PPSUIKA - ADMIN - REPORTING')
                 ->setTitle("REPORT HASIL SELEKSI MASUK")
                 ->setSubject("REPORTING HASIL SELEKSI MASUK SEKOLAH PASCASARJANA")
                 ->setDescription("REPORTING HASIL SELEKSI MASUK SEKOLAH PASCASARJANA")
                 ->setKeywords("REPORTING HASIL SELEKSI MASUK");

        $style_col = array(
			      'font' => array('bold' => true), // Set font nya jadi bold
			      'alignment' => array(
			      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			      ),
			      'borders' => array(
			      'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			      'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			      'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			      'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			      )
			    );   

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
	    $style_row = array(
	      'alignment' => array(
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	      ),
	      'borders' => array(
	        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
	        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
	        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
	        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	      )
	    );
	    
	    $excel->setActiveSheetIndex(0)->setCellValue('A1', "REKAP DATA HASIL UJIAN SELEKSI MASUK"); // Set kolom A1 dengan tulisan "DATA SISWA"
	    $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
	    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
	    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
	    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

	    $excel->setActiveSheetIndex(0)->setCellValue('A2', "Nama Ujian"); //A2
	    $excel->setActiveSheetIndex(0)->setCellValue('A3', "Jumlah Soal"); //A2
	    $excel->setActiveSheetIndex(0)->setCellValue('A4', "Waktu"); //A2
	    $excel->setActiveSheetIndex(0)->setCellValue('A5', "Tanggal Mulai Ujian"); //A2
	    $excel->setActiveSheetIndex(0)->setCellValue('A6', "Program Studi"); //A2
	    $excel->setActiveSheetIndex(0)->setCellValue('A7', "Nilai Terendah"); //A2
	    $excel->setActiveSheetIndex(0)->setCellValue('A8', "Nilai Tertinggi"); //A2
	    $excel->setActiveSheetIndex(0)->setCellValue('A9', "Rata-rata Nilai"); //A2

	    $excel->getActiveSheet()->mergeCells('A2:B2'); 
	    $excel->getActiveSheet()->mergeCells('A3:B3'); 
	    $excel->getActiveSheet()->mergeCells('A4:B4'); 
	    $excel->getActiveSheet()->mergeCells('A5:B5'); 
	    $excel->getActiveSheet()->mergeCells('A6:B6'); 
	    $excel->getActiveSheet()->mergeCells('A7:B7'); 
	    $excel->getActiveSheet()->mergeCells('A8:B8'); 
	    $excel->getActiveSheet()->mergeCells('A9:B9'); 

	    $excel->getActiveSheet()->getStyle('A2:B9')->getFont()->setBold(TRUE); 
	   	$excel->setActiveSheetIndex(0)->setCellValue('C2', $ujian->title_ujian);
	   	$excel->setActiveSheetIndex(0)->setCellValue('C3', $ujian->jumlah_soal);
	   	$excel->setActiveSheetIndex(0)->setCellValue('C4', $ujian->waktu_pengerjaan.' Menit');
	   	$excel->setActiveSheetIndex(0)->setCellValue('C5', $ujian->tgl_mulai);
	   	$excel->setActiveSheetIndex(0)->setCellValue('C6', $ujian->program_studi);
	   	$excel->setActiveSheetIndex(0)->setCellValue('C7', $nilai->max_nilai);
	   	$excel->setActiveSheetIndex(0)->setCellValue('C8', $nilai->min_nilai);
	   	$excel->setActiveSheetIndex(0)->setCellValue('C9', $nilai->avg_nilai);


	    // Buat header tabel nya pada baris ke 3
	    $excel->setActiveSheetIndex(0)->setCellValue('A11', "NO"); // Set kolom A3 dengan tulisan "NO"
	    $excel->setActiveSheetIndex(0)->setCellValue('B11', "NO REGISTRASI"); // Set kolom B3 dengan tulisan "NIS"
	    $excel->setActiveSheetIndex(0)->setCellValue('C11', "NAMA MAHASISWA"); // Set kolom C3 dengan tulisan "NAMA"
	    $excel->setActiveSheetIndex(0)->setCellValue('D11', "JUMLAH BENAR"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
	    $excel->setActiveSheetIndex(0)->setCellValue('E11', "NILAI"); // Set kolom E3 dengan tulisan "ALAMAT"
	    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
	    $excel->getActiveSheet()->getStyle('A11')->applyFromArray($style_col);
	    $excel->getActiveSheet()->getStyle('B11')->applyFromArray($style_col);
	    $excel->getActiveSheet()->getStyle('C11')->applyFromArray($style_col);
	    $excel->getActiveSheet()->getStyle('D11')->applyFromArray($style_col);
	    $excel->getActiveSheet()->getStyle('E11')->applyFromArray($style_col);
	    
	    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
	    $numrow = 12; // Set baris pertama untuk isi tabel adalah baris ke 4
	    foreach($hasil as $data){ // Lakukan looping pada variabel siswa
	      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
	      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->no_registrasi);
	      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->nama_lengkap);
	      $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->jml_benar);
	      $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->nilai);
	      
	      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
	      $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
	      $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
	      $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
	      $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
	      $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
	      
	      $no++; // Tambah 1 setiap kali looping
	      $numrow++; // Tambah 1 setiap kali looping
	    }
	    // Set width kolom
	    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
	    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
	    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
	    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(15); // Set width kolom D
	    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(10); // Set width kolom E
	    
	    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
	    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
	    // Set orientasi kertas jadi LANDSCAPE
	    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
	    // Set judul file excel nya
	    $excel->getActiveSheet(0)->setTitle("DPI");
	    $excel->setActiveSheetIndex(0);
	    // Proses file excel
	    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	    header('Content-Disposition: attachment; filename="Laporan Data hasil ujian seleksi masuk.xlsx"'); // Set nama file excel nya
	    header('Cache-Control: max-age=0');
	    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
	    $write->save('php://output');

	          

	}




       





}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */