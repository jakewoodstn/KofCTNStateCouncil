<?php


function formatphone($Phone){
   if(isset($Phone))
   {  
   	    $remchar = array(" ","(", ")","-",".",",","[","]","/","|");
        $Phone = str_replace($remchar,'',$Phone);
		$fphone = ""; 
		switch(strlen($Phone)){
			case 0:
				break;
			case 7:
				$pf = substr($Phone,0,3);
				$num = substr($Phone,3,4);
				$fphone = $Pf ."-" .$num;
				break;
			default:
				$ac = substr($Phone,0,3);
				$Pf = substr($Phone,3,3);
				$num = substr($Phone,6,4);
				$fphone = "(" .$ac .") " .$Pf ."-" .$num;	
				break;
		}
		return $fphone;
   }
}

function checkformat($nstr){
		$nstr = trim($nstr);
		if (strlen($nstr)==1){
			$nstr = str_replace('.','',$nstr);
			$nstr .= ".";
		}
		return $nstr;
		
}

function subPrefix($pfx){
	switch ($pfx){
		case "Mr":
			$pfx = "Mr.";
	  		break;
		case "RMr":
			$pfx = "Rev. Mr.";
			break;
		case "Rev":
			$pfx = "Rev.";
			break;
		case "MRev":
			$pfx = "Most Rev.";
			break;
		case "Dr":
			$pfx = "Dr.";
			break;
		default:
			$pfx = " ";
	}
	return $pfx;
}

function gensheet($oPExcel, $pagetitle, $sheetcols, $rostercols,$SIndex, $sqldat){


	
	// Setup the Sheet
	$oPExcel->setActiveSheetIndex($SIndex)
				->setCellValue('A1', $pagetitle);
	$oPExcel->getActiveSheet()->mergeCells("A1:Q1");
	$oPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
	$oPExcel->getActiveSheet()->getStyle('A1:Q1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
	$oPExcel->getActiveSheet()->getStyle('A1:Q1')->getAlignment()->setWrapText(true);
	$oPExcel->getActiveSheet()->getStyle('A1:Q1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$oPExcel->getActiveSheet()->getStyle('A1:Q1')->getFont()->setSize(24);

	// Generate Sheet Titles
	
	foreach ($sheetcols as $ele) {
		$scol = $ele['colid'].'2';
		foreach($rostercols as $rele){
			if ($rele['ID'] == $ele['ID']){
				$coltitle = $rele['label'];
				$colwidth = $rele['width'];
			}
		}
		$oPExcel->setActiveSheetIndex($SIndex)
				->setCellValue( $scol,$coltitle);
		$oPExcel->getActiveSheet()->getColumnDimension($ele['colid'])->setWidth($colwidth);
		$oPExcel->getActiveSheet()->getStyle($scol)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$oPExcel->getActiveSheet()->getStyle($scol)->getFont()->setSize(12);
		$oPExcel->getActiveSheet()->getStyle($scol)->getFont()->setBold(true);
		$oPExcel->getActiveSheet()->getStyle($scol)->getAlignment()->setWrapText(true);
		

	}

	// Generate Individual records
		$blockrows = 3;
		while ($info = mysql_fetch_array( $sqldat )) {

			foreach ($sheetcols as $elems) {
				
				$celladd = $elems['colid'].$blockrows;
				$colid = $elems['ID'];
				$idat = $info[$colid];
				if ($colid == "chphone" || $colid == "ccphone" || $colid == "cwphone"){
					$idat = trim($idat);
					$idat = formatphone($idat);
				}			
				// write the Record
				$oPExcel->setActiveSheetIndex($SIndex)
							->setCellValue($celladd, $idat);
			}
			$blockrows++;
		}


	
}


/** Error reporting */
error_reporting(E_ALL);
//ini_set('display_errors','On');

ini_set('error_log','xldir.log');

date_default_timezone_set('America/New_York');
/** PHPExcel */
require_once './Classes/PHPExcel.php';
// Load defaults

include "config.php";

$currdate = getdate();
switch ($currdate['mon']){
	case 1:
	case 2:
	case 3:
	case 4:
	case 5:
	case 6:
		$cfy = $currdate['year']-1;
		break;
	default:
		$cfy = $currdate['year'];
}

$currdate = getdate();
switch ($currdate['mon']){
	case 1:
	case 2:
	case 3:
	case 4:
	case 5:
	case 6:
		$nfy = $currdate['year'];
		break;
	default:
		$nfy = $currdate['year']+1;
}


//$cfy = GetFratYear();
//$nfy = GetNextFratYear();

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


//begin generating document 
$starttime= time();

// Set properties
$objPHPExcel->getProperties()->setCreator("Tennessee State Council, Knights of Columbus")
							 ->setLastModifiedBy("State Advocate")
							 ->setTitle("Tennessee State Council Directory")
							 ->setSubject("State Council Directory")
							 ->setDescription("Roster Style State Council Directory.")
							 ->setKeywords("Knights of Columbus Tennessee Directory Roster")
							 ->setCategory("Directory");



// set default header data
$headertxt =  "Tennessee State Council Directory /n Contact stateadvocate@kofc-tn.org with Corrections";

$titletext = "Tennessee State Council Directory\nFraternal Year" .$cfy ."-" .$nfy ."\nContact stateadvocate@kofc-tn.org with Corrections";

// Create the State Officers page
// Retrieve the State officers info from the database

$qry = "Select * from members left outer join fratpos on members.cuserid = fratpos.cuserid where fratpos.dirgroup=1 and fratpos.cfratyear= ".$cfy ." order by fratpos.secorder";
include 'configdb.php';
include 'opendb.php';
	
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}

// set up Variables  for page generation
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('State Officers');
#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){

		gensheet($objPHPExcel,$titletext,$soscols,$rostercols,0,($data));

	}
}


// Output Program Staff
// Retrieve the Program Staff info from the database
$qry = "Select * from members left outer join fratpos on members.cuserid=fratpos.cuserid where fratpos.dirgroup=2 and fratpos.cfratyear= ".$cfy ." order by fratpos.secorder";
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}
// Create the Sheet and set up Variables  for page generation

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(1);
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('State Program Staff');

#If something was returned

	if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){

		gensheet($objPHPExcel,$titletext,$soscols,$rostercols,1,($data));
	}
}

// Output Membership Staff
// Retrieve the Membership Staff info from the database

$qry = "Select * from members left outer join fratpos on members.cuserid=fratpos.cuserid where fratpos.dirgroup=3 and fratpos.cfratyear= ".$cfy ." order by fratpos.secorder";
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}
// Create the Sheet and set up Variables  for page generation

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(2);
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('State Membership Staff');
#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		gensheet($objPHPExcel,$titletext,$soscols,$rostercols,2,($data));
		
	}
}


//***********************************//
// Past State Deputies
//***********************************//

$qry = "Select * from members left outer join fratpos on members.cuserid=fratpos.cuserid where fratpos.dirgroup=8 and fratpos.cfratyear= ".$cfy ." order by members.cpsdterm DESC";
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(3);
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Past State Deputies');

#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		gensheet($objPHPExcel,$titletext,$psdcols,$rostercols,3,($data));
	}
}
/*--------------------------------------------------------------------------
// Output DD Portion of the Directory
//-------------------------------------------------------------------------*/
// Retrieve the DD's info from the database
$qry = "Select * from members left outer join fratpos on members.cuserid=fratpos.cuserid where fratpos.dirgroup=4 and fratpos.cfratyear= ".$cfy ." order by fratpos.secorder";
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(4);
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('District Deputies');

#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		gensheet($objPHPExcel,$titletext,$soscols,$rostercols,4,($data));
	}
}
// Output District Wardens

$qry = "Select * from members left outer join fratpos on members.cuserid=fratpos.cuserid where fratpos.dirgroup=5 and fratpos.cfratyear= ".$cfy ." order by fratpos.secorder";
//include 'configdb.php';
//include 'opendb.php';
	
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(5);
// Rename sheet
	$objPHPExcel->getActiveSheet()->setTitle('District Wardens');

#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		gensheet($objPHPExcel,$titletext,$soscols,$rostercols,5,($data));

	}
}


// Time for GK's
// ---------------------------------------------------------

// print TEXT
$qry = "Select * from members left outer join fratpos on members.cuserid=fratpos.cuserid where fratpos.cposition = 'Grand Knight' and fratpos.cfratyear= ".$cfy ." order by members.icouncil";
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(6);
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Grand Knights');

#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		gensheet($objPHPExcel,$titletext,$gkcols,$rostercols,6,($data));
	}
}
// Now for the FS's
// print TEXT
$qry = "Select * from members left outer join fratpos on members.cuserid=fratpos.cuserid where fratpos.cposition = 'Financial Secretary' and fratpos.cfratyear= ".$cfy ." order by members.icouncil";
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(7);
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Financial Secretaries');

#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		gensheet($objPHPExcel,$titletext,$gkcols,$rostercols,7,($data));
	}
}
// Output Council Meeting Locations


/*
$pdf->AddPage();
$pdf->Bookmark('Council Meetings', 0, 0, '', 'B', array(0,0,0));
PageHeader('Council Meetings',$pdf);
$pgnum = 1;
// ---------------------------------------------------------

// print TEXT
$qry = "Select * from council where bcouncil = 1 order by ccouncil ASC";
//include 'configdb.php';
//include 'opendb.php';
	
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}
$ccol = "l";
$rcol = "";
$lcol = '';
$blockcnt=0;
$blockline=0;
$pagelins=0;
#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		while ($info = mysql_fetch_array( $data )) {
			
			$blockarr = GenCouncilBlock($info,$info,"CL");
			$block = $blockarr[0];
			$blockline = $blockarr[1];
		    if ($pagelins+$blockline > 47) {
				$y = $pdf->getY();
				$pdf->SetFillColor(255, 255, 255);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->writeHTML($pagedat,true,false,false,'L');
//				$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
//				$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
				$pdf->AddPage();
				$pdf->Bookmark('Council Meetings Page ' .$pgnum, 1, 0, '', 'B', array(0,0,0));
				PageHeader('Council Meetings',$pdf);			
				$pagelins = $blockline;
				$pagedat = $block;
				$lcol='';
				$rcol='';
				$pgnum++;
			} else {
				$pagedat .= $block;
				$pagelins = $pagelins+$blockline;

			}

		}
	}


}

//mysql_free_result($data);


//include 'closedb.php';

// we have finished output the last page of data
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
// get current vertical position
if ($pagelins> 0) {
	$y = $pdf->getY();
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->writeHTML($pagedat,true,false,false,'L');

//	$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
//	$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
}

*/


// 4th Degree State
// Retrieve the State officers info from the database

$qry = "Select * from members left outer join fratpos on members.cuserid=fratpos.cuserid where fratpos.dirgroup=9 and fratpos.cfratyear= ".$cfy ." order by fratpos.secorder";
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}

// set up Variables  for page generation
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(8);
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('State Fourth Degree Staff');

#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		
		gensheet($objPHPExcel,$titletext,$fdscols,$rostercols,8,($data));
	}
}
// Faithful Navigators
// Retrieve the Faithful navigators info from the database

$qry = "Select members.cuserid, members.ctitle,members.cfname,members.cmi, members.clname,members.csuffix, members.cnname,members.ccspouse, members.csnname, members.caddress1, members.caddress2, members.ccity, members.cstate, members.czip, members.chphone, members.cwphone, members.ccphone, members.cemail, members.cwemail, members.icouncil, members.iassembly,members.cpsdterm,members.tseclevel, fratpos.cposition, fratpos.cfratyear, fratpos.dirgroup, fratpos.secorder, council.cname from members left outer join fratpos on members.cuserid=fratpos.cuserid left join council on members.iassembly=council.ccouncil where fratpos.dirgroup=10 and council.bcouncil=0 and fratpos.cfratyear= ".$cfy ." order by members.iassembly";
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}

// set up Variables  for page generation
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(9);
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Faithful Navigators');

#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		
		gensheet($objPHPExcel,$titletext,$fdcols,$rostercols,9,($data));
	}
}

// Faithful Comptrollers
// Retrieve the Comptrollers info from the database

$qry = "Select members.cuserid, members.ctitle,members.cfname,members.cmi, members.clname,members.csuffix, members.cnname,members.ccspouse, members.csnname, members.caddress1, members.caddress2, members.ccity, members.cstate, members.czip, members.chphone, members.cwphone, members.ccphone, members.cemail, members.cwemail, members.icouncil, members.iassembly,members.cpsdterm,members.tseclevel, fratpos.cposition, fratpos.cfratyear, fratpos.dirgroup, fratpos.secorder, council.cname from members left outer join fratpos on members.cuserid=fratpos.cuserid left join council on members.iassembly=council.ccouncil where fratpos.dirgroup=11 and council.bcouncil=0 and fratpos.cfratyear= ".$cfy ." order by members.iassembly";
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}

// set up Variables  for page generation
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(10);
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Faithful Comptrollers');

#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		
		gensheet($objPHPExcel,$titletext,$fdcols,$rostercols,10,($data));
	}
}
// Former District Masters

// Agency

// MR Foundation

// Squires Chief Counselors

//


include 'closedb.php';


// ---------------------------------------------------------
if ($_COOKIE['validlogin']== 'true'){
	$userid = $_COOKIE['userid'];
	//Close and output PDF document
	
	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);
	
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="StateCouncilDirectory.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	$ttg = (time()-$starttime);
	$ttgmsg = "xcelroster Generated in " .$ttg ." seconds\n Requested by: " .$userid;

	mail("tstaller@aol.com","Roster Directory PDF Generated",$ttgmsg);
}


//============================================================+
// END OF FILE
//============================================================+
?>
