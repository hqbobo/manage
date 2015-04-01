<?php require_once dirname(__FILE__) . '/frwk/inculde.php'; ?>
<?php
$id = isset($_GET['id'])? $_GET['id']:0;
$projectEntity = New ProjectEntity();
$pj = $projectEntity->get($id);
$xls = $pj[0]->t_tables;
$filename = $pj[0]->t_year.'-'.$pj[0]->t_month.'-'.$pj[0]->t_day.':'. $pj[0]->t_projectName;
//echo $filename;
$tmp = explode("],",$xls);
$new_arr = array();
$tmp[0]=str_replace("[", "", $tmp[0]);

foreach ($tmp as  $var)
{

	$count =50;
	$var = str_replace('[', '', $var,$count);
	$var = str_replace(']','', $var,$count);

	array_push($new_arr,$var);
}

/**
 *  获取excel表格里指定单元的名称索引：
 *    如第1行第1列：
 *        返回A1
 *    第27行第二列：
 *        返回AA1：
 *
 * @param int $row 第几行
 * @param int $col 第几列
 *
 * @author mingche
 * @since 2014-05-31
 */
function getExcelCeilIndex($row, $col) {
    if($row > 0 && $col > 0 )
    {
        $str     = "ZABCDEFGHIGKLMNOPQRSTUVWXY";
        $col_str = "";
        do
        {
            $col_tmp  = $col % 26;
            $col      = $col_tmp == 0 ? intval($col / 26) - 1 : intval($col / 26);
            $col_str  = $str[$col_tmp].$col_str;
        }while( $col );
        return  $col_str.$row;
    }
    return false;
}
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set document properties
$objPHPExcel->getProperties()->setCreator("Kris")
							 ->setLastModifiedBy("Kris")
							 ->setTitle($filename)
							 ->setSubject($filename)
							 ->setDescription($filename)
							 ->setKeywords($pj[0]->t_projectName);


// Add some data
$row = 1;

foreach ($new_arr as  $var)
{
	$index = 1;
	$linearr = explode(',',$var);

	foreach ($linearr as $att)
	{			
		$coord = getExcelCeilIndex($row,$index);
		//echo '['.$coord.']';
		$att = str_replace('"', '', $att,$count);
		$att = str_replace('null','',$att,$cout);
		$att = str_replace('\n','-',$att,$cout);
		$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($coord, implode("\n",explode("-",$att)));
		$objPHPExcel->setActiveSheetIndex(0)
			->getStyle($coord)->getAlignment()->setWrapText(true);
		$index++;
		
	}	
	$row++;
	//var_dump($linearr);
}
//exit();
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle("sheet1");


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel;charset=UTF-8');
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>