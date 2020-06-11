<?php defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Pdf
{
public function __construct(){        
// koneksi ke autoload dalam folder di lebrari
require_once dirname(__FILE__).'/dompdf/autoload.inc.php';   
$pdf = new DOMPDF();        
$CI =& get_instance();
$CI->dompdf = $pdf;

}
}
?>