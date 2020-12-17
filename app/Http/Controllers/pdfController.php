<?php

namespace App\Http\Controllers;

use App\Http\library\replace_template;
use Illuminate\Http\Request;

class pdfController extends Controller
{
    public static function convertPDF($orderId, $template)
    {
        $mpdf = new \Mpdf\Mpdf();
        $replace_Template = new replace_template();
        $mpdf->WriteHTML( $replace_Template->replace_orderID($orderId, $template));
        $mpdf->Output('hoa don.pdf','I');
        $mpdf->SetTitle("xxx");
    }
}
