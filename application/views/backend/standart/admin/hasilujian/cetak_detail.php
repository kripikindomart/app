<?php 
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    public function Header() {
        $path = FCPATH . 'uploads/img/';
        // $image_file = K_PATH_IMAGES.'logo_example.jpg';
        // $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetFont('helvetica', 'B', 18);
        $this->SetY(13);
        $this->Cell(0, 15, 'REKAP DATA HASIL UJIAN SELEKSI MASUK', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}

$tgl_mulai = tgl_indo($ujian->tgl_mulai);
$tgl_berakhir = tgl_indo($ujian->tgl_berakhir);
$max_nilai = number_format($nilai->max_nilai);
$min_nilai = number_format($nilai->min_nilai);
$rata_rata = number_format($nilai->avg_nilai);
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Muhammad Asrul anwar');
$pdf->SetTitle('Hasil Ujian');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

$mulai = strftime('%A, %d %B %Y', strtotime($ujian->tgl_mulai));
$selesai = strftime('%A, %d %B %Y', strtotime($ujian->tgl_berakhir));

// create some HTML content
$html = <<<EOD

<table >
    <tr>
        <th><strong>Nama Ujian</strong></th>
        <td>{$ujian->title_ujian}</td>
        <th><strong>Program Studi</strong></th>
        <td>{$ujian->program_studi}</td> 
    </tr>
    <tr>
        <th><strong>Jumlah Soal</strong></th>
        <td>{$ujian->jumlah_soal}</td>
    </tr>
    <tr>
        <th><strong>Waktu</strong></th>
        <td>{$ujian->waktu_pengerjaan} Menit</td>
        <th><strong>Nilai Terendah</strong></th>
        <td>{$min_nilai}</td>
    </tr>
    <tr>
        <th><strong>Tanggal Mulai</strong></th>
        <td>{$tgl_mulai}</td>
        <th><strong>Nilai Tertinggi</strong></th>
        <td>{$max_nilai}</td>
    </tr>
    <tr>
        <th></th>
        <td></td>
        <th><strong>Rata-rata nilai</strong></th>
        <td>{$rata_rata}</td>
    </tr>
</table>
EOD;

$html .= <<<EOD
<br><br><br>
<table border="1" style="border-collapse:collapse">
    <thead>
        <tr align="center">
            <th width="5%">No.</th>
            <th width="15%">No Registrasi</th>
            <th width="35%">Nama Mahasiswa</th>
            <th width="25%">Program Studi</th>
            <th width="10%">Jumlah Benar</th>
            <th width="10%">Nilai</th>
        </tr>        
    </thead>
    <tbody>
EOD;

$no = 1;
foreach($hasil as $row) {
$html .= <<<EOD
    <tr>
        <td align="center" width="5%">{$no}</td>
        <td width="15%">{$row->no_registrasi}</td>
        <td width="35%">{$row->nama_lengkap}</td>
        <td width="25%">{$row->program_studi}</td>
        <td width="10%">{$row->jml_benar}</td>
        <td width="10%">{$row->nilai}</td>
    </tr>
EOD;
$no++;
}

$html .= <<<EOD
    </tbody>
</table>
EOD;

// output the HTML content
$pdf->writeHTML($html, true, 0, true, 0);
// reset pointer to the last page
$pdf->lastPage();
// ---------------------------------------------------------
// Clean any content of the output buffer
ob_end_clean();
//Close and output PDF document
$pdf->Output('tes.pdf', 'I');
exit;