<?php

namespace App\Http\Controllers;

use App\Http\library\replace_template;
use App\Http\Model\templateMailModel;
use Illuminate\Http\Request;

class pdfController extends Controller
{
    public function getTemplateOrder($orderId, $status)
    {
        $template = templateMailModel::where('status', $status)->get()[0]->template;

        return self::convertPDF($orderId, $template);
    }
    public static function convertPDF($orderId, $template)
    {
        $mpdf = new \Mpdf\Mpdf();
        $replace_Template = new replace_template();
        $mpdf->WriteHTML( $replace_Template->replace_orderID($orderId, $template));
        $mpdf->Output('hoa don.pdf','I');
        $mpdf->SetTitle("xxx");
    }
}
