<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Export extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->database();
    }


    public function pdf($fileName, $recordSet, $report_header = 'Laporan')
    {

        error_reporting(0);
        $data = array();

        $pdfFilePath = FCPATH . 'temp/' . $fileName . '-' . date('dMy') . '.pdf';

        //boost the memory limit if it's low <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
        ini_set('memory_limit', '512M');
        $data['rs']     = $recordSet;
        $data['header'] = $report_header;

        $html = $this->load->view('template_export_data', $data, true); // render the view into HTML
        //$this->load->view('admin/pdf_report', $data); // render the view into HTML
        //exit();

        include_once APPPATH . '/third_party/mpdf/mpdf.php';
        $param = '"en-GB-x","A4-L","","",10,10,10,10,6,3';
        $pdf   = new mPDF();

        $pdf->AddPage('L', '', '', '', '', 10, 10, 10, 10, 6, 3);

        $pdf->simpleTables  = true;
        $pdf->packTableData = true;

        // Add a footer for good measure <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
        $pdf->SetFooter($_SERVER['HTTP_HOST'] . '|{PAGENO}|' . date(DATE_RFC822));
        $pdf->WriteHTML($html); // write the HTML into the PDF
        $pdf->Output($pdfFilePath, 'F'); // save to file because we can

        $this->load->helper('download');
        $data = file_get_contents($pdfFilePath); // Read the file's contents
        // $name = $fileName.'_'.date('dMy').'.pdf';

        @force_download($fileName . '.pdf', $data);
        error_reporting(E_ALL);
    }

    public function excel($fileName, $recordSet, $heightRow = 70)
    {
        error_reporting(0);
        if (!$recordSet) {
            return false;
        }

        // Starting the PHPExcel library
        $this->load->library('PHPExcel');
        $this->load->library('PHPExcel/IOFactory');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle('export')->setDescription('none');

        $objPHPExcel->setActiveSheetIndex(0);
        // Field names in the first row
        $fields = $recordSet->list_fields();
        $col    = 0;
        foreach ($fields as $field) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, strtoupper(str_replace('_', ' ', $field)));
            $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);
            ++$col;
        }

        // Fetching the table data
        $row = 2;
        foreach ($recordSet->result() as $data) {
            $col = 0;
            foreach ($fields as $field) {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                ++$col;
            }

            //set row height
            $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight($heightRow);

            ++$row;
        }

        foreach (range('A', 'F') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        $num_rows = $recordSet->num_rows() + 1;

        foreach (range('A', 'F') as $columnID) {
            $objPHPExcel->getActiveSheet()->getStyle($columnID . '1:' . $columnID . $num_rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        }

        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');

        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '-' . date('dMy') . '.xls"');
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');
        error_reporting(E_ALL);
    }
}
