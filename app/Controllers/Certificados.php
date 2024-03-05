<?php

namespace App\Controllers;

use App\Models\SumarioModel;
use TCPDF;
use CodeIgniter\I18n\Time;

class Certificados extends BaseController
{
    public function index(): string {
        return view('home_page');
    }

    public function certificado($hash){
        $model = new SumarioModel();
        $certificado = $model->getCertificadoByHash($hash);
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

        if(count($certificado['cab']) == 0){
            $pdf->SetFont('helvetica', 'B', 20);
            $pdf->StartTransform();
            $pdf->Rotate(45, 130, 150);
            $pdf->Text(70, 96, 'El Sumario no existe o es un código erróneo');
            $pdf->StopTransform();

            $this->response->setHeader("Content-Type", "application/pdf");
            return $pdf->Output('certificado.pdf', 'I');
        }
        else{
            $fecha_formateada = $dia.' DE '.strtoupper($mes).' DE '.$ano;
            $text = '<p>POSADAS, '.$fecha_formateada.'</p>';
            $linea_Y = $pdf->GetY();
            $pdf->MultiCell(100, '', '', 0, 'J', 0, 2, '', $linea_Y, true, 0, true, true, 0, 'T', false);
            $pdf->MultiCell(90, '', $text, 0, 'J', 0, 1, $pdf->GetX(), $linea_Y, true, 0, true, true, 0, 'T', false);

            // RENGLONES EN BLANCO
            $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);

            /*$text = '<p style="text-decoration: underline;">REF: SOLICITUD ANTECEDENTES SUMARIOS FERREIRA HECTOR, DNI: 27.809.076 - (EXPTE. Num: 9900-0005/24 - S/ INSCRIPCION AL REGISTRO DE OBRAJERO - SAN VICENTE).-</p>';
            $linea_Y = $pdf->GetY();
            $pdf->MultiCell(100, '', '', 0, 'J', 0, 2, '', $linea_Y, true, 0, true, true, 0, 'T', false);
            $pdf->MultiCell(90, '', $text, 0, 'J', 0, 1, $pdf->GetX(), $linea_Y, true, 0, true, true, 0, 'T', false);*/

            // RENGLONES EN BLANCO
            $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);
            $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);
            $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);
            $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);

            $pdf->SetFont('helvetica', 'N', 12);

            if(count($certificado['det']) > 0){ /*** REGISTRA SUMARIOS EN TRAMITE **/
                $html = '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ATENTO, lo solicitado, cumplo en informar que conforme registros de este Departamento de Sumarios el Señor/a y/o firma <strong style="text-decoration: underline;">'.$certificado['cab']['referencia'].'.- REGISTRA</strong> Sumarios en tramite</p>';
                $pdf->writeHTML($html, false, false, false, false, 'J');

                // RENGLONES EN BLANCO
                $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);
                $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);

                /** tabla */
                $pdf->SetFont('helvetica', 'N', 10);
                $cont = 1;
                $tbl = '<table cellspacing="0" cellpadding="5" border="1">
                <tr>
                    <th style="text-align: center" bgcolor="#CCCCCC"><strong>Can</strong></th>
                    <th style="text-align: center" bgcolor="#CCCCCC"><strong>Sumario Num</strong></th>
                    <th style="text-align: center" bgcolor="#CCCCCC"><strong>Ubicación Actual</strong></th>
                    <th style="text-align: center" bgcolor="#CCCCCC"><strong>Estado del sumario</strong></th>
                </tr>';

                foreach ($certificado['det'] as $det){
                    $tbl .= '<tr>
                    <td style="text-align: center">'.$cont.'</td>
                    <td style="text-align: center">'.$det['id_sumary'].'</td>
                    <td style="text-align: center">'.$det['ubicacion_actual'].'</td>
                    <td style="text-align: center">'.$det['estado_sumario'].'</td>
                </tr>';
                    $cont++;
                }

                $tbl .= '</table>';

                $pdf->writeHTML($tbl, true, false, false, false, '');
            }
            else{
                $html = '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ATENTO, lo solicitado, cumplo en informar que conforme registros de este Departamento de Sumarios el Señor/a y/o firma <strong style="text-decoration: underline;">'.$certificado['cab']['referencia'].'.- NO REGISTRA</strong> Sumarios en tramite</p>';
                $pdf->writeHTML($html, false, false, false, false, 'J');

                // RENGLONES EN BLANCO
                $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);
                $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);
            }

            /** pertenecencia del certificado */
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


            // RENGLONES EN BLANCO
            $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);
            $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);
            $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);
            $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);


            $pdf->SetFont('helvetica', 'N', 9);
            $html = '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recuerde que este CERTIFICADO es un documento público que refleja la información de la base de datos del Registro de Infractores del Ministerio de Ecología y RNR. El plazo de validez del presente CERTIFICADO es de SEIS (6) meses para ser presentado ante quien corresponda.</p>';
            $pdf->writeHTML($html, false, false, false, false, 'J');

            $pdf->Write(0, '', '', 0, 'R', true, 0, false, false, 0);
            $html = '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;En caso de verificarse alguna variación, modificación, alteración o falsificación de una parte o todo el documento hará carente de validez el mismo, sin perjuicio de las sanciones que correspondan.</p>';
            $pdf->writeHTML($html, false, false, false, false, 'J');

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
            $pdf->write2DBarcode(base_url('/validarcert').'/'.$hash, 'QRCODE,Q', 10, 25, 40, 40, $style, 'N');

            $this->response->setHeader("Content-Type", "application/pdf");
            return $pdf->Output('certificado.pdf', 'I');
        }
    }
}




