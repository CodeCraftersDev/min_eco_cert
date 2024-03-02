<?php

namespace App\Controllers;

use TCPDF;
use CodeIgniter\I18n\Time;

class Certificados extends BaseController
{
    public function index(): string {
        return view('home_page');
    }

    public function certificadoNoRegistra(){
        define('K_PATH_IMAGES', base_url('assets/img/'));
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('Code Crafters');
        $pdf->SetAuthor('Ministerio de Ecologia');
        $pdf->SetTitle('Certificado de Ministerio de Ecología');

        //header
        $pdf->SetHeaderData('logo_pdf.png', 185, '', '', null, null);

        // set margins
        $pdf->SetMargins(10, 30, 10);
        $pdf->SetHeaderMargin(10);
        $pdf->SetFooterMargin(10);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 10);

        // set image scale factor
        $pdf->setImageScale(1.25);

        // add a page
        $pdf->AddPage();

        $pdf->SetFont('helvetica', 'B', 12);

        $time = Time::now('America/Argentina/Buenos_Aires', 'es_ES');
        $dia = $time->toLocalizedString('d');
        $mes = $time->toLocalizedString('MMMM');
        $ano = $time->toLocalizedString('yyyy');

        $fecha_formateada = $dia.' DE '.strtoupper($mes).' DE '.$ano;
        $text = '<p>POSADAS, '.$fecha_formateada.'</p>';
        $linea_Y = $pdf->GetY();
        $pdf->MultiCell(100, '', '', 0, 'J', 0, 2, '', $linea_Y, true, 0, true, true, 0, 'T', false);
        $pdf->MultiCell(90, '', $text, 0, 'J', 0, 1, $pdf->GetX(), $linea_Y, true, 0, true, true, 0, 'T', false);

        // RENGLONES EN BLANCO
        $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);

        $text = '<p style="text-decoration: underline;">REF: SOLICITUD ANTECEDENTES SUMARIOS FERREIRA HECTOR, DNI: 27.809.076 - (EXPTE. Num: 9900-0005/24 - S/ INSCRIPCION AL REGISTRO DE OBRAJERO - SAN VICENTE).-</p>';
        $linea_Y = $pdf->GetY();
        $pdf->MultiCell(100, '', '', 0, 'J', 0, 2, '', $linea_Y, true, 0, true, true, 0, 'T', false);
        $pdf->MultiCell(90, '', $text, 0, 'J', 0, 1, $pdf->GetX(), $linea_Y, true, 0, true, true, 0, 'T', false);

        // RENGLONES EN BLANCO
        $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);

        $text = '<p>AL</p>';
        $linea_Y = $pdf->GetY();
        $pdf->MultiCell(100, '', $text, 0, 'J', 0, 2, '', '', true, 0, true, true, 0, 'T', false);
        $pdf->MultiCell(90, '', '', 0, 'J', 0, 1, $pdf->GetX(), $linea_Y, true, 0, true, true, 0, 'T', false);


        $text = '<p>DEPTO. REGISTRO E INSCRIPCION</p>';
        $linea_Y = $pdf->GetY();
        $pdf->MultiCell(100, '', $text, 0, 'L', 0, 2, '', '', true, 0, true, true, 0, 'T', false);
        $pdf->MultiCell(90, '', '', 0, 'J', 0, 1, $pdf->GetX(), $linea_Y, true, 0, true, true, 0, 'T', false);


        $text = '<p>S_______________/_______________D:</p>';
        $linea_Y = $pdf->GetY();
        $pdf->MultiCell(100, '', $text, 0, 'L', 0, 2, '', '', true, 0, true, true, 0, 'T', false);
        $pdf->MultiCell(90, '', '', 0, 'J', 0, 1, $pdf->GetX(), $linea_Y, true, 0, true, true, 0, 'T', false);

        // RENGLONES EN BLANCO
        $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);

        $pdf->SetFont('helvetica', 'N', 12);
        $html = '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ATENTO, lo solicitado, cumplo en informar que conforme registros de este Departamento de Sumarios el Señor/a y/o firma <strong style="text-decoration: underline;">KRUJOSKI SANDRO JOSE, DNI 24.385.064 - S/ INSCRIPCION AL REGISTRO DE OBRAJERO - SAN VICENTE.- NO REGISTRA</strong> Sumarios en tramite</p>';
        $pdf->writeHTML($html, false, false, false, false, 'J');

        // RENGLONES EN BLANCO
        $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);

        $text = 'Atentamente.-';
        $linea_Y = $pdf->GetY();
        $pdf->MultiCell(100, 0, $text, 0, 'R', 0, 2, '', '', true, 0);
        $pdf->MultiCell(90, 0, '', 0, 'J', 0, 1, $pdf->GetX(), $linea_Y, true, 0);

        // RENGLONES EN BLANCO
        $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);
        $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);

        $pdf->SetFont('helvetica', 'B', 12);
        $text = '<p style="text-decoration: underline;">DEPARTAMENTO SUMARIOS AMBIENTALES.-</p>';
        $linea_Y = $pdf->GetY();
        $pdf->MultiCell(120, '', $text, 0, 'L', 0, 2, '', '', true, 0, true, true, 0, 'T', false);
        $pdf->MultiCell(90, 0, '', 0, 'J', 0, 1, $pdf->GetX(), $linea_Y, true, 0);

        $text = '<p style="text-decoration: underline;">DIRECCION GENERAL DE ASUNTOS JURIDICOS</p>';
        $linea_Y = $pdf->GetY();
        $pdf->MultiCell(120, '', $text, 0, 'L', 0, 2, '', '', true, 0, true, true, 0, 'T', false);
        $pdf->MultiCell(90, 0, '', 0, 'J', 0, 1, $pdf->GetX(), $linea_Y, true, 0);

        $text = '<p style="text-decoration: underline;">MINISTERIO DE ECOLOGIA Y R.N.R.</p>';
        $linea_Y = $pdf->GetY();
        $pdf->MultiCell(120, '', $text, 0, 'L', 0, 2, '', '', true, 0, true, true, 0, 'T', false);
        $pdf->MultiCell(90, 0, '', 0, 'J', 0, 1, $pdf->GetX(), $linea_Y, true, 0);

        // set style for barcode
        $style = array(
            'border' => 0,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );

        // QRCODE,Q : QR-CODE Better error correction
        $pdf->write2DBarcode('https://ecologia.misiones.gob.ar', 'QRCODE,Q', 10, 30, 30, 30, $style, 'N');

        $this->response->setHeader("Content-Type", "application/pdf");
        return $pdf->Output('certificado.pdf', 'I');
    }

    public function certificadoRegistra(){
        define('K_PATH_IMAGES', base_url('assets/img/'));
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('Code Crafters');
        $pdf->SetAuthor('Ministerio de Ecologia');
        $pdf->SetTitle('Certificado de Ministerio de Ecología');

        //header

        $pdf->SetHeaderData('logo_pdf.png', 185, '', '', null, null);

        // set margins
        $pdf->SetMargins(10, 30, 10);
        $pdf->SetHeaderMargin(10);
        $pdf->SetFooterMargin(10);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 10);

        // set image scale factor
        $pdf->setImageScale(1.25);

        // add a page
        $pdf->AddPage();

        $pdf->SetFont('helvetica', 'B', 12);

        $time = Time::now('America/Argentina/Buenos_Aires', 'es_ES');
        $dia = $time->toLocalizedString('d');
        $mes = $time->toLocalizedString('MMMM');
        $ano = $time->toLocalizedString('yyyy');

        $fecha_formateada = $dia.' DE '.strtoupper($mes).' DE '.$ano;
        $text = '<p>POSADAS, '.$fecha_formateada.'</p>';
        $linea_Y = $pdf->GetY();
        $pdf->MultiCell(100, '', '', 0, 'J', 0, 2, '', $linea_Y, true, 0, true, true, 0, 'T', false);
        $pdf->MultiCell(90, '', $text, 0, 'J', 0, 1, $pdf->GetX(), $linea_Y, true, 0, true, true, 0, 'T', false);

        // RENGLONES EN BLANCO
        $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);

        $text = '<p style="text-decoration: underline;">REF: SOLICITUD ANTECEDENTES SUMARIOS FERREIRA HECTOR, DNI: 27.809.076 - (EXPTE. Num: 9900-0005/24 - S/ INSCRIPCION AL REGISTRO DE OBRAJERO - SAN VICENTE).-</p>';
        $linea_Y = $pdf->GetY();
        $pdf->MultiCell(100, '', '', 0, 'J', 0, 2, '', $linea_Y, true, 0, true, true, 0, 'T', false);
        $pdf->MultiCell(90, '', $text, 0, 'J', 0, 1, $pdf->GetX(), $linea_Y, true, 0, true, true, 0, 'T', false);


        $text = '<p>AL</p>';
        $linea_Y = $pdf->GetY();
        $pdf->MultiCell(100, '', $text, 0, 'J', 0, 2, '', '', true, 0, true, true, 0, 'T', false);
        $pdf->MultiCell(90, '', '', 0, 'J', 0, 1, $pdf->GetX(), $linea_Y, true, 0, true, true, 0, 'T', false);


        $text = '<p>DEPTO. REGISTRO E INSCRIPCION</p>';
        $linea_Y = $pdf->GetY();
        $pdf->MultiCell(100, '', $text, 0, 'L', 0, 2, '', '', true, 0, true, true, 0, 'T', false);
        $pdf->MultiCell(90, '', '', 0, 'J', 0, 1, $pdf->GetX(), $linea_Y, true, 0, true, true, 0, 'T', false);


        $text = '<p>S_______________/_______________D:</p>';
        $linea_Y = $pdf->GetY();
        $pdf->MultiCell(100, '', $text, 0, 'L', 0, 2, '', '', true, 0, true, true, 0, 'T', false);
        $pdf->MultiCell(90, '', '', 0, 'J', 0, 1, $pdf->GetX(), $linea_Y, true, 0, true, true, 0, 'T', false);

        // RENGLONES EN BLANCO
        $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);

        $pdf->SetFont('helvetica', 'N', 12);
        $html = '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ATENTO, lo solicitado, cumplo en informar que conforme registros de este Departamento de Sumarios el Señor/a y/o firma <strong style="text-decoration: underline;">KRUJOSKI SANDRO JOSE, DNI 24.385.064 - S/ INSCRIPCION AL REGISTRO DE OBRAJERO - SAN VICENTE.- REGISTRA</strong> Sumarios en tramite</p>';
        $pdf->writeHTML($html, false, false, false, false, 'J');

        // RENGLONES EN BLANCO
        $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);

        $text = 'Atentamente.-';
        $linea_Y = $pdf->GetY();
        $pdf->MultiCell(100, 0, $text, 0, 'R', 0, 2, '', '', true, 0);
        $pdf->MultiCell(90, 0, '', 0, 'J', 0, 1, $pdf->GetX(), $linea_Y, true, 0);

        // RENGLONES EN BLANCO
        $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);
        $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);

        /** tabla */
        $pdf->SetFont('helvetica', 'N', 10);
        $tbl = <<<EOD
<table cellspacing="0" cellpadding="5" border="1">
    <tr>
        <th style="text-align: center" bgcolor="#CCCCCC"><strong>Can</strong></th>
        <th style="text-align: center" bgcolor="#CCCCCC"><strong>Sumario Num</strong></th>
        <th style="text-align: center" bgcolor="#CCCCCC"><strong>Importe Multa</strong></th>
        <th style="text-align: center" bgcolor="#CCCCCC"><strong>Ubicación Actual</strong></th>
        <th style="text-align: center" bgcolor="#CCCCCC"><strong>Fecha Remisión</strong></th>
        <th style="text-align: center" bgcolor="#CCCCCC"><strong>Observaciones</strong></th>
    </tr>
    <tr>
        <td style="text-align: center">1</td>
        <td style="text-align: center">73/23</td>
        <td style="text-align: center">------</td>
        <td style="text-align: center">DPTO. SUMARIOS AMBIENTALES</td>
        <td style="text-align: center">09/08/2023</td>
        <td style="text-align: center">EXPTE. N</td>
    </tr>
</table>
EOD;

        $pdf->writeHTML($tbl, true, false, false, false, '');


        // RENGLONES EN BLANCO
        $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);

        $pdf->SetFont('helvetica', 'B', 12);
        $text = '<p style="text-decoration: underline;">DEPARTAMENTO SUMARIOS AMBIENTALES.-</p>';
        $linea_Y = $pdf->GetY();
        $pdf->MultiCell(120, '', $text, 0, 'L', 0, 2, '', '', true, 0, true, true, 0, 'T', false);
        $pdf->MultiCell(90, 0, '', 0, 'J', 0, 1, $pdf->GetX(), $linea_Y, true, 0);

        $text = '<p style="text-decoration: underline;">DIRECCION GENERAL DE ASUNTOS JURIDICOS</p>';
        $linea_Y = $pdf->GetY();
        $pdf->MultiCell(120, '', $text, 0, 'L', 0, 2, '', '', true, 0, true, true, 0, 'T', false);
        $pdf->MultiCell(90, 0, '', 0, 'J', 0, 1, $pdf->GetX(), $linea_Y, true, 0);

        $text = '<p style="text-decoration: underline;">MINISTERIO DE ECOLOGIA Y R.N.R.</p>';
        $linea_Y = $pdf->GetY();
        $pdf->MultiCell(120, '', $text, 0, 'L', 0, 2, '', '', true, 0, true, true, 0, 'T', false);
        $pdf->MultiCell(90, 0, '', 0, 'J', 0, 1, $pdf->GetX(), $linea_Y, true, 0);

        // set style for barcode
        $style = array(
            'border' => 0,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );

        // QRCODE,Q : QR-CODE Better error correction
        $pdf->write2DBarcode('https://ecologia.misiones.gob.ar', 'QRCODE,Q', 10, 30, 30, 30, $style, 'N');

        $this->response->setHeader("Content-Type", "application/pdf");
        return $pdf->Output('certificado.pdf', 'I');
    }

}




